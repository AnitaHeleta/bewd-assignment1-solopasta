<!--this file is thought to be used in conjunction with html_foot.php-->
<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . "/common.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Solo Pasta</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo normalize_url("assets/css/reset.css") ?>"/>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="<?php echo normalize_url("assets/css/style.css") ?>"/>
</head>
<body>