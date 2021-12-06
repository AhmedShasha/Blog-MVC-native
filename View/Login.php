<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script><script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>


<!------ Include the above in your HEAD tag ---------->
<title>Login</title>

<?php

require_once 'navbar.php';
// var_dump($_SESSION);
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // header('refresh:0; url=navbar.php');
}

?>

<div class="container">
    <div class="row">
        <div class="span12">
            <form class="form-horizontal" action="../Control/Login_Controller.php" method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Login</legend>
                    </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="Username" class="input-xlarge" style="height: 30px;" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" style="height: 30px;" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            <small> <a href="PassReset.html">Forget Password?</a></small>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
