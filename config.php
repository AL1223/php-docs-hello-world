<?php
$serverName = "tcp:sqlgitapp.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "sqlgitapp",
    "Uid" => "azuruser",
    "PWD" => "kawtarmdp1223@K",
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false,
);

// Établir la connexion à la base de données
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Vérifier la connexion
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
