<?php
session_start();
require_once '../Model/dbConnection.php';
if (isset($_POST['post'], $_POST['title']) && !empty($_POST['post']) && !empty($_POST['title'])) {
    if (ctype_alpha($_POST['title'])) {
        if (preg_match('/^[A-Za-z0-9-_. ]+$/i', $_POST['post'])) {

            $stmt = $PDO->prepare('INSERT INTO posts (userId , username , title , post )
                    VALUES(:userId , :username , :title , :post)');
            $stmt->execute([
                ':userId' => $_SESSION['id'],
                ':username' => $_SESSION['username'],
                ':title' => $_POST['title'],
                ':post' => $_POST['post'],
            ]);
            if ($stmt->rowCount()) {
                $_SESSION['done'] = 'Post has been added successfully';
                // echo 'Post has been added successfully';
                header('refresh:.2; url=../Control/Index_Controller.php');
            } else {
                echo 'nothing';
            }
        } else {
            $_SESSION['error'] = 'Body should only be letters, whitespace, 0-9, Characters';
            header('refresh:.5; url = ../View/CreatePost.php');
        }
    } else {
        $_SESSION['error'] = 'Title should only be letters';
        header('refresh:.5; url = ../View/CreatePost.php');
    }

} else {
    $_SESSION['error'] = 'Body Or Title Are Be Required';
    header('refresh:.5; url = ../View/CreatePost.php');
}
