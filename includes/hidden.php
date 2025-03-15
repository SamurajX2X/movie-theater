<?php
// includes/hidden.php

$dsn = 'mysql:host=localhost;dbname=kino';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Połączenie nieudane: ' . $e->getMessage());
}