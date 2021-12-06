<?php

session_start();
require_once '../Model/dbConnection.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        if (strlen($_POST['password']) >= 8 && strlen($_POST['password']) <= 32) {

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                $stmt = $PDO->prepare('SELECT * FROM users WHERE username=:username');
                $stmt->execute([
                    ':username' => $_SESSION['username'],
                ]);
                if ($stmt->rowCount()) {
                    foreach ($stmt->fetchAll() as $value) {
                        if (password_verify($_POST['password'], $value['password'])) {
                            $stmt = $PDO->prepare('SELECT * FROM users WHERE email=:email');
                            $stmt->execute([
                                ':email' => $_POST['email'],
                            ]);
                            if ($stmt->rowCount()) {
                                echo 'Email is already taken';
                            } else {
                                $stmt = $PDO->prepare('UPDATE users SET email=:email WHERE username=:username AND id=:id');
                                $stmt->execute([
                                    ':email' => $_POST['email'],
                                    ':username' => $_SESSION['username'],
                                    ':id' => $_SESSION['id'],
                                ]);
                                if ($stmt->rowCount()) {
                                    echo 'has be changed';
                                }
                            }
                        } else {
                            echo 'Username/Email or password incorrect';
                        }
                    }
                } else {
                    echo 'User is not activated';
                }
            } else {
                echo 'please provide us a valid email';
            }
        } else {
            echo 'password is weak';
        }
    }
} else {
    echo ('You Have To Login');
}
