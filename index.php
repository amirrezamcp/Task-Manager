<?php
include_once ("./bootstrap/init.php");

$folders = getFolders();
$tasks = getTasks();

include_once ("./tpl/todo-list.php");
?>