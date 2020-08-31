<?php
session_start();
require_once "../config.php";

// this is called a try/catch statement
try {
    // FIRST: Connect to the database
    $connection = new PDO($dsn, $username, $password, $options);

    $userId = $_SESSION["id"];
    // SECOND: Create the SQL
    #Find all recipes
    $sql = "SELECT * FROM recipes where user_id = :user_id";

    // THIRD: Prepare the SQL
    $statement = $connection->prepare($sql);
    $statement->bindValue(':user_id', $userId);

    $statement->execute();

    // FOURTH: Put it into a $result object that we can access in the page
    $result = $statement->fetchAll();

} catch (PDOException $error) {
    // if there is an error, tell us what it is
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>
<h2>My Recipes <a class="glyphicon glyphicon-plus" href="recipes/add-recipe.php"></a></h2>

</br>
<?php if ($result && $statement->rowCount() > 0) { ?>
    <?php foreach ($result as $row) { ?>
        <p>
            Recipe Name: <?php echo $row['name']; ?>
            <a class="glyphicon glyphicon-eye-open"
               href="recipes/view-recipe.php?id=<?php echo $row["id"] ?>" ></a>
            <a class="glyphicon glyphicon-edit"
               href="recipes/edit-recipe.php?id=<?php echo $row["id"] ?>" ></a>
            <a class="glyphicon glyphicon-remove"
               href="recipes/delete-recipe.php?id=<?php echo $row["id"] ?>"
               onclick="return confirm('Are you sure you want to delete recipe: \'<?php echo $row["name"]?>\'')" ></a>
        </p>
    <?php } //close the foreach
}
?>
<?php include "templates/footer.php"; ?>
