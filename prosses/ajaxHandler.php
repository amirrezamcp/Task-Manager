<?php
include_once "../bootstrap/init.php";
$textStrLen = [
    1 => 'The number of characters is less than the limit',
    2 => 'The number of characters must be more than 3 letters',
    3 => 'Woman: Few characters!!! good night then',
    4 => 'Man: Few characters!!! you are not Kirim excuse me',
];
if(!isAjaxRequest()) {
    diepage("Invalid Request");
}
if(!isset($_POST['action']) || empty($_POST['action'])){
    diepage("Invalid Action");

}

switch ($_POST['action']) {
    case "addFolder";
    if(!isset($_POST['folderName']) || strlen($_POST['folderName']) <= 3) {
        printRandomText($textStrLen);
        die();
    }
        echo addFolders($_POST['folderName']);
    break;

    case "addTask";
        // var_dump($_POST);
    break;

    default : 
        diepage("Invalid Action");
}