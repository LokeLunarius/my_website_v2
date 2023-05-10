<?php 
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    //Start Session
    session_start();

    //create Constant to store Non Repeating Values
    define('SITE_URL','http://localhost/my_website/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'mock_website');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>
<?php
    //Query
    $remote_address = $_SERVER['REMOTE_ADDR'];
    $url =  $_SERVER['REQUEST_URI'];

    $sql = "INSERT INTO tbl_tracking_log SET
        timestamp=now(),
        ip_address='$remote_address',
        url='$url'
    ";
    mysqli_query($conn,$sql);
?>