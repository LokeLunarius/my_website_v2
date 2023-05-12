<?php
    include('config/constants.php');
    if(exec("/usr/bin/python3 -m scripts.check_content 2>&1"))
    {
        //echo "Hash Removed";
        $_SESSION['add'] = "<div class ='success'> Hashed Content Added Successfully. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
    else
    {
        echo "Remove fail";
        $_SESSION['add']= "<div class ='fail'> Hashed Content Added Fail. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
?>
