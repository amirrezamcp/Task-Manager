<?php
include_once ("./bootstrap/init.php");

# Removal and validation process
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
   $deleteedCount = deleteFolder($_GET['delete_folder']);
   echo "$deleteedCount delete";
}

$folders = getFolders();
$tasks = getTasks();

include_once ("./tpl/todo-list.php");
?>