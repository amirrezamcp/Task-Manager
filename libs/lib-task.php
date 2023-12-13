<?php defined('BASE_PATH') OR die("Permision Denied");
function getTasks() {
    global $connection;
    $folder = $_GET['folder_id'] ?? null ;
    $folderCondition = '';
    if(isset($folder) && is_numeric($folder)) {
        $folderCondition = "and folder_id = $folder";
    }
    $Current_user_ID = getCurrentuserID();
    $sql = "SELECT * FROM tasks where user_id = $Current_user_ID $folderCondition";
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

?>