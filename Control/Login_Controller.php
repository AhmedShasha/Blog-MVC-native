<?php

require_once '../Model/dbConnection.php';
require_once '../View/navbar.php';

if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (preg_match('/^[a-z0-9-_. ]+$/i', $username)) {

        if (strlen($password) >= 8 && strlen($password) <= 32) {
            $stmt = $PDO->prepare('SELECT * FROM users WHERE username=:username OR email=:email');
            $stmt->execute([
                ':username' => $username,
                ':email' => $username,

            ]);

            if ($stmt->rowCount()) {
                $stmt = $PDO->prepare('SELECT * FROM users WHERE (username=:username OR email=:email) AND activated=1');
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $username,
                ]);

                if ($stmt->rowCount()) {
                    foreach ($stmt->fetchAll() as $value) {
                        if (password_verify($password, $value['password'])) {

                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $value['username'];
                            $_SESSION['email'] = $value['email'];
                            $_SESSION['id'] = $value['id'];
                            $_SESSION['privil'] = $value['privil'];
                            $_SESSION['nickname'] = $value['nickname'] ?? $value['username'];
                            $stmt = $PDO->prepare('UPDATE users SET last_login =:last_login WHERE username=:username');
                            $stmt->execute([
                                'last_login' => date('y-m-d h:m:s'),
                                ':username' => $_SESSION['username'],
                            ]);

                            header('refresh:0; url=Index_Controller.php');

                        } else {
                            echo 'Username/Email or password incorrect';
                        }
                    }

                } else {
                    echo 'User is not activated';
                }

            } else {
                echo 'Username/Email or password incorrect';
            }
        } else {
            echo 'Username/Email or password incorrect';
        }
    }
} else {
    echo 'Username/Email or password incorrect';
}
