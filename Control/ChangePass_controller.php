<?php

session_start();
require_once '../Model/dbConnection.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']) && !empty($_POST['current_password'])
        && !empty($_POST['new_password']) && !empty($_POST['current_password'])) {

        if (strlen($_POST['current_password']) >= 8 && strlen($_POST['current_password']) <= 32) {
            if (strlen($_POST['new_password']) >= 8 && strlen($_POST['new_password']) <= 32) {

                if ($_POST['new_password'] === $_POST['confirm_password']) {
                    $stmt = $PDO->prepare('SELECT * FROM users WHERE username=:username OR email=:email');
                    $stmt->execute([
                        ':username' => $_SESSION['username'],
                        ':email' => $_SESSION['email'],
                    ]);
                    if ($stmt->rowCount()) {
                        foreach ($stmt->fetchAll() as $value) {
                            if (password_verify($_POST['current_password'], $value['password'])) {

                                $stmt = $PDO->prepare('UPDATE users SET password=:password WHERE username=:username AND id=:id');
                                $stmt->execute([
                                    ':password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                                    ':username' => $_SESSION['username'],
                                    ':id' => $_SESSION['id'],
                                ]);
                                if ($stmt->rowCount()) {
                                    echo 'has be changed';
                                } else {
                                    echo 'an error has occured';
                                }
                            } else {
                                echo 'password incorrect';
                            }
                        }
                    }
                } else {
                    echo "Passwords don't match";
                }
            }
        } else {
            echo 'password is weak';
        }
    }

} else {
    echo ('You Have To Login');
}
