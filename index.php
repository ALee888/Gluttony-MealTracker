<!-- 
    index php file
    By: Adam Lee
    Last edited: 12/6/2021
    Main page of the web app
-->
<?php
# Initialize the session
session_start();

# Include config file
require_once "config.php";

# Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} 

#Get current user health goals
$user_id = $_SESSION["user_id"];

$sql = "SELECT calories, protein, carbs, fat, sugar, saturated_fat from goals where user_id=$user_id;";
$result = $link->query($sql);

if(!$result) {
    die("Error ($link->errno) $link->error<br>SQL = $sql\n");
} else {
    $row = $result->fetch_row();
    #check if goal already exists
    if ($row==null) {
        # No goal exists so create empty one
        $sql = "INSERT INTO goals (user_id, calories, protein, carbs, fat, sugar, saturated_fat) values ($user_id, 0, 0, 0, 0, 0, 0);";
        # Issue sql command
        if (!$link->query($sql)) {
            die("Error ($link->errno) $link->error<br>SQL = $sql\n");
        }
        $_SESSION["goal_calories"] = 0;
        $_SESSION["goal_protein"] = 0;
        $_SESSION["goal_carbs"] = 0;
        $_SESSION["goal_fat"] = 0;
        $_SESSION["goal_sugar"] = 0;
        $_SESSION["goal_saturated_fat"] = 0;
    } else {
        # Create session variables on user goals
        
        $_SESSION["goal_calories"] = $row[0];
        $_SESSION["goal_protein"] = $row[1];
        $_SESSION["goal_carbs"] = $row[2];
        $_SESSION["goal_fat"] = $row[3];
        $_SESSION["goal_sugar"] = $row[4];
        $_SESSION["goal_saturated_fat"] = $row[5];
        
    }
    
}
?>

<!doctype html>
<html>
<head>
    <title>Gluttony</title>
    
    <link rel="stylesheet" href="calendar_styles.css" type="text/css"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    />
    
    <script src="script.js"></script>
    <script>
        //On window load
        window.onload = function () {
            console.log("onload");
            // Tab Variables
            var loginButton = document.getElementById("login");
            var welcomeScreen = document.getElementById("welcome");

            // Food/meal info display variables
            var dateDisplay = document.getElementById("date");
            //var breakfastDisplay = document.getElementById("breakfast");
            //var lunchDisplay = document.getElementById("lunch");
            //var dinnerDisplay = document.getElementById("dinner");
            //var snackDisplay = document.getElementById("snack");
            //var breakfastOutput = document.getElementById("breakfastOutput");
            //var lunchOutput = document.getElementById("lunchOutput");
            //var dinnerOutput = document.getElementById("dinnerOutput");
            //var snackOutput = document.getElementById("snackOutput");
            //var dateOutput = document.getElementById("dateOutput");

            calendarDates = []; // Hold date objects for clicking



            // New date object
            const date = new Date();
            //Calendar rendering
            const renderCalendar = () => {
                console.log("rendering calendar");
                //Set date
                date.setDate(1);
                console.log(date)
                //MonthDays is the query selector for days
                const monthDays = document.querySelector(".days");

                //Last Day is a new date 
                const lastDay = new Date(
                    date.getFullYear(),
                    date.getMonth() + 1,
                    0
                ).getDate();
                console.log("lastDay:" + lastDay)
                //Previous last day
                const prevLastDay = new Date(
                    date.getFullYear(),
                    date.getMonth(),
                    0
                ).getDate();

                //Get first day index
                const firstDayIndex = date.getDay();

                //Get last day index
                const lastDayIndex = new Date(
                    date.getFullYear(),
                    date.getMonth() + 1,
                    0
                ).getDay();

                //Next days index
                const nextDays = 7 - lastDayIndex - 1;

                //Array of month strings
                const months = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ];

                
                document.querySelector(".date h1").innerHTML = months[date.getMonth()];

                document.querySelector(".date p").innerHTML = new Date().toDateString();

                let days = "";
                console.log("PREVLASTDAY: " + prevLastDay)
                for (let x = firstDayIndex; x > 0; x--) {
                    days += `<div id="calendarDay" class="prev-date">${prevLastDay - x + 1}</div>`;
                    var calendarDate = new Date(date.getFullYear(), date.getMonth() - 1, prevLastDay - x + 1);
                    calendarDates.push(calendarDate);
                }

                for (let i = 1; i <= lastDay; i++) {
                    if (
                        i === new Date().getDate() &&
                        date.getMonth() === new Date().getMonth()
                    ) {
                        days += `<div id="calendarDay" class="today">${i}</div>`;
                        var calendarDate = new Date(date.getFullYear(), date.getMonth(), i);
                        calendarDates.push(calendarDate);
                    } else {
                        days += `<div id="calendarDay">${i}</div>`;
                        var calendarDate = new Date(date.getFullYear(), date.getMonth(), i);
                        calendarDates.push(calendarDate);
                    }
                }

                for (let j = 1; j <= nextDays; j++) {
                    days += `<div id="calendarDay" class="next-date">${j}</div>`;
                    var calendarDate = new Date(date.getFullYear(), date.getMonth() + 1, j);
                    calendarDates.push(calendarDate);
                    monthDays.innerHTML = days;
                }
            };
            
            document.querySelector(".prev").addEventListener("click", () => {
                date.setMonth(date.getMonth() - 1);
                renderCalendar();
            });

            document.querySelector(".next").addEventListener("click", () => {
                date.setMonth(date.getMonth() + 1);
                renderCalendar();
            });

            //Function for displaying aside information
            function displayMeal(date) {
                console.log("myDate: " + date);

                var found = false;
                dateDisplay.value = date
/*                 for (let i = 0; i < mockMeals.length; i++) {
                    if (mockMeals[i].month == month && mockMeals[i].day == day)
                    {
                        
                        breakfastDisplay.innerText = mockMeals[i].breakfast;
                        lunchDisplay.innerText = mockMeals[i].lunch;
                        dinnerDisplay.innerText = mockMeals[i].dinner;
                        snackDisplay.innerText = mockMeals[i].snacks;
                        found = true;
                    }
                }
                if (found == false) {
                    dateDisplay.innerText = "none"
                    breakfastDisplay.innerText = "none";
                    lunchDisplay.innerText = "none";
                    dinnerDisplay.innerText = "none";
                    snackDisplay.innerText = "none";
                } */

            };


            //var calendarDays = document.getElementById("days");
            //calendarDays.addEventListener("click", console.log("monthDays"));
            renderCalendar();
  
            document.querySelectorAll('[id=calendarDay]').forEach(item => {
                item.addEventListener('click', event => {
                    var month = document.querySelector(".date h1").innerHTML;
                    var monthNum = "";
                    var date = document.querySelector(".date p").innerHTML;
                    
                    //temporary
                    if (month=="January") {
                        monthNum = '1';
                    } else if (month == "February") {
                        monthNum = '2';
                    } else if (month == "March") {
                        monthNum = '3';
                    } else if (month == "April") {
                        monthNum = '4';
                    } else if (month == "May") {
                        monthNum = '5';
                    } else if (month == "June") {
                        monthNum = '6';
                    } else if (month == "July") {
                        monthNum = '7';
                    } else if (month == "August") {
                        monthNum = '8';
                    } else if (month == "September") {
                        monthNum = '9';
                    } else if (month == "October") {
                        monthNum = '10';
                    } else if (month == "November") {
                        monthNum = '11';
                    } else if (month == "December") {
                        monthNum = '12';
                    }
                    var year = date.substr(date.length - 4);
                    console.log(item.innerHTML);
                    console.log(monthNum);
                    console.log(year);
                    var myDate = year + "-" + monthNum + "-" + item.innerHTML;
                    displayMeal(myDate);

                })
            })
            console.log(calendarDates)
        };
    </script>
</head>
<body>
    <nav>
        <div class="navLinks">
            <div id="newMealDisplay" class="navBtn"><a href="newMeal.php">Create Meal</a></div> &nbsp;
            <div id="searchFoodDisplay" class="navBtn"><a href="search_food.php">Search Food</a></div> &nbsp;
            <div class="navBtn"><a href="calculator.php">Goals</a></div> &nbsp;
            
            
        </div>
        <!--<div style="margin: 0 auto; width: 100px; text-align: center">Centered Text</div> -->
        <a href="profile.php">
            <div id="login" class="login"><?php echo htmlspecialchars($_SESSION["username"]); ?></div>
        </a>
    </nav>
    <!-- Flex container -->
    <div class="container">
        <!-- Calendar -->
        <main>
            <div class="calendar">
                <div class="month">
                    <i class="fas fa-angle-left prev"></i>
                    <div class="date">
                        <h1></h1>
                        <p></p>
                    </div>
                    <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div id="days" class="days"></div>
            </div>
        </main>
        <!-- Calendar meal info -->
        <aside id="welcome">    
            <?php echo "<h1>Hello " . htmlspecialchars($_SESSION["username"]) . "!</h1><br><br>"; ?>
            <div class='nutritional_info'>
                <h3>Current Goals</h3>
                <?php
                    echo "Target calories: $_SESSION[goal_calories] <br><br>
                        Target protein: $_SESSION[goal_protein] <br><br>
                        Target carbs: $_SESSION[goal_carbs] <br><br>
                        Target fat: $_SESSION[goal_fat] <br><br>
                        Target sugar: $_SESSION[goal_sugar] <br><br>
                        Target saturated fat: $_SESSION[goal_saturated_fat]";
                ?>
            </div>
            <br><br>
            <h3>Meal Information</h3>
            <form action="mealInfo.php" method="GET">
                <input type="text" name="date" id="date"></h3> <br>

                <input type="submit" name="get_nutrition" value="Get nutritional information">
            </form>
        </aside>
    </div>
</body>
</html>