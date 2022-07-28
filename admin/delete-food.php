
<?php
include('../config/constants.php');

?>

<?php

// 1. GET id of food to deleted 


//verifica prima data daca datele sunt sau nu 

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove image if is aviable. 
    if($image_name!=""){
        $path = "../Images/food/".$image_name;

        $remove = unlink($path);

        if($remove=false){
            //set session message 

            $_SESSION['delete-food'] = "<div class='error'>Imaginea nu s-a sters</div>";
            //redirect to manage food
            header('location: '.SITEURL.'admin/manage-food.php');
            //stop proccess
            die();

        }
    }

    //acum stergem si din data de baza 

    //sql query to delete food
    $sql = "DELETE FROM food WHERE id=$id";
    //execute query 
    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete-food'] = "<div class='success'> Food wit number $id was removed! </div>";
        header('location: '.SITEURL.'admin/manage-food.php');

    }else{
        $_SESSION['delete-food'] = "<div class='error'>Imaginea nu s-a sters</div>";
        header('location: '.SITEURL.'admin/manage-food.php');
    }

}else{
    $_SESSION['delete-food'] = "<div class='error'>Imaginea nu s-a sters</div>";
    header('location: '.SITEURL.'admin/manage-food.php');
}

?>