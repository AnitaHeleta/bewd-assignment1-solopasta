<?php
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
// include the config file that we created before
require "../../config.php";
// this is called a try/catch statement
try {
// FIRST: Connect to the database
$connection = new PDO($dsn, $username, $password, $options);

// SECOND: Get the contents of the form and store it in an array
    
$new_recipe = array(
"name" => $_POST['name'],
"type" => $_POST['type'],
"description" => $_POST['description'],
"directions" => $_POST ['directions'],
);

// THIRD: Turn the array into a SQL statement
$sql = "INSERT INTO recipes (name, type, description, directions) VALUES (:name, :type, :description, :directions)";

// FOURTH: Now write the SQL to the database
$statement = $connection->prepare($sql);
$statement->execute($new_recipe);
} catch(PDOException $error)

{
// if there is an error, tell us what it is
echo $sql . "<br>" . $error->getMessage();
}
}
?>
<?php include "../templates/header.php"; ?>

<h2>Add a Recipe</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<?php   header("location: ../recipes.php"); ?>
<?php } ?>

<!--form to collect data for each recipe-->
<form method="post">

    <label for="name">Recipe Name</label>
    <input type="text" name="name" id="name">

    <label for="type">Type</label>
    <input type="text" name="type" id="type">

    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    
    <label for="ingedients">Ingredients</label>
    <input type="text" name="description" id="description">

    <label for="directions">Directions</label>
    <input type="text" name="directions" id="directions">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "../templates/footer.php"; ?>
