<?php
require_once "../common.php";
session_start();
if (isset($_POST['submit'])) {
    require_once "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $recipe_id = $_POST['recipe_id'];
        $new_ingredient = array(
            "recipe_id" => $recipe_id,
            "quantity" => $_POST ['quantity'],
            "measurement" => $_POST ['measurement'],
            "ingredient" => $_POST ['ingredient'],
        );

        $sql = "INSERT INTO recipe_ingredients(recipe_id, ingredient, quantity, measurement) VALUES (:recipe_id, :ingredient, :quantity, :measurement)";
        $insert_ingredient = $connection->prepare($sql);
        $insert_ingredient->execute($new_ingredient);
        if(isset($_POST["edit"])){
            redirectTo("recipes/edit-recipe.php?id=" . $recipe_id);
        } else{
            redirectTo("recipes/add-ingredients.php?id=" . $recipe_id);
        }
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    redirectTo("recipes/add-recipe.php");
}
?>



