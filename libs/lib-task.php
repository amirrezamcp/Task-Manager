<?php defined('BASE_PATH') OR die("Permision Denied");
function getTasks() {
    global $connection;
    $folder = $_GET['folder_id'] ?? null ;
    $folderCondition = '';
    if(isset($folder) && is_numeric($folder)) {
        $folderCondition = "and folder_id = $folder";
    }
    $Current_user_ID = getCurrentuserID();
    $sql = "SELECT * FROM tasks WHERE user_id = $Current_user_ID $folderCondition";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;

}
function addTask($taskTitle, $folderId) {
    $Current_user_ID = getCurrentuserID();
    global $connection;
    $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (:title, :user_id, :folder_id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':title' => $taskTitle, ':user_id' => $Current_user_ID, ':folder_id' => $folderId]);
    return $stmt->rowCount();
}
function deleteTask($task_id) {
    global $connection;
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
function doneSwitch($task_id) {
    // doneSwitch Substitution of values 
    // 0 => 1 OR 1 => 0
    $Current_user_ID = getCurrentuserID();
    global $connection;
    $sql = "UPDATE tasks SET is_done = 1 - is_done WHERE user_id = :userID AND id = :taskID";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':taskID' => $task_id, ':userID' => $Current_user_ID]);
    return $stmt->rowCount();
}
?>