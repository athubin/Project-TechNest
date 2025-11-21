<?php
session_start();

$conn = mysqli_connect("localhost","root","","hrs");

$aid = $_GET['aid'];
$st = $_GET['st'];
$pid = $_GET['pid'];

if($st == 1)
{
    $sql = "update appointment set a_status = 'confirmed' where a_id = '$aid' ";
    $sts = "accepted";
}
else{
    $sql = "update appointment set a_status = 'rejected' where a_id = '$aid' ";
    $sts = "rejected";
}

$res = mysqli_query($conn,$sql);

/* newly added for notification */
$tenantid = $_SESSION['tenantid'];

$sql = "select p_title,owner_ID from property where p_id = '$pid' ";
$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($res);

$oid = $row['owner_ID'];

$currentDate = date('Y-m-d');

$sql2 = "select a_status from appointment where a_id = '$aid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);

if($row2['a_status'] == 'confirmed'){
    $notimsg = "TYour appointment request " . $sts . " for " . $row['p_title'];
}
else if($row2['a_status'] == 'rejected' ){
    $notimsg = "TYour appointment request " . $sts . " for " . $row['p_title'];
}



$sql = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status) 
            values ('$oid','$tenantid','$currentDate','$notimsg','0')";

$res = mysqli_query($conn,$sql);
/* end of newly added */
header('location: owner-confirm.php');

?>