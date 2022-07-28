<?php
include('partials/menu.php');
?>

<?php
//verificam daca id ul exista si dupa preluam din baza de date

  if(isset($_GET['id']))
  {
        $id = $_GET['id'];
        // preiau datele din database
        $sql = "SELECT * FROM food WHERE id=$id ";
        // ma conectez la baza de date
        $res= mysqli_query($conn,$sql);
        //verific fiecare rand
        $count= mysqli_num_rows($res);
        //testez selectarea lui 
            if($count==1){
              // returnez datele din database prin preluarea coloanelor si le pun in randuri in formular
              $row= mysqli_fetch_assoc($res);
              $title = $row['title'];
              $description = $row['description'];
              $price = $row['price'];
              $curent_image = $row['image_name'];
              $curent_category= $row['category_id'];
              $featured= $row['featured'];
              $active= $row['active'];

            }else{
              echo  "Not Food Found";
            }




  }else{
    header('location:'.SITEURL.'admin/manage-food.php');

  }


?>

<div class="main-content">
    <div class="wrapper">
    <br>
    <br>
    <h1>Update Food</h1>
    <br>
    <br>

  <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">

         <tr>
              <td>Title: </td>
              <td>
              <input type="text" name="title" value="<?php echo $title;  ?>">
              </td>
         </tr>
         <tr>
              <td>Description: </td>
              <td>
              <textarea name="description" cols="30" rows="10"> <?php echo $description; ?></textarea>
              </td>
         </tr>
         <tr>
              <td>Price</td>
              <td>
              <input type="number" name="price" value="<?php echo $price;  ?>">
              </td>
         </tr>
         <tr>
              <td>Curent Image: </td>
              <td>
              <!-- verific daca imaginea exista, o afisez -->
              <?php
              if($curent_image ==""){
              //voi afisa 
              echo "<div class='error'>Image not Added</div>";
               
              }else{
                //imagine disponibila
                   ?>
                
                <img src="<?php echo SITEURL;?>/Images/food/<?php echo $curent_image ?>" width="100px">
                <?php
              }
              ?>

              </td>
         </tr>
         <tr>
              <td>Select new Image: </td>
              <td>
              <input type="file" name="image">
              </td>
         </tr>
         <tr>
              <td>Category</td>
              <td>
                <select name="category">
                  <?php

                      //se iau datele din tabela category
                      $sql2 = "SELECT * FROM category WHERE active ='Yes'";
                      //executa query 
                      $res2=mysqli_query($conn,$sql2);
                      //verifica fiecare rand
                      $count2= mysqli_num_rows($res2);
                      //verifica daca sunt date in data de baza 
                      if($count2>0){
                        while($row2=mysqli_fetch_assoc($res2))
                        {
                          $category_title= $row2['title'];
                          $category_id= $row2['id'];

                        //  echo "<option value='$id_category'>$category_id</option>";
                    ?>
                         <option <?php if($curent_category==$category_id){echo "selected";}?> value="<?php echo $category_id;  ?>"><?php echo $category_title; ?></option>

                    <?php
                          }
                        }else
                        {
                          echo "<option value='0'> Category not added</option>";
                        }
                  ?>
                              </select>
                              </td>
                            </tr>
                        <tr>
                              <td>Featured</td>
                              <td>
                              <input <?php if($featured=="Yes"){echo "checked"; }  ?> type="radio" name="featured" value="Yes">Yes
                              <input <?php if($featured=="No"){ echo "checked"; }  ?>  type="radio" name="featured" value="No">No
                              </td>
                        </tr>
                        <tr>
                              <td>Active: </td>
                              <td>
                              <input <?php if($active=="Yes"){ echo "checked"; }  ?> type="radio" name="active" value="Yes">Yes
                              <input <?php if($active=="No"){ echo "checked";  } ?> type="radio" name="active" value="No">No
                              </td>
                        </tr>
                        <tr >
                              <td colspan="2" >
                              <input type="hidden" name="curent_image"  value=" <?php echo $curent_image;?> ">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                              <input type="submit" name="submit" value="Update Food" class="btn-primary"> 
                              </td>
                        </tr>
      </table>
  </form>
  <?php
  // introduc datele schimbate in baza de date 

  if(isset($_POST['submit'])){
    // echo "click";
    //1. ia toate detaliile din form si pune le in variabile
    $id= $_POST['id'];
    $title = $_POST['title'];
    $description=$_POST['description'];
    $price = $_POST['price'];
    $curent_image= $_POST['curent_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2. upload the image is selected 
    //verifica daca butonul este apasat sau nu 
    if(isset($_FILES['image']['name'])){
      //upload daca butonul este apasat 
      $image_name= $_FILES['image']['name']; //new image name 

      //verifica daca imaginea este 
      if($image_name!=""){

        //imaginea este disponibila 
        //redenumesc imaginea 
        //iau extensia imaginii
        $ext = end(explode('.',$image_name));

        //va fi noul nume al imaginii
        $image_name= "Food-name-".rand(000,999).".".$ext;
        //pun intr o variabila sursa path si destinatia path
        $src = $_FILES['image']['tmp_name'];
        $dest_path = "../Images/food/".$image_name;
        $upload = move_uploaded_file($src, $dest_path);

        //verifica daca imaginea a fost incarcata sau nu

        if($upload==false)
        {
          //failed to upload
          $_SESSION['upload'] = "<div class='error'>faild to upload image </div>";
          //redirect
          header('location:'.SITEURL.'admin/manage-food.php');
          //stop proccess
          die();

        }
        //sterge imaginea curenta daca este disponibila
        if($curent_image!=""){
          $remove_path = "../Images/food/".$curent_image;
          if (is_file($remove_path)) {
            // The path exists and is a file
            unlink($remove_path);    
        }
         
          //verifica daca s a sters img 
          if($remove_path==false){
            $_SESSION['remove-failed'] = "<div class ='error' >Failed image remove</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
          }
        }

      }
    }else{
      $image_name= $curent_image;
    }





    //3. update date 
    $sql3= "UPDATE  food SET
    title= '$title',
    description= '$description';
    price= $price,
    image_name='$image_name',
    category_id = '$category',
    featured= '$featured',
    active= '$active'
    WHERE id=$id;
    ";

// execute sql query 
$res3= mysqli_query($conn, $sql3);

//redirect cu un mesaj daca datele s au updatat
if($res3==true){
  $_SESSION['update-food'] = "<div class ='success' >Food Updated</div>";
  header('location:'.SITEURL.'admin/manage-food.php');
}else{
  $_SESSION['update-food'] = "<div class ='error' >Food not Updated</div>";
  header('location:'.SITEURL.'admin/manage-food.php');
}

  }else
  {
    // echo "datele nu au fost transmise";
  }





  ?>
  </div>
</div>



<?php
include('partials/footer.php');
?>