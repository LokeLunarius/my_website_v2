<?php

    //include
    include('config/constants.php');

    //Get hash to be delete
    $id = $_GET['id'];


    //SQL Query to delete
    //$sql = "DELETE FROM tbl_hashed_web_content";
    $sql = "DELETE FROM tbl_hashed_web_content WHERE id=$id";

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