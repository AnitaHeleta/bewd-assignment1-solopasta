<?php
session_start();
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
// include the config file that we created before
    require "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_recipe = array(
            "name" => $_POST['name'],
            "type" => $_POST['type'],
            "description" => $_POST['description'],
            "directions" => $_POST ['directions'],
            "userId" => $_SESSION["id"]
        );

        $sql = "INSERT INTO recipes (name, type, description, directions, user_id) VALUES (:name, :type, :description, :directions, :userId)";
        $insert_recipe = $connection->prepare($sql);
        $insert_recipe->execute($new_recipe);

        $recipe_id = $connection->lastInsertId();

        header("location: add-ingredients.php?id=" . $recipe_id );
    } catch (PDOException $error) {
        $connection->rollBack();
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include "../templates/header.php"; ?>

<h2>Add a Recipe</h2>

<!--form to collect data for each recipe-->
<form method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <br>
    <label for="type">Type</label>
    <input type="text" name="type" id="type">
    <br>
    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    <br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php include "../templates/footer.php"; ?>
