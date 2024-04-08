<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=gambling", "root", "");
} catch(PDOException $e) {
echo "Database Connection failed" .$e->getMessage();
}
session_start();
?>