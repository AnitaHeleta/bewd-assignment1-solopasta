<!doctype html>
<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once (__ROOT__ . "/common.php");
session_start();
?>
<html lang="en">
<head>
    <title>Solo Pasta</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo normalize_url("assets/css/style.css") ?>">
</head>

<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.Welcome to Solo Pasta.</h1>
</div>
<p>
    <a href="<?php echo normalize_url("reset-password.php") ?>" class=" btn btn-warning">Reset Your Password</a>
    <a href="<?php echo normalize_url("logout.php") ?>" class="btn btn-danger">Sign Out of Your Account</a>
</p>
<h1><a href="<?php echo normalize_url("index.php") ?>"> Solo Pasta</a></h1>
