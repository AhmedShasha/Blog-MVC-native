<?php
session_start();
require_once '../Model/dbConnection.php';
$action = ['unapproved','approved'];
// var_dump($action);
if(isset($action,$_GET['id']) && !empty($action) && !empty($_GET['id'])){

    if(in_array($action,$action)){
        if (preg_match('/^[0-9]+$/', $_GET['id'])) {
            $stmt = $PDO->prepare('SELECT * FROM posts WHERE id=:id');
            $stmt->execute([
                ':id'   =>$_GET['id']
            ]);
            if ($stmt->rowCount()) {
                foreach ($stmt->fetchAll() as $value) {
                    if ($value['userId'] === $_SESSION['id']) {
                        switch ($action) {
                            case ($action === 'approved'):
                                echo 'Hello this is approved post';
                                break;
                            default:
                                echo 'Hello , you are deleting the post';
                            break;
                        }
                    } else {
                        echo 'IDs are not matching ! ';
                        // header('refresh:0; url =Index_Controller.php');
                    }
                }
            } else {
                echo 'Post does not exist';
                // header('refresh:0; url = Index_Controller.php');
            }
        }
    }

}

?>
