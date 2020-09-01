<?php
require_once "../common.php";
session_start();
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
// include the config file that we created before
    require_once "../../config.php";
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

        redirectTo("recipes/add-ingredients.php?id=" . $recipe_id);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<div class="row">
    <div class="col">
        <h3>Add a Recipe</h3>
        <!--form to collect data for each recipe-->
        <form method="post" role="form" data-toggle="validator">
            <div class="form-group">
                <label for="name">Name: </label>
                <input name="name" id="name" placeholder="Recipe name" type="text" value="" required="required" data-error="Please enter a recipe">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="type">Type: </label>
                <input name="type" id="type" placeholder="type" type="text" value="" maxlength="30" required="required" data-error="Please enter a type.">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="description">Description: </label>
                <br>
                <textarea rows="5" cols="50" maxlength="250" name="description" id="description" placeholder="Description" type="text" value="" required="required" data-error="Please enter a description."></textarea>
                <div class="help-block with-errors"></div>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
