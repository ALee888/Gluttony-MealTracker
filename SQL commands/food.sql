CREATE TABLE food (
	food_id INT NOT NULL AUTO_INCREMENT,
    food_name VARCHAR(50) NOT NULL,
    serving_size VARCHAR(50),
    calories INT NOT NULL,
    protein INT NOT NULL,
    carbs INT NOT NULL,
    fat INT NOT NULL,
    sugar INT NOT NULL,
    saturated_fat INT,
    PRIMARY KEY(food_id)
);

INSERT INTO food (food_name, serving_size, calories, protein, carbs, fat, sugar, saturated_fat) VALUES
	('apple', '1 fruit', 65, 0.3, 17, 0.2, 13, 0),
    ('avacado', '1 cup', 368, 4.6, 20, 34, 1.5, 4.9),
    ('bacon', '1 strip (12g)', 54,  3.9, 0.2, 4, 0, 1.4),
    ('beer', '1 can (12 oz)', 155, 1.7, 13, 0, 0, 0),
    ('wheat bread', '1 slice', 75, 3.1, 14, 1.3, 1.7, 0.2), 
    ('white bread', '1 slice', 76, 2.6, 14, 1, 1.5, 0.2),
    ('carrots', '1 cup (128g)', 52, 1.2, 12, 0.3, 6.1, 0),
    ('corn flakes', '1 cup (25g)', 89, 1.9, 21, 0.1, 2.4, 0),
    ('chicken breast', '1 serving (56g)', 75, 8.2, 1, 4.3, 0.2, 1.4),
    ('donuts', '3 donuts', 220, 2, 22, 14, 11, 8),
    ('eggs', '1 egg (50g)', 72, 6.3, 0.4, 4.8, 0.2, 1.6),
    ('salmon', '1 cup (166g)', 211, 34, 0, 7.3, 0, 1.3),
    ('green beans', '1 cup (100g)', 31, 1.8, 7, 0.2, 3.3, 0.1),
    ('hamburger', '1 hamburger', 418, 25, 30, 21, 4.4, 8),
    ('cheeseburger', '1 cheeseburger', 490, 30, 31, 27, 4.8, 11),
    ('ice cream', '1 scoop (120g)', 248, 4.2, 28, 13, 25, 8.1),
    ('jelly/jam', '1 tbsp (21)', 56, 0, 15, 0, 11, 0),
    ('milk', '1 cup', 172, 2.5, 17, 11, 17, 4.9),
    ('noodles', '1 cup (160g)', 219, 7.2, 40, 3.3, 0.6, 0.7),
    ('pizza', '1 slice', 280, 12, 30, 13, 3.2, 5.2),
    ('chicken quesadilla', '1 quesadilla', 514, 23, 46, 27, 3.6, 12),
    ('steak', '1 steak (221g)', 614, 58, 0, 41, 0, 16),
    ('wine', '1 glass', 153, 0.1, 4.7, 0, 1.1, 0);