<?php
include('../config/constants.php');
//1. get the id of Admin to be deleted
$id = $_GET['id'];

//2. create sql query to delete admin
$sql = "DELETE FROM admin WHERE id=$id";
//execute query 
$res = mysqli_query($conn,$sql);
//check whether the query executef successfuly or not 
if($res==true){
    //executat cu success
    //echo "Admin Deleted";
    //session create variable to display message
    $_SESSION['delete'] = "<div class=\"success\">Admin deleted successfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');


}else{
    //eroare la stergere
    //echo"Failed to deleted data";
    $_SESSION['delete']=  "<div class=\"success\">Admin not deleted successfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. redirect to manage admin page with message (success/error )


?>