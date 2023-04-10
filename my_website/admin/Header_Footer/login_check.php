<?php
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no_login_msg'] = "<div class='fail text_center'>Please Login to acces Admin Panel.</div>";
        header('location:'.SITE_URL.'admin/login.php');
    }
?>