<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <?php
        //verificam daca id este setat sau nu
        if(isset($_GET['id']))
        {
            // echo "getting data";
            $id= $_GET['id'];
            //create sql query to get all other details
            $sql="SELECT * FROM category WHERE id= $id";
            //execute query 

            $res=mysqli_query($conn,$sql);
            //count the rows to check whether id is valid or not
            $count= mysqli_num_rows($res);
            if($count==1){
                //get all the data from database
                $row= mysqli_fetch_assoc($res);
                $title=$row['title'];
                $curent_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];


            }else{
                $_SESSION['no-category-found']= "<div class='error'>Category not Found</div>";
                header('location: '.SITEURL.'admin/manage-category.php');

                }
            }else{
            //redirect catre manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }


        ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Curent Image: </td>
                <td>
                   <?php
                    if($curent_image!=""){
                        ?>
                        <img src="<?php echo SITEURL; ?>Images/category/<?php echo $curent_image ?>" width="100px" >

                        <!-- //display curent image -->
                        <?php


                    }else{

                        echo "<div class='error'>Image Not Add</div>";
                    }
                   ?>
                </td>
            </tr>
            <tr>
                <td>New image:</td>
                <td>
                <input type="file" name="image_name">
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked"; }?> type="radio" name="featured" value="Yes">Yes
                    <input  <?php if($featured=="No"){echo "checked"; }?> type="radio" name="featured" value="No">No

                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}  ?>type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";}  ?> type="radio" name="active" value="No">No

                </td>
            </tr>
            <tr>
                <td >
                <input type="hidden" name="curent_image" value="<?php echo $curent_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit"value="Update Category" class="btn-primary">
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>

<?php

if(isset($_POST['submit'])){
            echo "Clicked";
            //1. get all value from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
        $curent_image=$_POST['curent_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
        //2. update new image if is selected 

    if(isset($_FILES['image_name']['name'])){
        //get the details of image
        $image_name= $_FILES['image_name']['name'];

        //verifica daca imaginea este selectata sau nu 
        if($image_name!=""){
            // verific daca image aviable

            //A. upload the new image
            //auto rename your image
                //get our extension of our image(jpg,png..) specialfood1.jpg
                $ext = end(explode('.',$image_name));

                //rename the image

                $image_name = "foodCategory_".rand(000, 999).'.'.$ext;//e.g. foodCategory_56555.jpg


               $source_path =$_FILES['image_name']['tmp_name'];
               $destination_path = "../Images/category/".$image_name;

               //finally upload the image
               $upload = move_uploaded_file($source_path,$destination_path);

               //check whether the image is uuploaded or not 
               //and if the image is not uploaded theb we will sto p the process abd redirect with errror message
              if($upload==false){
                  $_SESSION['upload']= "<div class='error'>Faild to upload Image</div>";
                  //redirect to addd category page
                  header('location:'.SITEURL.'admin/manage-category.php');
                  //stop the procces;
                  die();
              }
            //B. remove the curent image if available
            if($curent_image!=""){
                $remove_path= "../Images/category/".$curent_image;
                $remove = unlink($remove_path);
    
                //verifica whether the image is removed or not 
    
                //if failed to remove then display message and stop the process 
                if($remove==false){
                    //failed to remove image 
                    $_SESSION['failed-remove'] = "<div class='error'>Faild to remove Image</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();//stop the process 
                }
            }
        }else{
            $image_name=$curent_image;
        }

    }else{
        $image_name=$curent_image;
    }
            //3 update database 
            $sql2 = "UPDATE category SET
            title= '$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id= $id
            ";

            //execute query
            $res2 = mysqli_query($conn, $sql2);
            //4. redirect to manage category with message
            //check is executed or not
    if($res2==true)
    {
                //category is update
            $_SESSION['update-category'] = "<div class='success'>Category updated succesfully!</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');

    }else{
                //category not update 
                $_SESSION['update-category'] = "<div class='error'>Category not updated!</div>";
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
               
        }

}

?>


<?php
include('partials/footer.php');
?>