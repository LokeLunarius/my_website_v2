<?php

    //include
    include('config/constants.php');

    //Get ID of Admin to be delete
    $id = $_GET['id'];


    //SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute query
    $res = mysqli_query($conn,$sql);

    //Check
    if($res==true)
    {
        //echo "Admin Removed";
        $_SESSION['delete'] = "<div class ='success'> Admin Removed Successfully. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }
    else
    {
        //echo "Remove fail";
        $_SESSION['delete']= "<div class ='fail'> Admin Removed Fail. </div>";
        header('location:'.SITE_URL.'admin/manage_admin.php');
    }

    //Redirecting
?>