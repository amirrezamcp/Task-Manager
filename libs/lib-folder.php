<?php defined('BASE_PATH') OR die("Permision Denied");
function addFolders($Folder_name) {
    $Current_user_ID = getCurrentuserID();
    global $connection;
    $sql = "INSERT INTO folders (name, user_id) VALUES (:Folder_name, :user_id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':Folder_name' => $Folder_name, ':user_id' => $Current_user_ID]);
    return $stmt->rowCount();
}
function getFolders() {
    $Current_user_ID = getCurrentuserID();
    global $connection;
    $sql = "SELECT * FROM folders WHERE user_id = $Current_user_ID";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function deleteFolder($folder_id) {
    global $connection;
    $sql = "DELETE FROM folders WHERE id = $folder_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}