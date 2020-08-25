<?php include "../templates/header.php"; ?>

<?php 

    // include the config file that we created last week
    require "../../config.php";

require "../common.php";

   // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
             //grab elements from form and set as varaible
             
            } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        
           $recipes =[
      "id"         => $_POST['id'],
      "name"        => $_POST['name'],
      "type"        => $_POST['type'],
      "description"   => $_POST['description'],
      "directions" => $_POST['directions'],
      "date"   => $_POST['date'],
    ];

    // create SQL statement
    $sql = "UPDATE `recipes` 
            SET id = :id, 
                name = :name, 
                type = :type, 
                description = :description, 
                directions = :directions, 
                date = :date 
            WHERE id = :id";

    //prepare sql statement
    $statement = $connection->prepare($sql);

    //execute sql statement
    $statement->execute($recipes);
        
        echo "<p>Edit Successful!</p>";
        
    }

    //simple if/else statement to check if the id is available
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
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

        
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    }
?>

<form method="post">
    
 <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="type">Name</label>
    <input type="text" name="name" id="name" value="<?php echo escape($work['name']); ?>">

    <label for="type">Type</label>
    <input type="text" name="type" id="type" value="<?php echo escape($work['type']); ?>">

    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?php echo escape($work['description']); ?>">

    <label for="directions">Directions</label>
    <input type="text" name="directions" id="directions" value="<?php echo escape($work['directions']); ?>">
    
    
    <label for="date">Date</label>
    <input type="text" name="date" id="date" value="<?php echo escape($work['date']); ?>">

    <input type="submit" name="submit" value="Save">
    
</form>

<?php include "../templates/footer.php"; ?>