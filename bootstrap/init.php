<?php

include_once("constants.php");
include_once(BASE_PATH ."libs/helpers.php");
include_once(BASE_PATH ."vendor/autoload.php");

// "mysql:host={$databases_config->host};dbname=$databases_config->db","$databases_config->user","$databases_config->pass"
try {
    $connection = new PDO("mysql:dbname=todolist; host=localhost",'root','');
# set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
# Message Connected
    // echo "Connected successfully";       
} catch (PDOException $e) {
    diePage("Connection failed: " . $e->getMessage());
}    


include_once(BASE_PATH ."libs/lib-auth.php");
include_once(BASE_PATH ."libs/lib-task.php");
include_once(BASE_PATH ."libs/lib-folder.php");