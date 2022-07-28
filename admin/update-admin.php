<?php
include('partials/menu.php');

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        
        <?php
        //1.get the id or selected admin 
        $id = $_GET['id'];
        //2. create query to get the detalils 
        $sql ="SELECT * FROM admin WHERE id=$id";

        // execute the Query
        $res = mysqli_query($conn,$sql);

        //check whether the query is executed or not 
        if($res==true){
            //check the query is aviable or not 
            $count = mysqli_num_rows($res);
            //check we have admin data or not
             if($count==1){
                 //get the details
                 //echo "Admin Aviable";
                 $row =mysqli_fetch_assoc($res);

                 $full_name=$row['full_name'];
                 $username=$row['username'];

             }else {
                 //redirect to manage admin page
                 header('location:'.SITEURL.'admin/admin-manage.php');
             }

        }else{
            
        }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?> "/>
                    <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php
//check wheter the submit is chicked or not
if(isset($_POST['submit'])){
    // gett all the value form form to update 
     $id = $_POST['id'];
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];

     //create a sql query to admin 
     $sql = "UPDATE admin SET 
     full_name = '$full_name',
     username = '$username'
     WHERE id = '$id'
     ";

     //execute query 
     $res = mysqli_query($conn, $sql);
     // check query executed successfuly or not 
     if($res==true){
         //query executed and admin updated
         $_SESSION['update']="<div class=\"success blink_me\">Admin updated successfully</div>";
         //redirect to manage page
         header('location:'.SITEURL.'admin/manage-admin.php');
     }else{
         //query not executed and admin not updated
         $_SESSION['update']="<div class=\"error blink_me\">Admin not updated successfully</div>";
         //redirect to manage page
         header('location:'.SITEURL.'admin/manage-admin.php');
     }
}else{
    echo "button not ckicked";
}

?>


<?php
include('partials/footer.php');

?>


