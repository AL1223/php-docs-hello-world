<?php
$serverName = "tcp:sqlgitapp.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "sqlgitapp",
    "Uid" => "azuruser",
    "PWD" => "kawtarmdp1223@K",
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false
);

// Établir la connexion à la base de données
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Vérifier la connexion
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Custom Vision Configuration
$customVisionEndpoint = "https://westeurope.api.cognitive.microsoft.com/"; // Replace with your Custom Vision endpoint
$customVisionPredictionKey = "8b6ad715cd9344a8b1583de97f24c1ae"; // Replace with your Custom Vision prediction key
$customVisionIterationId = "a6ef9eba-344e-40d6-a2ec-bdc044aa6c87"; // Replace with your Custom Vision iteration ID
?>
