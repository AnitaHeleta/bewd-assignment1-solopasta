<?php
session_start();
if (isset($_POST['submit'])) {
// include the config file that we created before
    require_once "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $search_by = $_POST['search_by'];
        $search = array(
            "name" => $_POST['name'],
            "userId" => $_SESSION["id"],
        );
        if($search_by == 'name'){
            $sql = "select r.id, r.name from recipes r where user_id = :userId AND name LIKE CONCAT('%', :name, '%')";
        }else{
            $sql = "select distinct r.name, r.id from recipes r  join recipe_ingredients where user_id = :userId AND name LIKE CONCAT('%', :name, '%')";
        }
        $getRecipes = $connection->prepare($sql);
        $getRecipes->execute($search);
        $recipes = $getRecipes->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
    <!-- HTML DOC-->
<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<?php if ($recipes && $getRecipes->rowCount() > 0) { ?>
    <div class="row">
        <div class="col">
            <h3>Search Results</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Recipe Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recipes as $recipe) { ?>
                    <tr>
                        <th><?php echo $recipe['name']; ?></th>
                        <th>
                            <a class="glyphicon glyphicon-eye-open"
                               href="view-recipe.php?id=<?php echo $recipe["id"] ?>"></a>
                        </th>
                    </tr>
                <?php }  //close the foreach ?>
                </tbody>
            </table>
            </ul>
        </div>
    </div>
<?php } else { ?>
    <h3>No Results</h3>
<?php } ?>

<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>