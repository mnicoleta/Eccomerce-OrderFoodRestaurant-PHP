<?php
//autorizare pentru acces control
//vverifica daca userul este logat sau nu 
if(!isset($_SESSION['user'])){ ///if user sesion not set
    //user  not loged in 
    //redirect to login page with mesage
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin panael.</div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');

}
?>