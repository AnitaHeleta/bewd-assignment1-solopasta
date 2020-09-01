<?php
require_once "../common.php";
session_start();
// this code will only execute after the submit button is clicked
if (!isset($_GET['id'])) {
    redirectTo("recipes/add-recipe.php");
}
// include the config file that we created before
require_once "../../config.php";
$id = $_GET['id'];
try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM recipe_ingredients WHERE recipe_id = :id";
    $getIngredients = $connection->prepare($sql);
    $getIngredients->bindValue(':id', $id);
    $getIngredients->execute();
    $ingredients = $getIngredients->fetchAll();
} catch (PDOException $error) {
    $connection->rollBack();
    echo $sql . "<br>" . $error->getMessage();
}
?>
<!doctype html>
<html lang="en">
<?php include "../templates/header.php"; ?>
<body>
<h3>Ingredients</h3>
<ul>
    <?php foreach ($ingredients as $ingredient) { ?>
        <li>
            <?php echo $ingredient['quantity']; ?>
            <?php echo $ingredient['measurement']; ?> of
            <?php echo $ingredient['ingredient']; ?>
        </li>
    <?php }; //close foreach?>
</ul>
<!--form to collect data for each recipe-->
<form action="add-ingredients-save.php" method="post">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="quantity">
    <br>
    <label for="measurement">Measurement</label>
    <input type="text" name="measurement" id="measurement">
    <br>
    <label for="ingredients">Ingredient</label>
    <input type="text" name="ingredient" id="ingredient">
    <input type="hidden" name="recipe_id" value="<?php echo $id ?>">
    <br>
    <input type="submit" name="submit" value="Add Ingredient">
</form>
<a c href="<?php echo "add-directions.php?id=" . $id ?>">No More Ingredients</a>
<?php include "../templates/footer.php"; ?>
</body>
</html>