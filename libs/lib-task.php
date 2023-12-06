<?php
function getFolders() {
    global $conn;
    $sql = "SELECT * FROM `folders`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

#tasks
function getTasks() {
    return 1 ;
}

?>