<?php
session_start();
    $pid = $_POST['pid'];
$conn = mysqli_connect("localhost","root","","hrs");

    $date = "" ;//$_POST['appointment_date'];
    $time = "" ;//$_POST['appointment_time'];

    $sql = "select * from appointment";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res);

    $aid = "a0" . strval($row+1);

    $tid = $_SESSION['tenantid'];
     
    $astatus = "confirmed";

    $currentDate = date('Y-m-d');

    $bstatus = 0;

    $sql1 = "insert into appointment (a_id,r_date,tenant_ID,p_id,a_date,a_time,a_status,b_status) values ('$aid','$currentDate','$tid','$pid','$date','$time','$astatus','$bstatus')";
    $res1 = mysqli_query($conn,$sql1);

    /* newly added for notification */
      $tenantid = $_SESSION['tenantid'];

      $sql = "select p_title,owner_ID from property where p_id = '$pid' ";
      $res = mysqli_query($conn,$sql);

      $row = mysqli_fetch_assoc($res);

      $oid = $row['owner_ID'];

      $currentDate = date('Y-m-d');
      $notimsg = "OYou have Tenure renewal request for the property " . $row['p_title'];

      $sql = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status)
                  values ('$oid','$tenantid','$currentDate','$notimsg','0')";

      $res = mysqli_query($conn,$sql);
      /* end of newly added */
 
 header("Location: tenant-current-new.php");
 exit;

  ?>