<?php
    include('config/constants.php');
    
    if(shell_exec("python -m scripts.check_content"))
    {
        //echo "Hash Removed";
        $_SESSION['add'] = "<div class ='success'> Hashed Content Added Successfully. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
    else
    {
        //echo "Remove fail";
        $_SESSION['add']= "<div class ='fail'> Hashed Content Added Fail. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
?>
