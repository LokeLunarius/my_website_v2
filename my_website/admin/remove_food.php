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
            $path = "../images/food/".$img_name;
            $remove = unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class ='fail'> Food Image Removed Fail </div>";
                header('location:'.SITE_URL.'admin/manage_food.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn,$sql);
    
        //Check
        if($res==true)
        {
            //echo "Admin Removed";
            $_SESSION['delete'] = "<div class ='success'> Food Removed Successfully. </div>";
            header('location:'.SITE_URL.'admin/manage_food.php');
        }
        else
        {
            //echo "Remove fail";
            $_SESSION['delete']= "<div class ='fail'> Food Removed Fail. </div>";
            header('location:'.SITE_URL.'admin/manage_food.php');
        }

    }
    else
    {
        header('location:'.SITE_URL.'admin/manage_food.php');
    }


    //SQL Query to delete Admin

    //Redirecting
?>