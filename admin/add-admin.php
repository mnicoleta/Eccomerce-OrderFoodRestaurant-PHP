<?php
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <?php
            if(isset($_SESSION['add'])){//checking wheather the session is set  or not 
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//removing session message
            }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"/></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username"  placeholder="Your username"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your password"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
//process the value form and save it in database
//check wheather the button is clicked or not 

if(isset($_POST['submit'])){
    //button clicked 
    // echo"button clicked"

    //1. get the data from our form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);//password encryptioon with md5
     //2. sql query to save the data into database
     $sql= "INSERT INTO admin SET 
     full_name='$full_name',
     username ='$username',
     password ='$password'
     ";
    //3. executing query and saving data ioto database
    $res= mysqli_query($conn,$sql) or die(mysqli_error());;
    //4. check wheather the (query is executed ) data is inserted or not and display appropiate meessage
    if($res==true){
        
       // DATA INSERTED
        //echo "Data inserted ";
        //create a session variable to dispalay message
        $_SESSION['add']= "<div class=\"success blink_me\">Admin added successfully</div>";
        //redirect page to add admin
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        
        //data not inserted
        //echo "Data not inserted";

        //create a session variable to dispalay message
        $_SESSION['add']= "<div class=\"success blink_me\">Admin not added successfully</div>";
        //redirect page to add admin
        header('location:'.SITEURL.'admin/add-admin.php');

    }
}


?>