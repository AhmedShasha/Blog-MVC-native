<?php
require_once 'navbar.php';
?>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script><script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<title>Change Nickname</title>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="span12">
            <form class="form-horizontal" action="../Control/Nickname_Controller.php" method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Nickname</legend>
                    </div>

                    <div class="control-group">
                        <!-- new Password-->
                        <label class="control-label" for="nickname">Nickname</label>
                        <div class="controls">
                            <input type="text" id="nickname" name="nickname" placeholder="Nickname" class="input-xlarge" style="height: 30px;" required="">
                        </div><br>
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" style="height: 30px;" required="">
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
