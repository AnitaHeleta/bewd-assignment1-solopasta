<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<!-- [SEARCH FORM] -->
<form method="post" action="search-results.php">
    <br>
    <label for="name">Search By...</label>
    <br>
    <input type="radio" id="name" name="search_by" value="name">
    <label for="name">Recipe Name</label><br>
    <input type="radio" id="ingredient" name="search_by" value="ingredient">
    <label for="female">Ingredient</label><br>
    <br>
    <input type="text"maxlength="30" name="name" placeholder="keyword..." required>
    <br>
    <input type="submit" name="submit" value="Search">
</form>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>