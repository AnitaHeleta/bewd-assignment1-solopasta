<?php include "templates/header.php"; ?>

<?php

// include the config file that we created before
require_once "../config.php";

// this is called a try/catch statement
try {
    // FIRST: Connect to the database
    $connection = new PDO($dsn, $username, $password, $options);

    // SECOND: Create the SQL
    $sql = "SELECT * FROM recipes";

    // THIRD: Prepare the SQL
    $statement = $connection->prepare($sql);
    $statement->execute();

    // FOURTH: Put it into a $result object that we can access in the page
    $result = $statement->fetchAll();

} catch (PDOException $error) {
    // if there is an error, tell us what it is
    echo $sql . "<br>" . $error->getMessage();
}

?>


<h2>Results</h2>

<?php
// This is a loop, which will loop through each result in the array
foreach ($result

as $row) {
?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Name:
    <?php echo $row['type']; ?><br> Type:
    <?php echo $row['description']; ?><br> Description:
    <?php echo $row['ingredients']; ?><br> Ingredients:
    <?php echo $row['directions']; ?><br> Directions;


    <a href='update_recipe.php' .php?id=<?php echo $row['id']; ?>'>Edit</a>
</p>
<?php
    // this willoutput all the data from the array
    //echo '<pre>'; var_dump($row);
    ?>

<hr>
<?php }; //close the foreach

    ?>


<>php
<form method="post">

    <input type="submit" name="submit" value="View all">

</form>



<?php include "templates/footer.php"; ?>
