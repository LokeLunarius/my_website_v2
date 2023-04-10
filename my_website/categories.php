<?php include('Header_Footer_mainpage/HFM_menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql = "SELECT*FROM tbl_category WHERE active='Yes'";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title =$row['title'];
                        $img_name=$row['img_name'];

                        ?>
                            <a href="category-foods.php">
                                <div class="box-3 float-container">
                                    <?php 
                                        if($img_name=="")
                                        {
                                            echo "<div class='fail'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $img_name  ?>" alt="Pizza" class="img-resposive">
                                            <?php
                                        }

                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='fail'>Category Not Added</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('Header_Footer_mainpage/HFM_footer.php'); ?>
    