<?php include('Header_Footer/menu.php'); ?>

    <div class="main_content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>
            <?php 
                //Query
                $id=$_GET['id'];
                $sql="SELECT*FROM tbl_admin WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                //Check
                if($res==TRUE)
                {
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        header('location:'.SITE_URL.'admin/manage_admin.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="table_30_percent">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value ="<?php echo $id; ?>">
                            <input type="submit" name="submit" value= "Update Admin" class="button_secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('Header_Footer/footer.php');?>
<?php

    if(isset($_POST['submit']))
    {
        //Clicked

        //Get data
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //SQL Query to save data to Database
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username'
            WHERE id='$id'
        ";

        //Execute Query and save data to Databse
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check data is inserted or not and display
        if($res==TRUE)
        {
            //Success
            //Display message
            $_SESSION['update'] = "<div class ='success'> Admin Update Successfully. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_admin.php');
        }
        else
        {
            //Fail
            $_SESSION['update'] = "<div class ='fail'> Admin Update Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/add_admin.php');
        }

    }
    else
    {
        //Not Clicked
    }

?>