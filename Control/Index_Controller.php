<?php

session_start();
require_once '../Model/dbConnection.php';

$stmt = $PDO->prepare('SELECT * FROM posts');
$stmt->execute([]);

$_SESSION['posts'] = $stmt->fetchAll();
header('refresh:0; url=../View/Index.php');
