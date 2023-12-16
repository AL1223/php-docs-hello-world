<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album PHP</title>
</head>
<body>
    <h1>Mon Album</h1>

    <?php
    require_once 'config.php';  // Inclure le fichier de configuration

    // Répertoire où les images seront stockées
    $imageDirectory = 'uploads/';

    // Vérifie si le dossier existe, sinon le crée
    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }

    // Traitement du téléchargement de l'image
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        $targetFile = $imageDirectory . basename($_FILES['image']['name']);
        
        // Vérifie si le fichier est une image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Enregistrez le chemin de l'image et les tags dans la base de données
                $fileName = $_FILES['image']['name'];
                $tags = 'chat';  // Tag par défaut

                // Utilisation de paramètres sécurisés
                $insertQuery = "INSERT INTO Images (ImageName, Class) VALUES (?, ?)";
                $params = array($fileName, $tags);
                $stmt = sqlsrv_prepare($conn, $insertQuery, $params);

                if (sqlsrv_execute($stmt) === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                echo '<p>L\'image a été téléchargée avec succès.</p>';
            } else {
                echo '<p>Une erreur s\'est produite lors du téléchargement de l\'image.</p>';
            }
        } else {
            echo '<p>Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.</p>';
        }
    }
    ?>

    <!-- Formulaire pour télécharger une image -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Sélectionnez une image à télécharger :</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Télécharger</button>
    </form>

    <!-- Affichage de l'album -->
    <h2>Album</h2>
    <div>
        <?php
        // Affiche toutes les images dans le répertoire
        $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        foreach ($images as $image) {
            echo '<img src="' . $image . '" alt="Album Image">';
        }
        ?>
    </div>

    <!-- Test de la connexion à la base de données -->
    <?php
    // Requête de test
    $query = "SELECT TOP 1 ImageID, ImageName, Class FROM Images";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Affichage des résultats de test
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo '<p>ImageID: ' . $row['ImageID'] . ', ImageName: ' . $row['ImageName'] . ', Class: ' . $row['Class'] . '</p>';
    }
    ?>
</body>
</html>
