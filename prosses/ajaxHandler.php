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
        echo addFolder($_POST['folderName']);
    break;

    case "addTask";
    $folderId = $_POST['folderId'] ;
    $taskTitle = $_POST['taskTitle'] ;
        if(!isset($folderId) || empty($folderId)) {
            echo "Select the desired file!";
            die();
        }
        if(!isset($taskTitle) || strlen($taskTitle) <= 3) {
            printRandomText($textStrLen);
            die();
        }
        echo addTask($taskTitle, $folderId);
    break;
    case "doneSwitch";
        $task_id = $_POST['taskId'] ;
        if(!isset($task_id) || !is_numeric($task_id)) {
            echo "Task ID is not valid";
            die();
        }
        doneSwitch($task_id);
    break;

    default : 
        echo("Invalid Action");
}