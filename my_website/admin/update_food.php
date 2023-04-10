<?php include('Header_Footer/menu.php'); ?>
    <div class="main_content">
        <div class="wrapper">
            <h1>Update Food</h1>

            <br><br>

            <?php
                 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                    $sql="SELECT*FROM tbl_food WHERE id=$id";
                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_image = $row['img_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        $_SESSION['food_not_found'] = "<div class ='fail'> Food Not Found. </div>";
                        header('location:'.SITE_URL.'admin/manage_food.php');
                    }
                }
                else
                {
                    header('location:'.SITE_URL.'admin/manage_food.php');
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table_30_percent">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" ><?php echo $description; ?> </textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image!="")
                                {
                                    ?>
                                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $current_image; ?>" alt="" width="150px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='fail'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){ echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){ echo "checked"; } ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){ echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No"){ echo "checked"; } ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value ="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value ="<?php echo $id; ?>">
                            <input type="submit" name="submit" value= "Update Food" class="button_secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('Header_Footer/footer.php');?>


<?php 
    // Process value from the Form and save it to Database
    // Check Submit button
    if(isset($_POST['submit']))
    {
        //Clicked
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $img_name = $_FILES['image']['name'];
            $img_name2=$img_name;

            if($img_name!="")
            {

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$img_name;

                $upload = move_uploaded_file($source_path,$destination_path);

                if($upload==FALSE)
                {
                    $_SESSION['upload']= "<div class ='fail'> Image Upload Failed. </div>";
                    header("location:".SITE_URL.'admin/update_food.php');
                    die();
                }

                if($current_image!="")
                {
                    $remove_path = "../images/food/".$current_image;

                    $remove = unlink($remove_path);

                    if($remove==FALSE)
                    {
                        $_SESSION['failed_remove'] = "<div class ='fail'> Image Removed Fail.</div>";
                        //redirect page
                        header("location:".SITE_URL.'admin/manage_food.php');
                    }
                }
            }
            else
            {
                $img_name=$current_image;
            }
        }
        else
        {
            $img_name= $current_image;
        }



        //Query
        $sql2 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            img_name='$img_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
        ";
        $res2 = mysqli_query($conn,$sql2);

        if($res2==TRUE)
        {
            $_SESSION['update'] = "<div class ='success'> Food Updated Successfully.</div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['update'] = "<div class ='fail'> Food Updated Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_food.php');
        }
    }
    else
    {
        //Not Clicked
    }
?>