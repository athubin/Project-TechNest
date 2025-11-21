<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hrs";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!isset($_SESSION['tenantid'])){
    header('location: login.php');
    exit();
}

    $pid = $_GET['propid'];
    $currentDate = date('Y-m-d'); 

    $sql1 = "select * from booking";
    $res1 = mysqli_query($conn,$sql1);
    $row = mysqli_num_rows($res1);

    $bid = "b0" . strval($row+1);

    $sql2 = "select owner_id from property where p_id = '$pid' ";
    $res2 = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_assoc($res2);

    $tid = $_SESSION['tenantid'];
    $oid = $row['owner_id'];
    $bstatus = "Pending";
    $sql = "insert into booking (booking_id,p_id,tenant_id,owner_id,booking_date,booking_status) 
                        values ('$bid','$pid','$tid','$oid','$currentDate','$bstatus')";
    echo $sql;
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        $msg = "Request send successfully";
    }
    else
    {
        $msg =  "Failed to send request";
    } 
    header("Location: appointment.php?msg=$msg&propid=$pid");


?>

