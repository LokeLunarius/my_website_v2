<?php

    //include
    include('config/constants.php');

    //Get hash to be delete


    //SQL Query to delete
    $sql = "DELETE FROM tbl_hashed_web_content";

    //Execute query
    $res = mysqli_query($conn,$sql);

    //Check
    if($res==true)
    {
        //echo "Hash Removed";
        $_SESSION['delete'] = "<div class ='success'> Hashed Content Removed Successfully. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
    else
    {
        //echo "Remove fail";
        $_SESSION['delete']= "<div class ='fail'> Hashed Content Removed Fail. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }

    //Redirecting
?>