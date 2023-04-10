<?php include('Header_Footer/menu.php'); ?>

    <div class="main_content">
        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>
            <?php
                 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                    $sql="SELECT*FROM tbl_category WHERE id=$id";
                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['img_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        $_SESSION['category_not_found'] = "<div class ='fail'> Category Not Found. </div>";
                        header('location:'.SITE_URL.'admin/manage_category.php');
                    }
                }
                else
                {
                    header('location:'.SITE_URL.'admin/manage_category.php');
                }
                //Check
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table_30_percent">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image!="")
                                {
                                    ?>
                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?>" alt="" width="150px">
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
                        <td>New Image: </td>
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
                            <input type="submit" name="submit" value= "Update Category" class="button_secondary">
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
                $destination_path = "../images/category/".$img_name;

                $upload = move_uploaded_file($source_path,$destination_path);

                if($upload==FALSE)
                {
                    $_SESSION['upload']= "<div class ='fail'> Image Upload Failed. </div>";
                    header("location:".SITE_URL.'admin/add_category.php');
                    die();
                }

                if($current_image!="")
                {
                    $remove_path = "../images/category/".$current_image;

                    $remove = unlink($remove_path);

                    if($remove==FALSE)
                    {
                        $_SESSION['failed_remove'] = "<div class ='fail'> Image Removed Fail.</div>";
                        //redirect page
                        header("location:".SITE_URL.'admin/manage_category.php');
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
        $sql2 = "UPDATE tbl_category SET
            title='$title',
            img_name='$img_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
        ";
        $res2 = mysqli_query($conn,$sql2);

        if($res2==TRUE)
        {
            $_SESSION['update'] = "<div class ='success'> Category Updated Successfully.</div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_category.php');
        }
        else
        {
            $_SESSION['update'] = "<div class ='fail'> Category Updated Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_category.php');
        }
    }
    else
    {
        //Not Clicked
    }
?>