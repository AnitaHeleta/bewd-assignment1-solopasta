/* creating three tables, Recipes, Measurement Unit and Ingredients. The fourth table is creating by joining the elements to the Recipe Ingredients table*/
/*recipe name, type (veg, meat, seafood), with a short descriptionn */


CREATE DATABASE solo_pasta;
use solo_pasta;

CREATE TABLE recipes (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(100),
    type VARCHAR(50),
    description VARCHAR(80),
    directions VARCHAR (200),
	date TIMESTAMP
);

/* the joining table*/

CREATE TABLE recipe_ingredients (
    recipe_id INT(10),
	measurement_id VARCHAR(10) NOT NULL,
    quantity DECIMAL(10,3),
    ingredient_id INT(10),
	date TIMESTAMP
);

/*measurements*/

CREATE TABLE measurement_units (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
    description VARCHAR(80) NOT NULL,
	date TIMESTAMP
);

*/list of ingredients8/

CREATE TABLE ingredients (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	ingredient_name VARCHAR(80) NOT NULL,
	date TIMESTAMP
);


CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);



#Find all recipes and ingredients.
select recipes.name, 
recipes.type, 
recipes.description, directions 
recipe_ingredients.quantity, 
measurement_units.description,
ingredients.ingredient_name
from recipes
join recipe_ingredients
join measurement_units
join ingredients


#FIND INGREDIENTS GIVEN A RECIPE ID
select recipe_ingredients.quantity, 
measurement_units.description, directions
ingredients.ingredient_name
from recipe_ingredients
join measurement_units
on recipe_ingredients.measurement_id=measurement_units.id
join ingredients
on recipe_ingredients.ingredient_id = ingredients.id
where recipe_ingredients.recipe_id = 1