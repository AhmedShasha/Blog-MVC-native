
<title>Create Post</title>

<?php

require_once 'navbar.php';
if (!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])) {

    header('refresh:0; url=Login.php');
}

?>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row">
		<div class="span6">

            <?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    ?>
                    <div class="alert alert-danger">
                       <center><?=$_SESSION['error']?></center>
                    </div>
                    <?php
unset($_SESSION['error']);
} elseif (isset($_SESSION['done']) && !empty($_SESSION['done'])) {
    ?>
                    <div class="alert alert-success">
                       <center><?=$_SESSION['done']?></center>
                    </div>
                    <?php
unset($_SESSION['done']);
}
?>

            <form style="margin-top: 50px;" action="../Control/CreatePost_Controller.php" method="POST" autocomplete="off">

                <div class="controls controls-row">
                    <label for="title">Title : </label>
                    <input name="title" type="text" class="span6" placeholder="Title" required="" style="height: 30px;">
                </div>
                <div class="controls">
                    <label for="post">Post : </label>
                    <textarea name="post" class="span6" placeholder="Your Post" rows="7" required=""></textarea>
                </div>

                <div class="controls">
                    <button name="submit" type="submit" class="btn btn-primary input-medium pull-right">Post</button>
                </div>
            </form>
        </div>
	</div>
</div>
