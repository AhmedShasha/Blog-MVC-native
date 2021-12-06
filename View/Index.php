<title>Posts</title>
<?php

require_once 'navbar.php';
require_once '../Model/dbConnection.php';

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
?>
    <div class="alert alert-danger">
        <center><?= $_SESSION['error']; ?></center>
    </div>
<?php
    unset($_SESSION['error']);
} elseif (isset($_SESSION['done']) && !empty($_SESSION['done'])) {
?>
    <div class="alert alert-success">
        <center><?= $_SESSION['done']; ?></center>
    </div>
    <?php
    unset($_SESSION['done']);
}

// var_dump($_SESSION['posts']);

if (isset($_SESSION['loggedin'])) {
    if (isset($_SESSION['posts'])) {
        if (count(array($_SESSION['posts'])) > 0) {
    ?>
            <table class="table table-bordered" style="margin: auto;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Title</th>
                        <th scope="col">Post</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit Post</th>
                        <th scope="col">Delete Post</th>
                    </tr>
                </thead>
                <?php

                foreach ($_SESSION['posts'] as $value) {
                ?>

                    <tbody class="thead-light">
                        <tr>
                            <td>
                                <?=
                                $value['id']
                                ?>
                            </td>

                            <td>
                                <?=
                                $value['username']
                                ?>
                            </td>

                            <td>
                                <?=
                                $value['title']
                                ?>
                            </td>

                            <td>
                                <?=
                                $value['post']
                                ?>
                            </td>

                            <td>
                                <?php

                                if ($value['approved'] === 1) {
                                ?>
                                    <a href="../Control/Approved_Controller.php?id=<?= $value['id'] ?>" class="btn btn-danger">Un-Approve</a>
                                <?php
                                } else {
                                ?>
                                    <a href="../Control/Approved_Controller.php?id=<?= $value['id'] ?>" class="btn btn-success">Approve</a>

                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a href="../Control/EditPost_Controller.php?id=<?= $value['id'] ?>" class="btn btn-primary">Edit Post</a>
                            </td>
                            <td>
                                <form action="../Control/DeletePost_Controller.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                    <input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
    <?php
        } else {
            echo 'No Posts To View';
        }
    } else {
        // include '../Control/Index_Controller.php';
        header('refresh:0; url= ../Control/Index_Controller.php');
    }
} else {
    echo 'You have to Login';
    header('refresh:2; url = Login.php');
}

?>