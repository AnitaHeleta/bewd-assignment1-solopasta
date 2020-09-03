<!--this file is thought to be used in conjunction with footer.php-->

<?php
session_start();
ensure_loggedIn();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <a href="<?php echo normalize_url("index.php") ?>">
                    <img id="logo" src="<?php echo normalize_url("assets/css/img/logo.png") ?>">
                </a>
                <div id="user">
                    <span id="username"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                    <a class="glyphicon glyphicon-erase"
                       title="Reset Password"
                       href="<?php echo normalize_url("reset-password.php") ?>"></a>
                    <a class="glyphicon glyphicon-log-out"
                       title="Logout"
                       href="<?php echo normalize_url("logout.php") ?>"></a>
                </div>
            </header>
        </div>
    </div>
