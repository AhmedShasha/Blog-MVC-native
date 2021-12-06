<?php

require_once '../Model/dbConnection.php';

if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['password_confirm'], $_POST['nickname'])) {
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password_confirm = $_POST['password_confirm'];

    if (preg_match('/^[a-z0-9-_. ]+$/i', $username)) {

        if (strlen($password) >= 8 && strlen($password) <= 32) {
            if ($password_confirm === $password) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $stmt = $PDO->prepare('SELECT * FROM users WHERE username=?');
                    $stmt->execute([
                        $username,
                    ]);
                    if ($stmt->rowCount()) {
                        echo ' Username is already token, please pick up another one ';
                    } else {
                        $stmt = $PDO->prepare('SELECT * FROM users WHERE email=?');
                        $stmt->execute([
                            $email,
                        ]);
                        if ($stmt->rowCount()) {
                            echo ' Email is already token, please pick up another one ';
                        } else {
                            $stmt = $PDO->prepare('INSERT INTO users (username,password,email,nickname) VALUES (?,?,?,?)');
                            $stmt->execute([
                                $username,
                                password_hash($password, PASSWORD_DEFAULT),
                                $email,
                                $nickname,
                            ]);
                            // var_dump($nickname);
                            if ($stmt->rowCount()) {
                                echo 'Thanks for register, Go to activate your account';
                            }
                        }
                    }
                } else {
                    echo 'Please Provide a valid Email';
                }
            } else {
                echo "Password Confirmation doesn't match";
            }
        } else {
            echo 'Please Provide a valid password';
        }

    } else {
        echo 'Please Provide a valid username';
    }

}
