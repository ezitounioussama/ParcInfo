<?php

$servername = "localhost";
$username = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=parcinfo", $username, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
