<?php


echo $_SERVER['HTTP_REFERER'];

if($_SERVER['HTTP_REFERER']){
    $hash = filter_var($_GET['hash'],   FILTER_VALIDATE_STRING);
}