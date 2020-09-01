<?php
require_once "../common.php";
session_start();
// this code will only execute after the submit button is clicked
if (!isset($_GET['id'])) {
    redirectTo("recipes/add-recipe.php");
}
if (isset($_POST['submit'])) {
// include the config file that we created before
    require_once "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $recipe_id = $_GET['id'];
        $args = array(
            "id" => $recipe_id,
            "directions" => $_POST ['process']
        );
        $sql = "UPDATE recipes set directions = :directions where id = :id";
        $add_directions = $connection->prepare($sql);
        $add_directions->execute($args);
        redirectTo("recipes/view-recipe.php?id=" . $recipe_id);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "../templates/html_head.php"; ?>
<?php include "../templates/header.php"; ?>
<div class="row">
    <div class="col">
        <h3>Process</h3>
        <form method="post" role="form" data-toggle="validator">
            <div class="form-group">
                <label for="process"></label>
                <br>
                <textarea rows="5" cols="50" maxlength="1000" name="process" id="process" placeholder="Process" type="text" value="" required="required" data-error="Please enter a Process"></textarea>
                <br>
                 <input type="submit" name="submit" value="Submit">
                <div class="help-block with-errors"></div>
            </div>
        </form>
    </div>
</div>
<?php include "../templates/footer.php"; ?>
<?php include "../templates/html_foot.php"; ?>
