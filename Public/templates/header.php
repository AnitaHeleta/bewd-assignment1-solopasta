<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . "/common.php");
session_start();
ensure_loggedIn();
?>
<?php include "html_head.php" ?>
<header>
    <a href="<?php echo normalize_url("index.php") ?>">
        <img id="logo" src="<?php echo normalize_url("assets/img/solopastalogo.png") ?>">
    </a>
    <h1>
        Welcome to Solo Pasta
    </h1>
    <div class="quote">
        <p>"life is a combination of magic and pasta"</p>
        <figure> Federico Fellini
    </div>

    <a id="hero" href="<?php echo normalize_url("ïndex.php") ?>">
        <!--        <img id="heroimage" src="--><?php //echo normalize_url("assets/img/heroimage.jpg") ?><!--">-->
    </a>

    <p>
        <span><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <a class="glyphicon glyphicon-erase" href="<?php echo normalize_url("reset-password.php") ?>"
           class="btn btn-warning"></a>
        <a class="glyphicon glyphicon-log-out" href="<?php echo normalize_url("logout.php") ?>"
           class="btn btn-danger"></a>
    </p>
</header>
