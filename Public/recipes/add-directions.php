<?php
require_once "../common.php";
session_start();
// this code will only execute after the submit button is clicked
if (!isset($_GET['id'])) {
    redirectTo("recipes/add-recipe.php");
}
if (isset($_POST['submit'])) {
// include the config file that we created before
    require_once "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $recipe_id = $_GET['id'];
        $args = array(
            "id" => $recipe_id,
            "directions" => $_POST ['directions']
        );
        $sql = "UPDATE recipes set directions = :directions where id = :id";
        $add_directions = $connection->prepare($sql);
        $add_directions->execute($args);
        redirectTo("recipes/view-recipe.php?id=" . $recipe_id);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<div class="row">
    <div class="col">
        <h3>Process</h3>
        <form method="post">
            <input type="text" name="directions" id="directions">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
