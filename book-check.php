<?php
    session_start();
    if(!isset($_SESSION['tenantid'])){
        header('location: login.php');
        exit();
    }
    else{
        header('location: prop-booking.php');
        exit();
    }
    ?>