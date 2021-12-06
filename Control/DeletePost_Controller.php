<?php
session_start();
require_once '../Model/dbConnection.php';
if (isset($_POST['delete'], $_POST['id']) && !empty($_POST['delete']) && !empty($_POST['id'])) {

    if (preg_match('/^[0-9]+$/', $_POST['id'])) {
        $stmt = $PDO->prepare('SELECT * FROM posts WHERE id=:id');
        $stmt->execute([
            ':id' => $_POST['id'],
        ]);

        if ($stmt->rowCount()) {
            foreach ($stmt->fetchAll() as $value) {
                if ($value['userId'] === $_SESSION['id']) {
                    $stmt = $PDO->prepare('DELETE FROM posts WHERE id=:id');
                    $stmt->execute([
                        ':id'   =>$_POST['id']
                    ]);
                    if($stmt->rowCount()){
                        $_SESSION['done'] = 'Post has been deleted successfully';
                        header('refresh:0; url = Index_Controller.php');
                    }else{
                        $_SESSION['error'] = 'You are not authorized to delete this post';
                        header('refresh:0; url =Index_Controller.php');
                    }
                }else{
                    $_SESSION['error'] = 'IDs are not matching ! ';
                    header('refresh:0; url =Index_Controller.php');
                }

            }
        }else{
            $_SESSION['error'] = 'Post does not exist';
            header('refresh:0; url = Index_Controller.php');
        }
    }else{
        $_SESSION['error'] = 'ID should be only numbers';
        header('refresh:0; url =Index_Controller.php');
    }

}else{
    $_SESSION['error'] = 'Something have been error in file "DeletePost_Controller"';
    header('refresh:0; url = Index_Controller.php');
}
