<?php include('Header_Footer/menu.php'); ?>
    <div class="main_content">
        <div class="wrapper">
            <h1>Add Food</h1>

            <br /><br />

            <?php 
                if(isset($_SESSION['add'])) //check message
                {
                    echo $_SESSION['add'];  //display message
                    unset($_SESSION['add']); //remove message
                }
                if(isset($_SESSION['upload'])) //check message
                {
                    echo $_SESSION['upload'];  //display message
                    unset($_SESSION['upload']); //remove message
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="table_30_percent">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Food Title"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Food Description"> </textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" placeholder="Food Price"></td>
                    </tr>

                    <tr>
                        <td>Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category" >
                                <?php
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                    $res = mysqli_query($conn,$sql);
                
                                    $count = mysqli_num_rows($res);
                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="0">No Category Found</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="button_secondary">
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
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];


        //Check Radio input
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        //Image
        if(isset($_FILES['image']['name']))
        {
            $img_name = $_FILES['image']['name'];

            if($img_name!="")
            {
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$img_name;

                $upload = move_uploaded_file($source_path,$destination_path);

                if($upload==FALSE)
                {
                    $_SESSION['upload']= "<div class ='fail'> Image Upload Failed. </div>";
                    header("location:".SITE_URL.'admin/add_food.php');
                    die();
                }
            }
        }
        else
        {
            $img_name="";
        }
        //Query
        $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price, 
            img_name='$img_name',
            category_id=$category,
            featured='$featured',
            active='$active'
        ";
        $res2 = mysqli_query($conn,$sql2);

        if($res2==TRUE)
        {
            $_SESSION['add'] = "<div class ='success'> Food Added Successfully. $img_name </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['add'] = "<div class ='fail'> Food Added Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_food.php');
        }
    }
    else
    {
        //Not Clicked
    }
?>