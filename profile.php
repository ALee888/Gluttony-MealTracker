<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: 14px sans-serif;
            background-color: #12121f;
            color: white;
            text-align: center; 
        }
        nav {
            display: flex;
            flex-direction: row;
            line-height: 3;
            /*
            flex-grow: 0;
            flex-shrink: 1;
            flex-basis: 20%;
            */
            background: rgb(31, 64, 58);
            color: white;
        }

        .navBtn {
            font-size: medium;
            color: white;
            margin: 5px;
            padding: 5px;
            border-radius: 15px;
            background-color: grey;
        }
    </style>
</head>
<body>
    <nav>
        <a href = "index.php" class="navBtn">Home</a> <br>
    </nav>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>