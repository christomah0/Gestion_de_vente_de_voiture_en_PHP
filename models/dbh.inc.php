<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "gestion_vente_voiture";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    error_log("Connection error: " . mysqli_connect_error());
}