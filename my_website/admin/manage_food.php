<?php include('Header_Footer/menu.php'); ?>

        <!-- Main Content Section Begin -->
        <div class="main_content">
            <div class="wrapper">
                <h1>Manage Food</h1>

                <br /><br />
                
                <?php 
                    if(isset($_SESSION['add'])) //check message
                    {
                        echo $_SESSION['add'];  //display message
                        unset($_SESSION['add']); //remove message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['food_not_found']))
                    {
                        echo $_SESSION['food_not_found'];
                        unset($_SESSION['food_not_found']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed_remove']))
                    {
                        echo $_SESSION['failed_remove'];
                        unset($_SESSION['failed_remove']);
                    }
                ?>

                <br /><br /><br />

                <!-- Add Food Button -->
                <a href="add_food.php" class="button_primary">Add Food</a>

                <br /><br /><br /><br />

                <table class="table_full">
                    <tr>
                        <th>Serial Number</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // Query to get all Admin
                        $sql = "SELECT * FROM tbl_food";
                        // Execute Query
                        $res = mysqli_query($conn,$sql);

                        //Check
                        if($res==TRUE)
                        {
                            //Count Rows to check data in Database
                            $count = mysqli_num_rows($res);
                            $serial_number=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $price=$rows['price'];
                                    $img_name=$rows['img_name'];
                                    $category_id=$rows['category_id'];
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];

                                    //Display value to table
                                    ?>
                                         <tr>
                                            <td><?php echo $serial_number++ ?></td>
                                            <td><?php echo $title ?></td>
                                            <td><?php echo $price ?></td>
                                            <td>
                                                <?php 
                                                    if($img_name!="")
                                                    {
                                                        ?>
                                                            <img src="<?php echo SITE_URL ?>images/food/<?php echo $img_name ?>" width="100px" alt="">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        echo "<div class='fail'>Image not Added.</div>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $sql6 = "SELECT*FROM tbl_category WHERE id='$category_id'";
                                                    $res6 = mysqli_query($conn,$sql6);
                                                    $row6 = mysqli_fetch_assoc($res6);
                                                    echo $row6['title']
                                                ?>
                                            </td>
                                            <td><?php echo $featured ?></td>
                                            <td><?php echo $active ?></td>
                                            <td>
                                                <a href="<?php echo SITE_URL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="button_secondary">Update Food</a>
                                                <a href="<?php echo SITE_URL; ?>admin/remove_food.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name?>" class="button_danger">Remove Food</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table>

            </div>
        </div>
        <!-- Main Content Section End -->

<?php include('Header_Footer/footer.php');?>