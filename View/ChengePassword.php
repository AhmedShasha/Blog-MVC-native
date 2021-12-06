<title>Change Password</title>
<?php
require_once 'navbar.php';
?>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script><script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>


<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="span12">
            <form class="form-horizontal" action="../Control/ChangePass_controller.php" method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class=" ">Change Password</legend>
                    </div>
                    <div class="control-group">
                        <!-- current password -->
                        <label class="control-label" for="current_password">Current Password</label>
                        <div class="controls">
                            <input type="password" id="current_password" name="current_password" placeholder="Current password" class="input-xlarge" style="height: 30px;" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- new Password-->
                        <label class="control-label" for="new_password">New Password</label>
                        <div class="controls">
                            <input type="password" id="new_password" name="new_password" placeholder="New Password" class="input-xlarge" style="height: 30px;">
                        </div><br>
                        <label class="control-label" for="confirm_password">Confirm Password</label>
                        <div class="controls">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="input-xlarge" style="height: 30px;" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
