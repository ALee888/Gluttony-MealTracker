<!-- 
    newMeal php file
    By: Adam Lee
    Last edited: 12/6/2021
    Allows users to search the nutritional information on certain foods
-->

<?php
# Initialize the session
session_start();

# Include config file
require_once "config.php";

# food names for the search list
$sql = "SELECT food_name FROM food";
$result = $link->query($sql);
if(!$result) {
    die("Error executing query: ($mysqli->errno) $mysqli->error<br>SQL = $sql");
}

# load names into an array to be sent to Javascript function
$foodOptions = [];
while ($row = $result->fetch_row()) {
    array_push($foodOptions, $row);
}

# Add update goals button to change db to calculator values
if(isset($_POST['create_meal'])) {
    # Get user inputs
    $breakfast = $_POST["breakfast"];
    $lunch = $_POST["lunch"];
    $dinner = $_POST["dinner"];
    $snack = $_POST["snack"];
    $desert = $_POST["desert"];
    $date = $_POST["date"];

    # variables for meal nutritional information
    $meal_calories = 0;
    $meal_protein = 0;
    $meal_carbs = 0;
    $meal_fat = 0;
    $meal_sugar = 0;
    $meal_saturated_fat = 0;

    # Query user foods for nutritional information
    $sql = "SELECT serving_size, calories, protein, carbs, fat, sugar, saturated_fat from food where food_name IN ('$breakfast','$lunch', '$dinner', '$snack', '$desert', '$date');";
    $result = $link->query($sql);
    if(!$result) {
        die("Error executing query: ($link->errno) $link->error<br>SQL = $sql");
    }
    while ($row = $result->fetch_row()) {
        $meal_calories += $row[1];
        $meal_protein += $row[2];
        $meal_carbs += $row[3];
        $meal_fat += $row[4];
        $meal_sugar += $row[5];
        $meal_saturated_fat += $row[6];
    }

    # Update variables 
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO meals (user_id, breakfast, lunch, dinner, snack, desert, meal_calories, meal_protein, meal_carbs, meal_fat, meal_sugar, meal_saturated_fat, meal_date) 
            VALUES ($user_id, '$breakfast', '$lunch', '$dinner', '$snack', '$desert', $meal_calories, $meal_protein, $meal_carbs, $meal_fat, $meal_sugar, $meal_saturated_fat, '$date');";


    # Issue sql command
    if (!$link->query($sql)) {
        die("Error ($link->errno) $link->error<br>SQL = $sql\n");
    }
            
    // Should output 1
}   
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>New Meal</title>
        
        <link rel="stylesheet" href="newMeal_style.css" type="text/css"/>
        <script>
            window.onload = function () {/* 
                // Food input variables
                var breakfastInput = document.getElementById("breakfastInput");
                var lunchInput = document.getElementById("lunchInput");
                var dinnerInput = document.getElementById("dinnerInput");
                var snackInput = document.getElementById("snackInput");
                var desertInput = document.getElementById("desertInput");
                var dateInput = document.getElementById("dateInput"); */

                // List of food names available to select for meal
                var newMeal_breakfastList = document.getElementById("newMeal_breakfastList");
                var newMeal_lunchList = document.getElementById("newMeal_lunchList");
                var newMeal_dinnerList = document.getElementById("newMeal_dinnerList");
                var newMeal_snackList = document.getElementById("newMeal_snackList");
                var newMeal_desertList = document.getElementById("newMeal_desertList");
                
                // Set to empty each time window loads
                newMeal_breakfastList.innerHTML = "";
                newMeal_lunchList.innerHTML = "";
                newMeal_dinnerList.innerHTML = "";
                newMeal_snackList.innerHTML = "";
                newMeal_desertList.innerHTML = "";

                //Grab food array from php code
                var foodOptions = 
                    <?php echo json_encode($foodOptions); ?>;
                    

                //Add array foods to dropdown list
                for(var i = 0; i < foodOptions.length; i++) {
                    newMeal_breakfastList.innerHTML += ("<option name='" + foodOptions[i] + "'>" + foodOptions[i] + "</option>");
                    newMeal_lunchList.innerHTML += ("<option name='" + foodOptions[i] + "'>" + foodOptions[i] + "</option>");
                    newMeal_dinnerList.innerHTML += ("<option name='" + foodOptions[i] + "'>" + foodOptions[i] + "</option>");
                    newMeal_snackList.innerHTML += ("<option name='" + foodOptions[i] + "'>" + foodOptions[i] + "</option>");
                    newMeal_desertList.innerHTML += ("<option name='" + foodOptions[i] + "'>" + foodOptions[i] + "</option>");
                }
            };

        </script>
</head>
<body>
    <nav>
        <a href = "index.php" class="navBtn">Home</a> <br>
    </nav>
        <h1>Enter New Meal:</h1>
        <form action="" method="POST">
                <p>
                    <label for="breakfast">Breakfast:</label>
                    <select name="breakfast" id="newMeal_breakfastList">
                    </select>
                </p>
                <p>
                    <label for="lunch">Lunch:</label>
                    <select name="lunch"  id="newMeal_lunchList">
                    </select>
                </p>
                <p>
                    <label for="dinner">Dinner:</label>
                    <select name="dinner" id="newMeal_dinnerList">
                    </select>
                </p>
                <p>
                    <label for="snack">Snacks:</label>
                    <select name="snack" id="newMeal_snackList">
                    </select>
                </p>
                <p>
                    <label for="desert">Desert:</label>
                    <select name="desert" id="newMeal_desertList">
                    </select>
                </p>
                <div>
                    <label for="date">Set date:</label>
    
                    <input type="date" id="dateInput" name="date" required pattern="\d{2}/\d{2}/\d{4}"
                           value="2021-12-06"
                           min="2021-01-01" max="2022-12-31">
                </div>    
                <input type="submit" name="create_meal" value="New Meal">
            </form>
</body>

</html>