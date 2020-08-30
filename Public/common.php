<?php
define('__CONFIG_ROOT__', dirname(__FILE__, 2));
require_once (__CONFIG_ROOT__ . "\config.php");

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