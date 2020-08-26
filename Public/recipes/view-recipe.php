<?php

require "../../config.php";


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

<?php include "../templates/header.php"; ?>

<?php if ($recipe && $getRecipe->rowCount() == 1) { ?>

    <h2><?php echo $recipe['name']; ?></h2>
    <p>Type: <?php echo $recipe['type']; ?><p>
    <p>Description: <?php echo $recipe['description']; ?><p>
    <h2>Ingredients</h2>
    <ul>
        <?php foreach ($ingredients as $ingredient) { ?>
            <li>
                <?php echo $ingredient['quantity']; ?>
                <?php echo $ingredient['measurement']; ?> of
                <?php echo $ingredient['ingredient']; ?>
            </li>
        <?php }; //close foreach?>
    </ul>

    <h2>Process</h2>
    <p><?php echo $recipe['directions']; ?></p>
<?php }; //close if?>
<?php include "../templates/footer.php"; ?>
