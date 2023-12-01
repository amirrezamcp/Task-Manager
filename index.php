<?php
include_once ("./bootstrap/init.php");


$tasks = getTask();

include_once ("./tpl/todo-list.php");
?>