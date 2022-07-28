<?php
include("partials/menu.php");

?>

<div class="main-content" >
    <div class="wrapper">
        <h1>Add Food </h1>
        <br>
        <br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Write title food">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="25" rows="5" placeholder="Write description food...">
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" name="price" placeholder="price of food"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image_name">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td><select name="category">
                <?php
                    //create php code to display categories from database 
                    //1.create sql to get all active categories from database
                    $sql= "SELECT * FROM category WHERE active= 'Yes'";
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have categoryies or not
                    $count = mysqli_num_rows($res);
                    //if count is greater then zero, we have categories else we don t have categories

                    if($count>0){
                        //we have categories
                        while($row=mysqli_fetch_assoc($res)){
                            //get the details of categories
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                            <option value="<?php echo $id;  ?> "><?php echo $title;  ?>  </option>

                            <?php
                        }
                    }else{
                        //we do not have category

                        ?>
                        <option value="0">No category found</option>

                        <?php
                    }
                ?>
                </select>
            </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td><input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td><input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
            </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="ADD FOOD" class="btn-primary">
                </td>
            </tr>

        </table>



        </form>
            <?php

            //check whether the button is clicked or not

            if(isset($_POST['submit'])){

                //add data in data base 
                //echo "is clicked";
                //1. get the data from form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price =$_POST['price'];
                $category = $_POST['category'];

                //check whether radio  button for featured and active is checked or not
                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];

                }else{
                    $featured="No"; //setting the default value

                }

                if(isset($_POST['active'])){
                    $active= $_POST['active'];
                }else{
                    $active="No";//setting the default value
                }
                //2.upload the image is selected 
                //check wheater the select image is clicked or not and upload the image only if the is selected
                if(isset($_FILES['image_name']['name'])){
                    //get the details of the selected image
                    $image_name= $_FILES['image_name']['name'];

                    //check whether the image is selected or not and upload image only is selected
                    if($image_name!=""){
                        //image is selected
                        //A. rename the image
                        //get the exstension of selected image(jpg,png etc)
                        $ext = end(explode('.',$image_name));

                        //create new name for image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Name-657.jpg"


                        //B. upload the image
                        //get the source path and destination path

                        //source path is the current location of the image 
                        $src = $_FILES['image_name']['tmp_name'];

                        //destination path for the image to be uploade
                        $dst = "../Images/food/".$image_name;

                        //upload the food iimage
                        $upload = move_uploaded_file($src,$dst);

                        //check image is uploaded or not
                        if($upload=false){
                            //failde to upload the image
                            //redirect to add food page with error message
                            $_SESSION['upload'] = "<div class= 'error'>Failed to upload the image</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }

                }else{
                    $image_name="";//setting default value as blank
                }
                //3. insert into database

                //create a sql2 query to save or add food
                //for numerical we do not need to pass value inside quotes  but for string it is compulsory to add quotes
                $sql2= "INSERT INTO food SET 
                title = '$title',
                description= '$description',
                price= $price,
                image_name = '$image_name',
                category_id= $category,
                featured = '$featured',
                active= '$active'

                 ";
                 //execute query 
                 $res2= mysqli_query($conn,$sql2);

                 //check wheather data is inserted or not
                 //4.redirect with message food page

                 if($res2==true){
                     //data is inserted successfully
                     $_SESSION['add']= "<div class='success'>Food added successfully</div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                 }else{
                     $_SESSION['add']= "<div class= 'error'>Failed to add food</div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                 }
                
            }





            ?>


    </div>


</div>




<?php
include("partials/footer.php");

?>