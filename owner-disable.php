<?php

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$oid = $_GET['oid'];
$sql2 = "select login_id from owner where owner_ID = '$oid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);
$logid = $row2['login_id'];

$sql1 = "select status from login where login_id = '$logid' ";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);

$login_status = 'Not Active';

    $sql = "update login set status = '$login_status' where login_id = '$logid' ";
    $res = mysqli_query($conn,$sql);

header('location:admin-owner.php');
?>