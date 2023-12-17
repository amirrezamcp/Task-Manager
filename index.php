<?php
include_once ("./bootstrap/init.php");
# authentication
if(isset($_GET['logout'])) {
   logout();
}
if(!isLoggedIn()) {
   // redirect to aut from
   redirect(site_url('auth.php'));
}
$user = getLoggedInUser();
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