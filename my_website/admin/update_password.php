<?php include('Header_Footer/menu.php'); ?>

    <div class="main_content">
        <div class="wrapper">
            <h1>Change Password</h1>

            <br><br>
            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
                if(isset($_SESSION['pw_not_match']))
                {
                    echo $_SESSION['pw_not_match'];
                    unset($_SESSION['pw_not_match']);
                }
            ?>
            <br><br>

            <form action="" method="POST">
                <table>
                <table class="table_30_percent">
                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                             <input type="hidden" name="id" value ="<?php echo $id?>">
                            <input type="submit" name="submit" value="Change Password" class="button_secondary">
                        </td>
                    </tr>
                </table>
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
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //Check exist
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";
        $res = mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $sql2 = "UPDATE tbl_admin SET password = '$new_password' wHERE id=$id";
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2 == TRUE)
                    {
                        $_SESSION['pw_change'] = "<div class ='success'> Password Changed Successfully. </div>";
                        //redirect page
                        header("location:".SITE_URL.'admin/manage_admin.php');
                    }
                    else
                    {
                        $_SESSION['pw_change'] = "<div class ='fail'> Password Changed Fail. </div>";
                        //redirect page
                        header("location:".SITE_URL.'admin/manage_admin.php');
                    }
                }
                else
                {
                    $_SESSION['pw_not_match'] = "<div class ='fail'> Password not match. </div>";
                    //redirect page
                    header("location:".SITE_URL.'admin/update_password.php');
                }
            }
        }
        else
        {
            $_SESSION['user_not_found'] = "<div class ='fail'> User Not Found. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/manage_admin.php');
        }
    }
    else
    {
        //Not Clicked
    }

?>