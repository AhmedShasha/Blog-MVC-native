<?php

require_once '../Model/dbConnection.php';

if (isset($_GET['email'], $_GET['reset_token']) && !empty($_GET['reset_token']) && !empty($_GET['email'])) {
    // check email and token

    $stmt = $PDO->prepare('SELECT * FROM users WHERE email=:email AND reset_token=:reset_token');
    $stmt->execute([
        ':email' => $_GET['email'],
        ':reset_token' => $_GET['reset_token'],
    ]);
    if ($stmt->rowCount()) {

        ?>

        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <!------ Include the above in your HEAD tag ---------->

        <div class="container">
            <div class="row">
                <div class="span12">
                    <form class="form-horizontal" action="" method="POST">
                        <fieldset>
                            <div id="legend">
                                <legend class=" ">Reset Password</legend>
                            </div>

                            <div class="control-group">
                                <!-- new Password-->
                                <label class="control-label" for="new_password">New Password</label>
                                <div class="controls">
                                    <input type="password" id="new_password" name="new_password" placeholder="New Password" class="input-xlarge" style="height: 30px;" required="">
                                </div><br>
                                <label class="control-label" for="confirm_password">Confirm Password</label>
                                <div class="controls">
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="input-xlarge" style="height: 30px;" required="">
                                </div>
                            </div>
                            <div class="control-group">
                                <!-- Button -->
                                <div class="controls">
                                    <input type="submit" name="submit" value="Reset Password" class="btn btn-success">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php

        if (isset($_POST['new_password'], $_POST['confirm_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            // VAR_DUMP($_POST);

            if ($_POST['confirm_password'] === $_POST['new_password']) {

                $stmt = $PDO->prepare('UPDATE users SET password=:password WHERE email=:email AND reset_token=:reset_token');

                $stmt->execute([
                    ':reset_token' => $_GET['reset_token'],
                    ':email' => $_GET['email'],
                    ':password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                ]);
                if ($stmt->rowCount()) {
                    echo "Password changed successfully";
                }
            } else {
                echo "Password doesn't match";
            }
        }
    } else {
        echo 'Invalid Token';
    }
}

?>
