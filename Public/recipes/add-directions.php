<?php
session_start();
// this code will only execute after the submit button is clicked
if(!isset($_GET['id'])){
    header("location: add-recipe.php");
}
if (isset($_POST['submit'])) {
// include the config file that we created before
    require "../../config.php";
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
        header("location: view-recipe.php?id=" . $recipe_id);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include "../templates/header.php"; ?>

<h2>Directions</h2>
<form method="post">
    <input type="text" name="directions" id="directions">
    <input type="submit" name="submit" value="Submit">
</form>

<?php include "../templates/footer.php"; ?>
