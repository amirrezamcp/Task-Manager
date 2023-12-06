<?php

function getFolders() {
    global $connection;
    $sql = "SELECT * FROM folders";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function addFolders() {
    global $connection;
}
function deleteFolders() {
    global $connection;
}