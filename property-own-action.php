<?php
    
    $conn = mysqli_connect('localhost','root','','hrs');

    $pid = $_POST['pid'];
    $pstat = $_POST['pstat'];
    $pst = ($pstat == 0) ? 1 : 0 ;
    $sql = "update property set p_owner_status = '$pst' where p_id = '$pid' ";
    $res = mysqli_query($conn,$sql);
    header("location:view-booking.php");
?> 