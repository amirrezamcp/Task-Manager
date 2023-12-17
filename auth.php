<?php
include_once ("./bootstrap/init.php");

$password = "amir";
$home_url = site_url();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;
    if($action == 'register') {
        $result = register($params);
        if(!$result) {
            message("Error: an error in Registration");
        } else {
            message("Registration is Successfull. Welcome to Task Manager. <br>
            <a href='$home_url/auth.php'> Please Login </a>", 'success');
        }
    } elseif($action == 'login') {
        $result = login($params['email'], $params['password']);
        if(!$result) {
            message("Error: Email or Password is Incorrect");
        } else {
            message("You are new Logged In. <br>
            <a href='$home_url'> Back to Manage Your Task </a>", 'success');
        }
    }    
}
include_once ("./tpl/tpl-auth.php");
?>