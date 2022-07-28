<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login Food Order Syistem</title>
        <link rel="stylesheet" href="../CSS/Admin.css">
    </head>
    <body>
        <div class="login">

        <h1 class="text-center">Login</h1><br><br>
            <!-- login form starts here -->
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                
            ?>
            <br><br>
            <form action="" method="POST" class="text-center">
                Username <br>
                <input type="text" name="username" placeholder="enter usrname"><br><br>
                Password <br>
                <input type="password" name="password" placeholder="enter password"><br> <br>
                 <input type="submit" name="submit" value="Login" class="btn-primary">
            </form><br>
            <p class="text-center">Createa By - <a href="#">Miha</a></p>
             <!-- login form ends here -->
        </div>

    </body>
</html>

<?php
//check the submit button is clicked or not 
if(isset($_POST['submit'])){
    //process for login 
    //1. get the data from login form
     $username= $_POST['username'];
     $password=md5($_POST['password']);
    //sql to check is user and password exist or not
    $sql = "SELECT * FROM admin WHERE username= '$username' AND password='$password'";
    //conecteaza la baza de date
    $res = mysqli_query($conn,$sql);
    //filgtreaza randurile daca exista or not 
    $count = mysqli_num_rows($res);
    
    if($count==1){
        //usserul este aviable and login suscess
        $_SESSION['login'] = "<div class='success'> Login successful</div>";
        $_SESSION['user']=$username;//vaerifica daca userul este login sau nu and logout va fi unsit it 
        header('location:'.SITEURL.'admin/');


    }else
    {
        //usserul nu este creat login fail
        $_SESSION['login'] = "<div class='error'> Login fail</div>";
        header('location:'.SITEURL.'admin/login.php');
    }


}



?>