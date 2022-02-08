CREATE TABLE goals (
	goal_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    calories INT NOT NULL,
    protein INT NOT NULL,
    carbs INT NOT NULL,
    fat INT NOT NULL,
    sugar INT NOT NULL,
    saturated_fat INt NOT NULL,
    PRIMARY KEY(goal_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);