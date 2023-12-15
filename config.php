config.php                                                                                                                                                                                                                                  <?php
$serverName = "sqlgitapp.database.windows.net";
$connectionOptions = array(
    "Database" => "sqlgitapp",
    "Uid" => "azuruser",
    "PWD" => "kawtarmdp1223@K",
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false,
    "ConnectionTimeout" => 30
);

// Établir la connexion à la base de données
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Vérifier la connexion
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>