<?php
//include constants php 

include('../config/constants.php');
//1 destroy the ssesion and 
session_destroy(); 
//2 redirect to login page
header('location:'.SITEURL.'admin/login.php');

?>