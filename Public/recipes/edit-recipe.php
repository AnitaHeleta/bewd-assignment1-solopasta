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
        <br>
        <label for="directions">Directions</label>
        <input type="text" name="directions" id="directions" value="<?php echo escape($recipe['directions']); ?>">
        <br>
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
        <input type="submit" name="submit" value="Save">
        </form>
    </form>


<?php include "../templates/footer.php"; ?>