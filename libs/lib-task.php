<?php defined('BASE_PATH') OR die("Permision Denied");
function getTasks() {
    global $connection;
    $Current_user_ID = getCurrentuserID();
    $sql = "SELECT * FROM tasks where user_id = $Current_user_ID";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;

}
function addTasks() {
    return 1 ;
}
function deleteTask($task_id) {
    global $connection;
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

?>