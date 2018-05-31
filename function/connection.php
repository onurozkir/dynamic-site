<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = 'ece_odev';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>