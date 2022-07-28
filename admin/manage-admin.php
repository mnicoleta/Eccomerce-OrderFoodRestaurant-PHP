<?php

include('partials/menu.php');

?>

<html>
    <head>
    <title>Food Order - Home Page</title>
    <link rel="stylesheet" href="../CSS/Admin.css">
    </head>
    <body>
    <!-- Main COntent Starts -->
    <div class="main-content" >
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/>
<!-- SESSION -->
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//removing session message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete']; //arata mesajul sesiunii
                unset($_SESSION['delete']);// sterge sesiunea dupa refresh

            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user_not_found'])){
                echo($_SESSION['user_not_found']);
                unset($_SESSION['user_not_found']);
            }
            if(isset($_SESSION['password_not_match'])){
                echo($_SESSION['password_not_match']);
                unset($_SESSION['password_not_match']);
            }
            if(isset($_SESSION['update_pass'])){
                echo $_SESSION['update_pass'];
                unset($_SESSION['update_pass']);
            }
        ?>
        <br/><br/><br/>
        <!-- button to add admin -->
        <a href="add-admin.php" class=" btn-primary">Add Admin</a>
        <br/><br/><br/>
        <button></button>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            //QUERY TO GET ALL ADMIN 
                $sql = "SELECT * FROM admin";
            //EXECUTE THE QUERY 
            $res = mysqli_query($conn, $sql);
            //chech sweather the query is executed of not
            if($res==TRUE){
                //count Rows to check whether we have data in database or not 
                $count = mysqli_num_rows($res);//function to get all the rows in data base
                $sn=1;//create a variable and assign the value 
                //chech the num of rows
                if($count>0){
                    //we have data in data base 
                    while($rows=mysqli_fetch_assoc($res)){
                        //using while loop to get alll the data from database
                        //and while loop will tun as long as we have data in database 

                        //get inidividual data 
                        $id = $rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];
                        //display the value in our table 
                    ?>
            <tr>
                <td><?php  echo $sn++;  ?></td>
                <td><?php echo $full_name;?></td>
                <td><?php  echo $username; ?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                </td>

            </tr>
                    <?php
                    }
                }else{
                    //we don t have data in database
                }

            }
            ?>

        </table>
    </div>

    </div>
    <!-- Main Content ends -->
<?php

include('partials/footer.php');

?>

    </body>
</html>