<?php

require_once "common.php";

//// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    redirectTo("login.php");
    exit;
}

if (isset($_SESSION["loggedin"])) {
    redirectTo("recipes.php");
}
?>
