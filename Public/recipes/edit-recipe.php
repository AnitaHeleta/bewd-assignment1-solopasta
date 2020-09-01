<?php
// include the config file that we created last week
require_once "../common.php";
// run when submit button is clicked
if (isset($_POST['submit'])) {
    require_once "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $recipe_id = $_POST['id'];
        $recipes = [
            "recipe_id" => $recipe_id,
            "name" => $_POST['name'],
            "type" => $_POST['type'],
            "description" => $_POST['description'],
            "directions" => $_POST['directions']
        ];
        // create SQL statement
        $sql = "UPDATE recipes
                SET id = :recipe_id, 
                name = :name, 
                type = :type, 
                description = :description, 
                directions = :directions
                WHERE id = :recipe_id";
        $statement = $connection->prepare($sql);
        $statement->execute($recipes);
        redirectTo("recipes/view-recipe.php?id=" . $recipe_id);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

//simple if/else statement to check if the id is available
if (isset($_GET['id'])) {
    try {
        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);
        // set if as variable
        $id = $_GET['id'];
        $sql = "SELECT * FROM recipes WHERE id = :id";
        $getRecipe = $connection->prepare($sql);
        $getRecipe->bindValue(':id', $id);
        $getRecipe->execute();
        $recipe = $getRecipe->fetch();

        $sql = "SELECT * FROM recipe_ingredients WHERE recipe_id = :id";
        $getIngredients = $connection->prepare($sql);
        $getIngredients->bindValue(':id', $id);
        $getIngredients->execute();
        $ingredients = $getIngredients->fetchAll();
    } catch (PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    // no id, show error
    echo "No id - something went wrong";
    //exit;
}
?>
<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo escape($recipe['name']); ?>">
    <br>
    <label for="type">Type</label>
    <input type="text" name="type" id="type" value="<?php echo escape($recipe['type']); ?>">
    <br>
    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?php echo escape($recipe['description']); ?>">
    <h3>Ingredients</h3>
    <ul>
        <?php foreach ($ingredients as $ingredient) { ?>
            <li>
                <?php echo $ingredient['quantity']; ?>
                <?php echo $ingredient['measurement']; ?> of
                <?php echo $ingredient['ingredient']; ?>
                <a class="glyphicon glyphicon-remove"
                   href="delete-ingredient.php?id=<?php echo $ingredient["id"] ?>&recipe_id=<?php echo $id ?>"></a>
            </li>
        <?php }; //close foreach?>
    </ul>

    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" id="quantity">
    <label for="measurement">Measurement</label>
    <input type="text" name="measurement" id="measurement">
    <label for="ingredients">Ingredient</label>
    <input type="text" name="ingredient" id="ingredient">
    <input type="hidden" name="recipe_id" value="<?php echo $id ?>">
    <input type="hidden" name="edit" value="true">
    <input formaction="add-ingredients-save.php"
           formmethod="post"
           type="submit"
           name="submit"
           value="Add Ingredient">
    <br>
    <br>
    <h3>Process</h3>
    <input type="text" name="directions" id="directions" value="<?php echo escape($recipe['directions']); ?>">
    <br>
    <br>
    <input type="submit" name="submit" value="Save Recipe">
</form>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
