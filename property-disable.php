<?php

$conn = mysqli_connect('localhost','root','','hrs');
$pid = $_GET['pid'];
$status = $_GET['status'];

$st = ($status == 1)? 0 : 1 ;
$sql = "update property set p_status = '$st' where p_id = '$pid' ";
$res = mysqli_query($conn,$sql);

header("location: admin-property-view.php");

