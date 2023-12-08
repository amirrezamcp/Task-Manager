<?php
function isAjaxRequest() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}
function diepage($msg){
    echo ( "<div style='padding: 30px; width: 88%; margin: 50px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; font-family: sans-serif; border-radius: 5px;' >$msg</div>");
    die();
}
function printRandomText($texts) {
    $randomText = array_rand($texts);
    echo $texts[$randomText];
}
?>