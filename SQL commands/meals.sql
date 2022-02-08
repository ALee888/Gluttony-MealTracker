CREATE TABLE meals (
	meal_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    breakfast VARCHAR(50),
    lunch VARCHAR(50),
    dinner VARCHAR(50),
    snack VARCHAR(50),
    desert VARCHAR(50),
    meal_calories INT NOT NULL,
    meal_protein INT NOT NULL,
    meal_carbs INT NOT NULL,
    meal_fat INT NOT NULL,
    meal_sugar INT NOT NULL,
    meal_saturated_fat INT NOT NULL,
    meal_date DATE NOT NULL,
    PRIMARY KEY(meal_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);