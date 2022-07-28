<?php
//Start session
session_start();




//creat constants to store non repeating values
define('SITEURL','http://localhost/Order-Food/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('PASSWORD','');
define('DB_NAME','food-order');


 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,PASSWORD) or die(mysqli_error());//datab conection
 $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database




?>