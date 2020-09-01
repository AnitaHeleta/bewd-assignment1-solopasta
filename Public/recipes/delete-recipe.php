<?php
require_once "../common.php";
require_once "../../config.php";

if (isset($_GET['id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $sql = "DELETE FROM recipes WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        redirectTo("recipes.php");
    } catch (PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>