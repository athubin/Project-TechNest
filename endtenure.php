<?php
    $conn = mysqli_connect("localhost","root","","hrs");

    $bid = $_POST['bid'];
    $enddate = $_POST['enddate'];

    $booking_status = "Tenure ended";

   $sql = "update booking set booking_status = '$booking_status', end_date = '$enddate'  where booking_id = '$bid' ";
    $res = mysqli_query($conn,$sql);

    $sql1 = "select booking.tenant_id, booking.owner_id, tenant.tenant_name, property.p_title
                from booking 
            inner join 
                tenant on booking.tenant_id = tenant.tenant_ID
            inner join 
                property on property.p_id = booking.p_id 
            where booking.booking_id = '$bid' ";
    $res1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($res1);

    $oid = $row1['owner_id'];
    $tenantid = $row1['tenant_id'];
    $currentDate = date('Y-m-d');
    $ptitle = $row1['p_title'];
    $tname = $row1['tenant_name'];
    $notimsg = "OTenant(". $tname .") has requested End Tenure of " . $ptitle . " on " . $enddate;

    $sql2 = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status)
                values ('$oid','$tenantid','$currentDate','$notimsg','0')";
    $res2 = mysqli_query($conn,$sql2);

    header("location: tenant-current-new.php");
    exit;
?>