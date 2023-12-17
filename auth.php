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
        }
    } elseif($action == 'login') {
        $result = login($params['email'], $params['password']);
        if(!$result) {
            message("Error: Email or Password is Incorrect");
        } else {
            redirect(site_url());

        }
    }    
}
include_once ("./tpl/tpl-auth.php");
?>