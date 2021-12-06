<title>Edit Post</title>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<?php
require_once 'navbar.php';

if (!isset($_SESSION['loggedin'])) {
    header('refresh:0; url =Login.php');
}

if (isset($_SESSION['posts']) && count(array($_SESSION['posts'])) > 0) {

?>
    <div class="container">
        <div class="row">
            <div class="span6">

                <?php
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                ?>
                    <div class="alert alert-danger">
                        <center><?= $_SESSION['error'] ?></center>
                    </div>
                <?php
                    unset($_SESSION['error']);
                } elseif (isset($_SESSION['done']) && !empty($_SESSION['done'])) {
                ?>
                    <div class="alert alert-success">
                        <center><?= $_SESSION['done'] ?></center>
                    </div>
                <?php
                    unset($_SESSION['done']);
                }
                ?>

                <form style="margin-top: 50px;" action="../Control/EditPost_Controller.php" method="POST" autocomplete="off">

                    <div class="controls controls-row">
                        <label for="title">Title : </label>
                        <input name="title" type="text" class="span6" placeholder="Title" required="" style="height: 30px;" value="<?= $_SESSION['posts']['title'] ?>">
                    </div>
                    <div class="controls">
                        <label for="post">Post : </label>
                        <textarea name="post" class="span6" placeholder="Your Post" rows="7" required=""><?= $_SESSION['posts']['post'] ?></textarea>
                    </div>
                    <div class="controls controls-row">
                        <label for="password">Password : </label>
                        <input name="password" type="password" class="span6" placeholder="Password" required="" style="height: 30px;">
                    </div>
                    <input type="hidden" name="id" value="<?= $_SESSION['posts']['id'] ?>">
                    <div class="controls">
                        <button name="submit" type="submit" class="btn btn-primary input-medium pull-right center-block">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION['posts']);
} else {
    $_SESSION['error'] = 'You are not authorized to be here';
    header('refresh:1; url = Login.php');
}
