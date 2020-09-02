<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<!-- [SEARCH FORM] -->
<form method="post" action="search-results.php">
    <label for="name">Recipe name: </label>
    <br>
    <input type="text"maxlength="30" name="name" placeholder="insert recipe name or partial name..." required>
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>