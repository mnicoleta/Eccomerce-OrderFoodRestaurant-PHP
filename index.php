<?php
include('partials-front/menu.php');
?>
    <!-- Navbar section ends here  -->
    <!-- Food search section starts here  -->
    <section class="food-search text-center">
        <div class="container">
            <form action="" class="search-right">
                <input type="search" name="search" placeholder="serch for food"/>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>



    </section>
    <!-- Food search  section ends here  -->
     <!-- Categories  section starts here  -->
     <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods </h2>
            <?php

            $sql = "SELECT *FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                     $id=$row['id'];
                     $title=$row['title'];
                     $image_name=$row['image_name'];
                    ?>

                        <a href="">
                            <div class="box-3 float-continer">
                                <?php
                                if($image_name==""){
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else{
                                    ?>

                                        <img src="<?php echo SITEURL;  ?>Images/category/<?php echo $image_name;  ?>"  alt="Pizza" class="img-responsive img-curve"/>


                                  <?php
                                }


                               ?>
                               
                                <h3 class="float-text text-white"><?php echo $title;  ?></h3>
                            </div>
                        </a>

                    <?php
                
                }
               
            }else
            {
                 echo "<div class='error'>Category not Added.</div>";


            }



            ?>

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories  section ends here  -->
    <!-- food-menu  section starts here  -->
     <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/pizza2.jpg" alt="pizza-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">Made with Italian sauce chiken and roganice vegetables</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/pizza2.jpg" alt="pizza-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">Made with Italian sauce chiken and roganice vegetables</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/pizza2.jpg" alt="pizza-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">Made with Italian sauce chiken and roganice vegetables</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/pizza2.jpg" alt="pizza-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">Made with Italian sauce chiken and roganice vegetables</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/cake.jpg" alt="cake-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Cake with nuts</h4>
                    <p class="food-price">$4.3</p>
                    <p class="food-detail">made with nuts and cinnamon and milk</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/pasta.jpg" alt="pasta-meniu" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Pasta Carbonara</h4>
                    <p class="food-price">$3.3</p>
                    <p class="food-detail">350 g – paste, bacon, smantana,ou, parmezan</p>
                    <br>
                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
                <div class="clearfix"></div>
            </div>
           
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="#">See all food</a>
        </p>
</section>


    <?php include('partials-front/footer.php');  ?>

</body>
</html>