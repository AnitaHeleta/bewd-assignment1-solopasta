<!--this file is thought to be used in conjunction with footer.php-->

<?php
session_start();
ensure_loggedIn();
?>
<div class="wrapper"
<header>
    <a href="<?php echo normalize_url("index.php") ?>">
        <img id="logo" src="<?php echo normalize_url("assets/css/img/logocolour.png") ?>">
    </a>
    <p>"life is a combination of magic and pasta"</p>
    <div id="user">
        <span><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        <div>
            <a class="glyphicon glyphicon-erase" href="<?php echo normalize_url("reset-password.php") ?>"></a>
            <a class="glyphicon glyphicon-log-out" href="<?php echo normalize_url("logout.php") ?>"></a>
        </div>
    </div>
</header>
