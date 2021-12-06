<?php
session_start();
require_once '../Model/dbConnection.php';

if (count($_GET) > 0) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        if (preg_match('/^[0-9]+$/', $_GET['id'])) {
            $stmt = $PDO->prepare('SELECT * FROM posts WHERE id=:id');
            $stmt->execute([
                ':id' => $_GET['id'],
            ]);
            if ($stmt->rowCount()) {
                foreach ($stmt->fetchAll() as $value) {

                    if ($_SESSION['id'] === $value['userId']) {
                        $_SESSION['posts'] = $value;
                        header('refresh:0; url=../View/EditPost.php');
                    } else {
                        $_SESSION['error'] = 'You are not authorized to edit this post';
                        header('refresh:0; url = ../View/Index.php');
                    }

                }

            }

        } else {
            $_SESSION['error'] = 'Post ID should only contain of numbers';
            header('refresh:0; url = ../View/Index.php');
        }
    } else {
        $_SESSION['error'] = 'Post ID Can not be empty';
        header('refresh:0; url = ../View/Index.php');
    }

} elseif (count($_POST) > 0) {

    $stmt = $PDO->prepare('SELECT * FROM users WHERE username=:username');
    $stmt->execute([
        ':username' =>$_SESSION['username']
    ]);
    if($stmt->rowCount()){
        foreach($stmt->fetchAll() as $value){
            if(password_verify($_POST['password'],$value['password'])){
                try {
                    $PDO->beginTransaction();

                    $stmt = $PDO->prepare('SELECT * FROM posts WHERE id=:id');
                    $stmt->execute([
                        ':id' => $_POST['id'],
                    ]);

                    if ($stmt->rowCount()) {
                        $stmt = $PDO->prepare('UPDATE posts SET userId=:userId, username=:username, title=:title, post=:post,
                            uploaded_at=:uploaded_at WHERE id=:id');

                        $stmt->execute([
                            ':userId' => $_SESSION['id'],
                            ':username' => $_SESSION['username'],
                            ':title' => $_POST['title'],
                            ':post' => $_POST['post'],
                            ':id' => $_POST['id'],
                            ':uploaded_at' => date('Y-m-d h:m'),
                        ]);
                        if ($stmt->rowCount()) {
                            $_SESSION['done'] = 'Post has been updated successfully';
                            header('refresh:0; url = ../View/Index.php');
                            unset($_SESSION['posts']);
                        }
                    }
                    $PDO->commit();
                } catch (PDOException $e) {
                    $PDO->rollBack();
                    $_SESSION['error'] = 'Post Title Already Exist';
                    header('refresh:0; url = ../View/Index.php');
                }
            }else{
                $_SESSION['error'] = 'Password is incorrect';
                header('refresh:0; url = ../View/Index.php');
            }
        }

    }
}
