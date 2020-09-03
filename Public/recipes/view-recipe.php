<?php
require_once "../../config.php";
if (isset($_GET['id'])) {
    try {
        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set if as variable
        $id = $_GET['id'];

        //select statement to get the right data
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
    header('location: index.html');
}
?>
<!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<?php if ($recipe && $getRecipe->rowCount() == 1) { ?>
    <div class="row">
        <div class="col">
            <h2><?php echo $recipe['name'] ?></h2>
            <div class="type"
            <p><?php echo $recipe['type']; ?></p>
            </div>
            <div class="description"
            <p><?php echo $recipe['description']; ?></p>
            </div>
            <h3>Ingredients</h3>
            <ul>
                <?php foreach ($ingredients as $ingredient) { ?>
                    <li>
                        <?php echo $ingredient['quantity'] + 0; ?>
                        <?php echo $ingredient['measurement']; ?> of
                        <?php echo $ingredient['ingredient']; ?>
                    </li>
                <?php }; //close foreach?>
            </ul>

            <h3>Process</h3>
            <p><?php echo $recipe['directions']; ?></p>
        </div>
    </div>
<?php }; //close if?>

<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
