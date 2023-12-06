<?php

function addFolders() {
    global $connection;
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