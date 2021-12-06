<?php
session_start();
session_unset();
session_destroy();

header('refresh:.8; url=../View/Login.php');
