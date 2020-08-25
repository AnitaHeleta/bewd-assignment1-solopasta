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
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $recipe = $statement->fetch();
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
} else {
    header('location: index.html');
}
?>


<?php include "../templates/header.php"; ?>

<?php  if ($recipe && $statement->rowCount() == 1) { ?>

<p>
    ID: <?php echo $recipe["id"]; ?><br>
    Recipe Name: <?php echo $recipe['name']; ?><br>
    Description: <?php echo $recipe['description']; ?><br>

</p>
<hr>

<?php }; //close the foreach
?>
<?php include "../templates/footer.php"; ?>
