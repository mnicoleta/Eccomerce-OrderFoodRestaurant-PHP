<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id'])){
            $id =$_GET['id'];
        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Curent Passord: </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Old password">
                    </td>
                </tr>
                <tr>
                    <td>New Passord: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password"  placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    //1.get the data from form
    $id= $_POST['id'];
   $old_password = md5($_POST['old_password']);
   $new_password = md5($_POST['new_password']);
   $confirm_password =md5($_POST['confirm_password']);

    //2 check whether the user with current id and current password exists or not
$sql = "SELECT * FROM admin WHERE id =$id AND password = '$old_password'";
//execute query
$res = mysqli_query($conn, $sql);
if($res==true){
    //check whether data is aaviable or not 
    $cont= mysqli_num_rows($res);
    if($cont==1){
        //user exists and passeord can be changed 
        //echo "user found";
        //check whether the new passord and confirm pass match or not
        if($new_password==$confirm_password){
            //update passsord
            //echo "password match";
            $sql2 ="UPDATE admin SET
            password ='$new_password'
            WHERE id=$id
            ";
            //execute the query
            $res2 = mysqli_query($conn,$sql2);
            //check whether the query executed or not
            if($res==true){
                // echo "password change";
                $_SESSION['update_pass']= "<div class='success'>Password changed</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }else{
                echo "passhord not change";
                //redirect to admin with session
                $_SESSION['update_pass']= "<div class='error'>Passwrd not changed</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }else{
            //redirect to manage admin page with error
            $_SESSION['password_not_match']= "<div class='error'> Password not match</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }else{
        //user not exist set mesage and redirect
        $_SESSION['user_not_found'] ="<div class='error'> User Not found. </div>";
        //redirect to manage page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

}


?>

<?php include('partials/footer.php')?>