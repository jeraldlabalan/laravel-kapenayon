<?php
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$port = 4000;
$dbname = "kapenayon";
$username = "3gsHKM5GuBJ7xn9.root";
$password = "87A2LUVDgit1mARk";
$ssl_ca_path = __DIR__ . "/ca.pem"; // make sure ca.pem is in the same folder

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::MYSQL_ATTR_SSL_CA => $ssl_ca_path,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "✅ Connected to TiDB Cloud!";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
