<?php
session_start();
$conn = mysqli_connect("localhost","root","","hrs");

if(isset($_POST['confirm']))
  {
$pid = $_POST['pid'];
$tid = $_POST['tid'];
$adv_amt = $_POST['advance_amount'];
$tenure = $_POST['tenure_months'];
$start = $_POST['start_month'];

$oid = $_SESSION['ownerid'];

$currentDate = date('Y-m-d');

$sql = "select * from booking";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res);

    $bid = "b0" . strval($row+1);

$status = "approved";

$date=date_create($start);
date_add($date,date_interval_create_from_date_string($tenure." Months"));
$date=date_format($date,"Y-m-d");

$sql = "insert into booking (booking_id,p_id,tenant_id,owner_id,booking_date,adv_amount,tenure,start_date,end_date,booking_status) values ('$bid','$pid','$tid','$oid','$currentDate','$adv_amt','$tenure','$start','$date','$status')";
$res = mysqli_query($conn,$sql);

$sql1 = "update property set p_booked = 0 where p_id = '$pid' ";
$res1 = mysqli_query($conn,$sql1);

$sql2 = "update appointment set b_status = 1 where p_id = '$pid' AND tenant_ID = '$tid' ";
$res2 = mysqli_query($conn,$sql2);

/* newly added for notification */

$sql = "select p_title,owner_ID from property where p_id = '$pid' ";
$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($res);

$currentDate = date('Y-m-d');
$notimsg = "TYour booking for the property " . $row['p_title'] . " has been confirmed for the date " . $start;

$sql = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status) 
            values ('$oid','$tid','$currentDate','$notimsg','0')";

$res = mysqli_query($conn,$sql);
/* end of newly added */
header("Location: owner-booking.php");
exit;
//echo $sql;
  }
