<?php
try {
    $mysqlConnection = new PDO(
        "mysql:host=localhost;dbname=estate;charset=utf8",
        "root",
        ""
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
