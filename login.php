<?php
require_once('include/bootstrap.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //$password = $_POST['password'];

    $sql = "
        SELECT *
        FROM users
        WHERE username = '" . $username . "'
        AND password = '".$password."'";

    $found_results = db_select($sql);
    
    if (count($found_results) > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['errors'] = false;
        $_SESSION['user'] = $found_results[0];

        redirect('welcome.php');
        
    } else {
        $_SESSION['logged_in'] = false;
        $_SESSION['errors'] = true;

        redirect('index.php');
        
    }
}
