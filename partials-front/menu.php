<?php
include('config/constants.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website </title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <!-- Navbar section starts here  -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="Images/logo.png" alt="Logo-Food" class="img-responsive">
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php  echo SITEURL;   ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL;   ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL;   ?>food.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
       

        </div>


    </section>