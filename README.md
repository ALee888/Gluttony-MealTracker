
<p align="center">
    CPSC 314 Web Project Deliverable 2 <br>
    Glutony <br>
    Adam Lee <br>
    11/5/2021 <br>
</p>
Github URL: https://github.com/Gonzaga-CPSC-Fall-2021-Olivares/cpsc-314-web-development-final-project-ALee888 

# Functional Requirement 1: 
**Users must be able to update their health (macro) goals**
This function takes personal information and turns it into recommended calorie and macronutrient intake per day. For this deliverable, the data is not stored anywhere. In the final version, goals will be tied to a user account.

Steps:
1. See "current goals" on the home page
2. Click Goals from the navigation bar
3. Input personal information and click "calculate" and then "update goal"
4. Click "home" from the navigation bar and see the changed results
 

# Functional Requirement 2: 
**Users must be able to create a new meal entry**
This function allows users to create meals and save them onto the calendar. These will be saved to the user and pulled from a data base in the future, but for this it is just an array in index.html.

Steps:
1. Click "Create Meal" in the top left
2. Enter meal information with date
3. click "New Meal" to save


# Functional Requirements 3 and 4:
**Users must be able to clearly see their past and future eating habits from a calendar view** 
This functional requirement turned into a basic calendar that can be clicked to display a meal plan associated with that day.

Steps:
1. Click any day on the calendar from the home menu
2. Verify the correct date in the "Meal information" section in the red section and click "Get nutritional information"


# Functional Requirement 5:
**Users must be able to calculate macros from personal information** 
This function takes personal information and turns it into recommended calorie and macronutrient intake per day.

Steps:
1. click "Goals" in the nav bar
2. Enter personal information
3. Click calculate and view results on the bottom


# Functional Requirement 6 
**Users must be able to create an account and log in via username and password**
Implement a login system for the website that stores username and passwords in a mysql database table. Users can also register new accounts. This system will include login/logout functionality with a reset password mechanic. 

Steps: 
1. If not automatically prompted to login, click the username/login button in the top right 
2. Enter login information if account exists 
3. To create a new account click "sign up now"
4. Fill out registration information and click "submit"
5. To reset your password click on the top right of the index page like shown in step one and then click reset password on the next window


# Functional Requirement 7
**Users must be able to create a new meal and save it to the database**
User will be able to create a meal using valid foods from the food database and send them to a database to store meals.

Steps:
1. Click "Create Meal" in the top left of the homescreen
2. Enter foods from the drop-down menu and date selector and then hit "New Meal" to submit


# Functional Requirement 8
**Users must be able to save their nutritional goals to a database**
Users must be able to update their health goals associated with their user account. These goals are calculated using a formula based on user personal information. The calculated suggested daily nutritional information is then stored into a database.

Steps:
1. Click "Goals" in the nav bar to go to the goals page
2. Enter personal information in the input boxes and then hit "Calculate" if you are satisfied with the results.


# Functional Requirement 9
**Users must be able to find nutritional information on food from a databse**
Users can use the app to find nutritional information for food from a databse. For the purposes of simplicity, I made my own short database with foods and data that I found online.

Steps:
1. Click "search foods" in the nav bar
2. Choose a food from the dropdown menu and click "search to see nutritional information


# Functional Requirement 10
**Users must be able to see past and future meals from the database**
Users can see previously made meals from the database by clicking on any of the calendar dates. Make sure a meal exists with that date or the application will crash.

Steps:
1. Click on any of the dates
2. Click "get nutritional information" and view

Notes: The main bug I have is being able to recall meals from different months than the month that the calendar loads in on. Since the JS and CSS is so finicky, it is hard to extract the exact date and the dates as buttons seem to stop working after the month is switched. My main “Wishlist” item is a way to incorporate the portions of the food into my project and have a quantity multiplier, but I just ran out of time in the end. 
