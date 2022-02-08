<!-- 
    macronutrient goal calculator php file
    By: Adam Lee
    Last edited: 12/6/2021
    Page to calculate and update user health goals based on user personal information
-->
<?php
    session_start();

    # Include config file
    require_once "config.php";
    
    # Variables
    $goal_id = $calories = $protein = $carbs = $fat = $sugar = $saturated_fat = 0;
    
    # See if a current goal exists already based on user_id
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT goal_id, calories, protein, carbs, fat, sugar, saturated_fat FROM goals WHERE user_id=$user_id";

    $result = $link->query($sql);

    if (!$result) {
        die("Error executing query: ($link->errno) $link->error<br>SQL = $sql");
    } else {
        # fetch_row retrieves all rows in an array
        
        while ($row = $result->fetch_row()) {
            $goal_id = $_SESSION["goal_id"] = $row[0];
            $calories = $_SESSION["goal_calories"] = $row[1];
            $protein = $_SESSION["goal_protein"] = $row[2];
            $carbs = $_SESSION["goal_carbs"] = $row[3];
            $fat = $_SESSION["goal_fat"] = $row[4];
            $sugar = $_SESSION["goal_sugar"] = $row[5];
            $saturated_fat = $_SESSION["goal_saturated_fat"] = $row[6];
        }

    }
    # Add update goals button to change db to calculator values
    if(isset($_POST['update'])) {
        $calories = $_POST["calories"];
        $protein = $_POST["protein"];
        $carbs = $_POST["carbs"];
        $fat = $_POST["fat"];
        $sugar = $_POST["sugar"];
        $saturated_fat = $_POST["saturated_fat"]; 
        # Update variables 
        $sql = "UPDATE goals Set calories = $calories, protein = $protein, carbs = $carbs, fat = $fat, sugar = $sugar, saturated_fat = $saturated_fat WHERE user_id = $user_id";

        # Issue sql command
        if (!$link->query($sql)) {
            die("Error ($link->errno) $link->error<br>SQL = $sql\n");
        }
    }   
    # Query: insert into goals 
    #insert into goals (user_id, calories, protein, carbs, fat, sugar, saturated_fat) values (3, 100, 200, 300, 400, 500, 600);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Macro calculator</title>

    <link rel="stylesheet" href="calculator_style.css" type="text/css"/>

    <script>
        window.onload = function() {
            var ageInput = document.getElementById("age");
            var genderInput = document.getElementById("gender");
            var heightInput = document.getElementById("height");
            var weightInput = document.getElementById("weight");
            var activityInput = document.getElementById("activity");
            var calculateButton = document.getElementById("calculateButton");
            var caloriesOutput = document.getElementById("calories");
            var proteinOutput = document.getElementById("protein");
            var carbsOutput = document.getElementById("carbs");
            var fatOutput = document.getElementById("fat");
            var sugarOutput = document.getElementById("sugar");
            var saturated_fatOutput = document.getElementById("saturated_fat");



            calculateButton.addEventListener("click", function() {
                var calories = getTargetMacros(ageInput.value, genderInput.value, heightInput.value, weightInput.value, activityInput.value, "none");
                macros = getMacroGoals(calories, "none");
                var protein = macros[0];
                var carbs = macros[1];
                var fat = macros[2];
                var sugar = macros[3];
                var saturated_fat = macros[4];
                caloriesOutput.value = calories;
                proteinOutput.value = protein;
                carbsOutput.value = carbs;
                fatOutput.value = fat;
                sugarOutput.value = sugar;
                saturated_fatOutput.value = saturated_fat;

            });
            //Calculate user's desired target macros
            function getTargetMacros(age, gender, height_in, weight_lb, activity, goal) {
                //Variables
                var calories = 0;
                weight_kg = weight_lb / 2.2046;
                height_cm = height_in * 2.54; 
                // Calculate desired calories
                if (gender == "male") {
                    calories = 10 * weight_kg + 6.25 * height_cm - 5 * age + 5;
                    if (activity == "sedentary") {
                        calories = calories * 1.2;
                    }
                    else if (activity == "lightActivity") {
                        calories = calories * 1.375;
                    }
                    else if (activity == "moderateActivity") {
                        calories = calories * 1.55;
                    }
                    else if (activity == "heavyActivity") {
                        calories = calories * 1.725;
                    }
                    else if (activity == "extraActivity") {
                        calories = calories * 1.9;
                    }
                }
                else if (gender == "female") {
                    calories = 10 * weight_kg + 6.25 * height_cm - 5 * age - 161;
                    if (activity == "sedentary") {
                        calories = calories * 1.2;
                    }
                    else if (activity == "lightActivity") {
                        calories = calories * 1.375;
                    }
                    else if (activity == "moderateActivity") {
                        calories = calories * 1.55;
                    }
                    else if (activity == "heavyActivity") {
                        calories = calories * 1.725;
                    }
                    else if (activity == "extraActivity") {
                        calories = calories * 1.9;
                    }

                }
                return calories;
                // Break down calorie limit into macros based on goals
            };

            function getMacroGoals(calories, goal){
                //45–65% of your daily calories from carbs, 20–35% from fats and 10–35% from protein
                //Will iron this formula out through testing
                var protein = calories * .30;
                var carbs = calories * .50;
                var fat = calories * .20;
                var sugar = (calories * .10) / 4; //Daily sugar (g)
                var saturated_fat = (calories * .10) /9; //daily satfats (g)
                console.log(protein + "/" + carbs + "/" + fat + "/" + sugar + "/" + saturated_fat);
                return [protein, carbs, fat, sugar, saturated_fat];
            }
        };
            
    </script>
</head>

<body>
    <nav>
        <a href = "index.php" class="navBtn">Home</a> <br>
    </nav>
    <main class="container">
        <form>
            <h2>Macro Calculator</h2>
            <p>
                <label for="age">Age:</label>
                <input type="text" name="age" id="age">
            </p> 
            <br>
            <div>
                Gender:
                <input type="radio" name="gender" id="gender" value="male">
                <label for="gender">male</label>

                <input type="radio" name="gender" id="gender" value="female">
                <label for="gender">female</label>
            </div>
            <br>
            <p>
                <label for="height">Height(inches):</label>
                <input type="text" name="height" id="height">
            </p>
            <br>
            <p>
                <label for="weight">Weight(lb):</label>
                <input type="text" name="weight" id="weight">
            </p>
            <br>    
            <div>
                <select name="activity" id = "activity">
                    <option value="sedentary">Sedentary</option>
                    <option value="lightActivity">Light Activity</option>
                    <option value="moderateActivity">Moderate Activity</option>
                    <option value="heavyActivity">Heavy Activity</option>
                    <option value="extraActivity">Extra Activity</option>
                </select>
            </div>
            <br>
        
            <!-- keep first and last name input text fields-->
            <input class="navBtn" type="button" value="calculate" id="calculateButton">
        </form>
        <form action="" method="POST">
            <h2> Results: </h2>
            <p>
                <label for="calories">Calories:</label>
                <input type="text" name="calories" id="calories">
            </p>
            <br>
            <p>
                <label for="protein">Protein:</label>
                <input type="text" name="protein" id="protein">
            </p>
            <br>
            <p>
                <label for="carbs">Carbs:</label>
                <input type="text" name="carbs" id="carbs">
            </p>
            <br>
            <p>
                <label for="fat">Fat:</label>
                <input type="text" name="fat" id="fat">
            </p>
            <br>
            <p>
                <label for="sugar">Sugar:</label>
                <input type="text" name="sugar" id="sugar">
            </p>
            <br>
            <p>
                <label for="saturated_fat">Saturated Fat:</label>
                <input type="text" name="saturated_fat" id="saturated_fat">
            </p>
            <br>
            <input class="navBtn" type="submit" value="Update Goal" name="update">
            
        </form>
    </main>

</body>

</html>