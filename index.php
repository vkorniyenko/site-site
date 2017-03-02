<?php

session_start();
include_once './includes/config.php';
include_once './includes/functions.php';

$message = check_forms($db_host, $db_user, $db_pass, $db_name);
if ($message) {
    echo $message;
}else if(isset($_GET['reg'])){
    include './includes/views/regform.php';
}
include './includes/views/loginblock.php';
