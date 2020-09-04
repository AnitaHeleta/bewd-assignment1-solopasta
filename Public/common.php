<?php
define('__CONFIG_ROOT__', dirname(__FILE__, 2));
require_once (__CONFIG_ROOT__ . "/config.php");

function ensure_loggedIn(){
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        redirectTo("login.php");
        exit;
    }
}

function redirectTo($url){
    global $root_url;
    header("location: " . normalize_url($url));
}

function normalize_url($url){
    global $root_url;
    return $root_url . "/" . $url;
}

function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

?>