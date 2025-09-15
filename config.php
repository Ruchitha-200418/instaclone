<?php
$pdo = new PDO("mysql:host=localhost;dbname=instagram_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();
?>