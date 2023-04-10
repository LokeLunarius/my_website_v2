<?php include('Header_Footer/menu.php'); ?>
    <div class="main_content">
        <div class="wrapper">
            <h1>Add Admin</h1>

            <br /><br />

            <?php 
                    if(isset($_SESSION['add'])) //check message
                    {
                        echo $_SESSION['add'];  //display message
                        unset($_SESSION['add']); //remove message
                    }
                    if(isset($_SESSION['pw_not_match']))
                    {
                        echo $_SESSION['pw_not_match'];
                        unset($_SESSION['pw_not_match']);
                    }
            ?>

            <form action="" method="POST">
                <table class="table_30_percent">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter your username"></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter your password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="button_secondary">
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

        //Get data
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $confirm_password = md5($_POST['confirm_password']);

        //SQL Query to save data to Database
        if($password==$confirm_password)
        {
            $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
            ";

            //Execute Query and save data to Databse
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            //Check data is inserted or not and display
            if($res==TRUE)
            {
                //Success
                //Display message
                $_SESSION['add'] = "<div class ='success'> Admin Added Successfully. </div>";
                //redirect page
                header("location:".SITE_URL.'admin/manage_admin.php');
            }
            else
            {
                //Fail
                $_SESSION['add'] = "<div class ='fail'> Admin Added Fail. </div>";
                //redirect page
                header("location:".SITE_URL.'admin/add_admin.php');
            }
        }
        else
        {
            $_SESSION['pw_not_match'] = "<div class ='fail'> Password not match. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/add_admin.php');
        }

    }
    else
    {
        //Not Clicked
    }
?>