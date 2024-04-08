<?php
include_once "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <title>Document</title>
    <?php 
    //$currentPage = "register.php";
    if(isset($_SESSION["currentpage"])){
        echo "<script>loadpage('". $_SESSION["currentpage"] ."')</script>";
        } else {
            $_SESSION["currentpage"] = "index.php";
        }
    if(isset($_SESSION["account"])){
        echo "<script>loadlogin('account.php')</script>";
    } else {
        if(isset($_SESSION["register"])) {
            unset($_SESSION["register"]);
            echo "<script>loadlogin('register.php')</script>";
        } else {
            echo "<script>loadlogin('login.php')</script>";
        }

    }
    ?>
</head>

<body>
    <div class="header">
        <div class="logo">

        </div>
        <div class="account right">
            <div id="login" class="login">
            </div>
        </div>
    </div>
    <div class="sidebar">
    </div>
    <div id="main" class="main"></div>
</body>
</html>