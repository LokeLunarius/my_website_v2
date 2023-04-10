<?php

    //include
    include('config/constants.php');

    //Get ID of Admin to be delete
    if(isset($_GET['id']) AND isset($_GET['img_name']))
    {
        $id =$_GET['id'];
        $img_name=$_GET['img_name'];

        if($img_name != "")
        {
            $path = "../images/category/".$img_name;
            $remove = unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class ='fail'> Category Image Removed Fail </div>";
                header('location:'.SITE_URL.'admin/manage_category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn,$sql);
    
        //Check
        if($res==true)
        {
            //echo "Admin Removed";
            $_SESSION['delete'] = "<div class ='success'> Category Removed Successfully. </div>";
            header('location:'.SITE_URL.'admin/manage_category.php');
        }
        else
        {
            //echo "Remove fail";
            $_SESSION['delete']= "<div class ='fail'> Category Removed Fail. </div>";
            header('location:'.SITE_URL.'admin/manage_category.php');
        }

    }
    else
    {
        header('location:'.SITE_URL.'admin/manage_category.php');
    }


    //SQL Query to delete Admin

    //Redirecting
?>