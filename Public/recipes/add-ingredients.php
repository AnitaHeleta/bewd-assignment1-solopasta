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
<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<div class="row">
    <div class="col">
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
        <form action="add-ingredients-save.php" method="post" rule="form" data-toggle="validator">
           <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" type="number" value="" required="required" data-error="Please enter a quantity">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="measurement">Measurement</label>
                <input type="text" name="measurement" id="measurement" type="text" value="" required="required" data-error="Please enter measurement">
                 <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredient</label>
                <input type="text" name="ingredient" id="ingredient" type="text" value="" required="required" data-error="Please enter an ingredient">
                <div class="help-block with-errors"></div>
            </div>
            <input type="hidden" name="recipe_id" value="<?php echo $id ?>">
            <br>
            <input type="submit" name="submit" value="Add Ingredient">
        </form>
        <a c href="<?php echo "add-directions.php?id=" . $id ?>">No More Ingredients</a>
    </div>
</div>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
