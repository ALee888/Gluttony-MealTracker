<!-- 
    MealInfo php file
    By: Adam Lee
    Last edited: 12/6/2021
    Allows users to view selected meal and see nutritional information on certain foods
-->
<?php
        function validate_date($date) {
            $dt = DateTime::createFromFormat("Y-m-d", $date);
            return $dt !== false && !array_sum($dt::getLastErrors());
        }
        session_start();
        # Include config file
        require_once "config.php";
        
        # Variables
        $date = $_GET['date'];
        if (!validate_date($date)) {
            echo "NOOOOOOOO";
            header("Location: index.php");
        }
        $sql = "SELECT breakfast, lunch, dinner, snack, desert, meal_calories, meal_protein, meal_carbs, meal_fat, meal_sugar, meal_saturated_fat FROM meals WHERE meal_date='$date';";
        
        $result = $link->query($sql);
        if(!$result) {
            die("Error executing query: ($link->errno) $link->error<br>SQL = $sql");
        } else {
            while ($row = $result->fetch_row()) {
                $breakfast= $row[0];
                $lunch= $row[1];
                $dinner= $row[2];
                $snack= $row[3];
                $desert= $row[4];
                $total_calories= $row[5];
                $total_protein= $row[6];
                $total_carbs= $row[7];
                $total_fat= $row[8];
                $total_sugar= $row[9];
                $total_saturated_fat= $row[10];
            }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Meal Info</title>
    <link rel="stylesheet" href="mealInfo_style.css" type="text/css"/>
    <script>
        //On window load
        window.onload = function () {
            // PHP variables
            var goal_calories = <?php echo $_SESSION['goal_calories']?>;
            var goal_protein = <?php echo $_SESSION['goal_protein']?>;
            var goal_carbs = <?php echo $_SESSION['goal_carbs']?>;
            var goal_fat = <?php echo $_SESSION['goal_fat']?>;
            var goal_sugar = <?php echo $_SESSION['goal_sugar']?>;
            var goal_saturated_fat = <?php echo $_SESSION['goal_saturated_fat']?>;
            
            var total_calories = <?php echo $total_calories?>;
            var total_protein = <?php echo $total_protein?>;
            var total_carbs = <?php echo $total_carbs?>;
            var total_fat = <?php echo $total_fat?>;
            var total_sugar = <?php echo $total_sugar?>;
            var total_saturated_fat = <?php echo $total_saturated_fat?>;

            calories = (total_calories/goal_calories)*100;
            protein = (total_protein/goal_protein)*100;
            carbs = (total_carbs/goal_carbs)*100;
            fat = (total_fat/goal_fat)*100;
            sugar = (total_sugar/goal_sugar)*100;
            saturated_fat = (total_saturated_fat/goal_saturated_fat)*100;
            //bar graph variables
            var elem_calories = document.getElementById("myBar_calories");
            var elem_protein = document.getElementById("myBar_protein");
            var elem_carbs = document.getElementById("myBar_carbs");
            var elem_fat = document.getElementById("myBar_fat");
            var elem_sugar = document.getElementById("myBar_sugar");
            var elem_saturated_fat = document.getElementById("myBar_saturated_fat");
            var width = 10;

            elem_calories.style.width = calories + "%";
            elem_calories.innerHTML = Math.round(calories)  + "%";
            elem_protein.style.width = protein + "%";
            elem_protein.innerHTML = Math.round(protein) + "%";
            elem_carbs.style.width = carbs + "%";
            elem_carbs.innerHTML = Math.round(carbs)  + "%";
            elem_fat.style.width = fat + "%";
            elem_fat.innerHTML = Math.round(fat)  + "%";
            elem_sugar.style.width = sugar + "%";
            elem_sugar.innerHTML = Math.round(sugar)  + "%";
            elem_saturated_fat.style.width = saturated_fat + "%";
            elem_saturated_fat.innerHTML = Math.round(saturated_fat)  + "%";
        }
    </script>
</head>

<body>
    <nav>
        <a class="navBtn" href="index.php">Home</a>
    </nav>
    <h1>Meal Info</h1>

    <form>
        <h3>Food:</h3><br>
        <p>
            <?php 
            echo "Breakfast: $breakfast<br>";   
            echo "Lunch: $lunch<br>";   
            echo "Dinner: $dinner<br>";   
            echo "Snack: $snack<br>";   
            echo "Desert: $desert<br>";   
            ?>
        <p>
        <br> <br>
        <h3>Meal Nutrition:</h3><br>
        
        <?php echo "Calories: $total_calories <br>" ?>
        <div id='myProgress'>
            <div id='myBar_calories'>0%</div>
        </div>

        <?php echo "Protein: $total_protein <br>" ?>
        <div id='myProgress'>
            <div id='myBar_protein'>0%</div>
        </div>

        <?php echo "Carbs: $total_carbs <br>" ?>
        <div id='myProgress'>
            <div id='myBar_carbs'>0%</div>
        </div>

        <?php echo "Fat: $total_fat <br>" ?>
        <div id='myProgress'>
            <div id='myBar_fat'>0%</div>
        </div>

        <?php echo "Sugar: $total_sugar <br>" ?>
        <div id='myProgress'>
            <div id='myBar_sugar'>0%</div>
        </div>

        <?php echo "Saturated fat: $total_saturated_fat <br>" ?>
        <div id='myProgress'>
            <div id='myBar_saturated_fat'>0%</div>
        </div>
    </form>
</body>

</html>