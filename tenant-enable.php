<?php

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$tid = $_GET['tid'];
$sql2 = "select login_id from tenant where tenant_ID = '$tid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);
$logid = $row2['login_id'];

$sql1 = "select status from login where login_id = '$logid' ";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);

$login_status = 'Active';

    $sql = "update login set status = '$login_status' where login_id = '$logid' ";
    $res = mysqli_query($conn,$sql);

header('location:admin-tenant.php');
?>