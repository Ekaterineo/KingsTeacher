<?php
    require(__DIR__."/constants.php");
    $con=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    if(!$con){
        die("Server connection failed ".mysqli_error());
    }
    $db_select=mysqli_select_db($con,DB_NAME);
    if(!$db_select){
        die("Database connection failed ".mysqli_error());
    }


    /*$conS=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME2);
    if(!$conS){
        die("Server connection failed ".mysqli_error());
    }
    $db_select2=mysqli_select_db($con,DB_NAME);
    if(!$db_select2){
        die("Database connection failed ".mysqli_error());
    }*/
?>