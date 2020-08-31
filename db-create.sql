CREATE DATABASE solo_pasta;
use solo_pasta;

CREATE TABLE recipes (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    user_id INT,
	name VARCHAR(250),
    type VARCHAR(50),
    description VARCHAR(250),
    directions VARCHAR (1000),
	date TIMESTAMP
);

CREATE TABLE recipe_ingredients (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT(10) NOT NULL,
    quantity DECIMAL(10,3) NOT NULL,
	measurement VARCHAR(50) NOT NULL,
    ingredient VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);