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
    // Database connection settings
    $serverName = "your_server_name.database.windows.net";
    $databaseName = "your_database_name";
    $username = "your_username";
    $password = "your_password";

    try {
        $conn = new PDO("sqlsrv:Server=$serverName;Database=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully to the database";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // Rest of your existing code for image uploads...

    // Processing image upload and database insertion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        // ... (existing code for image upload)

        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                echo '<p>L\'image a été téléchargée avec succès.</p>';

                // Insert image information into the database
                $imagePath = $targetFile;
                $insertQuery = "INSERT INTO Images (ImagePath) VALUES ('$imagePath')";
                $conn->exec($insertQuery);
            } else {
                echo '<p>Une erreur s\'est produite lors du téléchargement de l\'image.</p>';
            }
        } else {
            echo '<p>Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.</p>';
        }
    }
    ?>

    <!-- The rest of your existing HTML code... -->
</body>

</html>
