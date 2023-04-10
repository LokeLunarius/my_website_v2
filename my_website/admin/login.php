<?php include('config/constants.php')?>

<html>
    <head>
        <title>Food Oder Website - Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class = "login">
            <h1 class="text_center">Login</h1>
            <br><br><br>

            <?php 
                    if(isset($_SESSION['login'])) //check message
                    {
                        echo $_SESSION['login'];  //display message
                        unset($_SESSION['login']); //remove message
                    }
                    if(isset($_SESSION['no_login_msg'])) //check message
                    {
                        echo $_SESSION['no_login_msg'];  //display message
                        unset($_SESSION['no_login_msg']); //remove message
                    }
            ?>

            <br>

            <form action="" method="POST" class="text_center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="button_primary">
            </form>
            <br><br><br>
            <p class="text_center">Created by 404 - Brainers</p>
        </div>
    </body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT*FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class ='success'> Login Successful. </div>";
            
            $_SESSION['user'] = $username; //check user login or not

            //redirect page
            header("location:".SITE_URL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class ='fail text_center'> Login Fail. </div>";
            //redirect page
            header("location:".SITE_URL.'admin/login.php');
        }
    }
?>