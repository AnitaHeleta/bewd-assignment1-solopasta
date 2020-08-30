<?php
$root_url = "http://localhost/bewd-assignment1-solopasta/Public";
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "solo_pasta";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $pdo_connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>