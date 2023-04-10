<?php include('Header_Footer/menu.php'); ?>
    <div class="main_content">
        <div class="wrapper">
            <h1>Add Category</h1>

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
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>

                    <tr>
                        <td>Image: </td>
                        <td><input type="file" name="image"></td>
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
                            <input type="submit" name="submit" value="Add Category" class="button_secondary">
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
        //Check Image
        if(isset($_FILES['image']['name']))
        {
            $img_name = $_FILES['image']['name'];

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
            }
        }
        else
        {
            $img_name="";
        }



        //Query
        $sql = "INSERT INTO tbl_category SET
            title='$title',
            img_name='$img_name',
            featured='$featured',
            active='$active'
        ";
        $res = mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class ='success'> Category Added Successfully. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_category.php');
        }
        else
        {
            $_SESSION['add'] = "<div class ='fail'> Category Added Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_category.php');
        }
    }
    else
    {
        //Not Clicked
    }
?>