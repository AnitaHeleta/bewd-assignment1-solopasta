<?php

// include the config file that we created before
require_once "../common.php";
require_once "../../config.php";

if (isset($_GET['id']) && isset($_GET['recipe_id'])) {
    try {
        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set if as variable
        $id = $_GET['id'];

        //select statement to get the right data
        $sql = "DELETE FROM recipe_ingredients WHERE id = :id";

        // prepare the connection
        $statement = $connection->prepare($sql);

        //bind the id to the PDO id
        $statement->bindValue(':id', $id);

        // now execute the statement
        $statement->execute();

        $result = "Item deleted";

        redirectTo("recipes/edit-recipe.php?id=" . $_GET['recipe_id']);

    } catch (PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>