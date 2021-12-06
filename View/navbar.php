<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Nav</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
            <a class="navbar-brand" href="#">AppName</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle bold" data-toggle="dropdown">MENU <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    switch ($_SESSION['privil']) {
        case ($_SESSION['privil'] === 0):
            # code...
            ?>
            <li><a href="CreatePost.php">Add Post</a></li>
            <?php
        break;

        case ($_SESSION['privil'] === 1):
            # code...
            ?>
            <li><a href="CreatePost.php">Add Post</a></li>
            <li><a href="../Control/Index_Controller.php">List Newest Posts</a></li>
            <li class="divider"></li>
            <?php
        break;
    }
    ?>
            <li><a href="Nickname.php">Update Nickname</a></li>
            <li><a href="ChangeEmail.php">Change Email</a></li>
            <li><a href="ChengePassword.php">Change Password</a></li>
            <li class="divider"></li>
            <li><a href="../Control/SignOut_Controller.php">Sign Out</a></li>
            <?php

} else {
    ?>
    <li><a href="Login.php">Login</a></li>
    <li><a href="Register.php">Create Account</a></li>
    <?php
}
?>
                        <!-- <li><a href="CreatePost.php">Add Post</a></li> -->

                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <script type="text/javascript">
    </script>
</body>

</html>
