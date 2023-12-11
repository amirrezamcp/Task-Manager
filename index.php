<?php
include_once ("./bootstrap/init.php");

# Removal and validation process
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
   $deleteedCount = deleteFolder($_GET['delete_folder']);
}
if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
   $deleteedCount = deleteTask($_GET['delete_task']);
}
$folders = getFolders();
$tasks = getTasks();
include_once ("./tpl/tpl-todo-list.php");
?>