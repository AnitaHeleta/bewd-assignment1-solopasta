<!doctype html>
<html lang="en">

<head>

    <title>Solo Pasta</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<?php session_start(); ?>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.Welcome to Solo Pasta.</h1>
</div>
<p>
    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
<h1><a href="../index.php">Solo Pasta</a></h1>
