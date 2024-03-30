<?php
$host = 'localhost';
$dbname = 'myfirstdatabase';
$dbusername = 'root';
$dbpassword = 'root';
// $host = $_ENV['AZURE_MYSQL_HOST'];
// $dbname = $_ENV['AZURE_MYSQL_DBNAME'];
// $dbusername = $_ENV['AZURE_MYSQL_USERNAME'];
// $dbpassword = $_ENV['AZURE_MYSQL_PASSWORD'];
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failded: " . $e->getMessage());
}
