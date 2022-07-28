<?php
include('partials/menu.php');

?>
<div class="main-content">
    <div class="wrapper"><br>
        <h1>Add Category</h1>
        <br><br>
<!-- sesiune unde imi arata ca a esuat introducera categoriei  -->
<?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}



?>
<br><br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image_name" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form><br><br><br>
        <!-- Add category form ends -->
        <?php
        //verifica daca s a trimis date daca butonul este apasat sau nu 
        
        if(isset($_POST['Submit']))
        {
            //iau date din form 
            $title = $_POST['title'];
            //pentru butoane radio pot face if 
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }else
            {
                //default
                $featured = "No";
            }
           if(isset($_POST['active']))
           {
               $active = $_POST['active'];

           }else
           {
               $active = "No";
           }
           //verific daca imageinea este selectata sau nu set the value for image name 
            //    print_r($_FILES['image_name']);


            //    die();//nu vreau sa vad valoara selectata 
           if(isset($_FILES['image_name']['name'])){
               //upload the image
               //avem nevoie de o imagine cu nume si sursa path si destinatia path
               $image_name = $_FILES['image_name']['name'];
               
                //auto rename your image
                //get our extension of our image(jpg,png..) specialfood1.jpg
                $ext = end(explode('.',$image_name));

                //rename the image

                $image_name = "foodCategory_".rand(000, 999).'.'.$ext;//e.g. foodCategory_56555.jpg


               $source_path =$_FILES['image_name']['tmp_name'];
               $destination_path = "../Images/category/".$image_name;

               //finally upload the image
               $upload =move_uploaded_file($source_path,$destination_path);

               //check whether the image is uuploaded or not 
               //and if the image is not uploaded theb we will sto p the process abd redirect with errror message
              if($upload==false){
                  $_SESSION['upload']= "<div class='error'>Faild to upload Image</div>";
                  //redirect to addd category page
                  header('location:'.SITEURL.'admin/add-category.php');
                  //stop the procces;
                  die();
              }

           }
           else{
               
            //don't upload image and set the image name value as blank
            $image_name="";
        }
        
        
        // introduc datele in data de baza prin sql
        $sql = "INSERT INTO category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'";

        //ma conectez la baza de date
        $res= mysqli_query($conn,$sql);
if($res==true){
    $_SESSION['add'] = "<div class='success'>Add category succesfully  </div>";
    header('location:'.SITEURL.'admin/manage-category.php');
}else{

    $_SESSION['add'] = "<div class='error'>Add category fail  </div>";
    header('location:'.SITEURL.'admin/add-category.php');
}
        }
  

      ?>










<?php
include('partials/footer.php');

?>