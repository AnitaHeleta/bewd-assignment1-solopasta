<?php
require_once "../common.php";
require_once "../../config.php";

if (isset($_GET['id']) && isset($_GET['recipe_id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $sql = "DELETE FROM recipe_ingredients WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        redirectTo("recipes/edit-recipe.php?id=" . $_GET['recipe_id']);
    } catch (PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>