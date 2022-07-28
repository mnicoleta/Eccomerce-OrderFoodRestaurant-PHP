<?php
include('../config/constants.php');
//1 get the id of category to deleted
// echo "delete page";

//verifica daca datele sunt sau nu 
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            if($image_name!="")
            {
        //romove image if is aviable. So remove it
        $path = "../Images/category/".$image_name;

        $remove = unlink($path);

        if($remove==false)
                    {
                        //set session message
                    $_SESSION['remove']= "<div class='error'>Image not Deleted</div>";
                    //redirect to manage-category
                    header('location: '.SITEURL.'admin/manage-category.php');
                    //stop process
                    die();


                    }
            }


            //delete from database
            //sql query to delete from database
            $sql="DELETE FROM category WHERE id=$id";
            //execute query
            $res=mysqli_query($conn,$sql);

            if($res==true){
                $_SESSION['delete']= "<div class='success'>Category  Deleted</div>";
                //redirect to manage-category
                header('location: '.SITEURL.'admin/manage-category.php');

            }else{
                $_SESSION['delete']= "<div class='error'>Category not Deleted</div>";
                    //redirect to manage-category
                    header('location: '.SITEURL.'admin/manage-category.php');

            }

            //redirect to category manage

}else
{
    //redirect to manage category 
    $_SESSION['remove']= "<div class='error'>Image not  Deleted</div>";
        //redirect to manage-category
        header('location: '.SITEURL.'admin/manage-category.php');

}


?>