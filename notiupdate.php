<?php
session_start();

$conn = mysqli_connect("localhost","root","","hrs");

$notid = $_GET['notid'];
$rs = $_GET['rs'];

$logid = $_SESSION['loginid'];
//$pid = $_GET['pid'];

if($rs == 1)
{
    $sql = "update notifications set not_status = '1' where not_id = '$notid' ";
    $sts = "accepted";
}
else{
    $sql = "update notifications set not_status = '0' where not_id = '$notid' ";
    $sts = "rejected";
}

$res = mysqli_query($conn,$sql);

$sql2 = "select type from login where login_id = '$logid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);
if($row2['type']=='Owner'){
    header('location: owner-notification.php');
}
else{
    header('location: tenant-notification.php');
}

