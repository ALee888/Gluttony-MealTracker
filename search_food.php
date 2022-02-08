<!-- 
    Search_food php file
    By: Adam Lee
    Last edited: 12/6/2021
    Allows users to search the nutritional information on database foods
-->

<?php
# Initialize the session
session_start();

# Include config file
require_once "config.php";

# Query string for all foods in the database
$sql = "SELECT * FROM food";
$result = $link->query($sql);
if(!$result) {
    die("Error executing query: ($link->errno) $link->error<br>SQL = $sql");
}

# load names into an array to be sent to Javascript function
$foodOptions = [];
$foodData = []; // In future would make this better
while ($row = $result->fetch_row()) {
    array_push($foodOptions, $row[1]);
    array_push($foodData, $row);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Food</title>
    <link rel="stylesheet" href="search_food.css" type="text/css"/>
    <script>
        window.onload = function() {
            // PHP variables to use in search_food.js
            var foodOptions = <?php echo json_encode($foodOptions); ?>;
            var foodData = <?php echo json_encode($foodData); ?>;
            // Search food functionality

            //Variables
            var foodList = document.getElementById("foodList");
            var searchButton = document.getElementById("search");
            var myFood = document.getElementById("myFood");
            var foodInfo = document.getElementById("foodInfo");

            //Add array foods to dropdown list
            for(var i = 0; i < foodOptions.length; i++) {
                foodList.innerHTML += ("<option value='" + foodOptions[i] + "'>");
            }
            // Search food button functionality
            searchButton.addEventListener("click", function(){
                
                // Identify food based off input
                for (var i = 0; i < foodData.length; i++) {
                    if (myFood.value == foodData[i][1]) {
                        var foodHTML = "";
                        foodHTML = foodHTML + "Food: " + foodData[i][1] + "<br>Serving size: " + foodData[i][2] + "<br>Calories: " + foodData[i][3] + "<br>Protein: " + foodData[i][4] + "<br>Carbs: " + foodData[i][5] + "<br>Fat: " + foodData[i][6] + "<br>Sugar: " + foodData[i][7] + "<br>Saturated_fat: " + foodData[i][8];
                        foodInfo.innerHTML = foodHTML;
                    }
                }
            })
        }
    </script>
</head>
<body>
        <nav>
            <a href = "index.php" class="navBtn">Home</a> <br>
        </nav>
    <form>
        <h1>Search for a food</h1>
        <label>Choose a food from this list:
        
        <input list="foodList" id="myFood" name="myFood"/></label>
        <datalist id="foodList">
            
        </datalist>
        <input type="button" id="search" value="search" name="search">
        <br>
        <h3>Nutritional_information</h3>
        <p class="nutritional_info" id="foodInfo"> </p>
    </form>
</body>
</html>
        