<?php

require_once '../Model/dbConnection.php';

if (isset($_POST['email'], $_POST['submit']) && !empty($_POST['email'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $stmt = $PDO->prepare('SELECT * FROM users WHERE email=:email');
        $stmt->execute([
            ':email' => $_POST['email'],
        ]);
        if ($stmt->rowCount()) {
            // update token , generate link
            $stmt = $PDO->prepare('UPDATE users SET reset_token=:reset_token WHERE email=:email');
            $stmt->execute([
                ':email' => $_POST['email'],
                ':reset_token' => sha1(uniqid('', true)) . sha1(date('y-m-d h:m:s')),
            ]);

            if ($stmt->rowCount()) {
                $stmt = $PDO->prepare('SELECT email,reset_token FROM users WHERE email=:email');
                $stmt->execute([
                    ':email' => $_POST['email'],

                ]);
                if ($stmt->rowCount()) {
                    foreach ($stmt->fetchAll() as $value) {
                        ?>
                        <a href="PassRecovery_Controller.php?email=<?=$value['email'];?>&reset_token=<?=$value['reset_token']?>">
                        Click here to reset your password</a>
                        <?php
}
                }
            }

        }

    } else {
        echo 'please provide a valid email';
    }
} else {
    echo 'please fill up your form';
}

?>
