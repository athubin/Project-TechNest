<?php

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['typesubmit']))
{
    $sub = $_POST['sub'];
    $status = $_POST['status'];

    $sql1 = "select * from subcategory";
    $res1 = mysqli_query($conn,$sql1);
    $row = mysqli_num_rows($res1);

    $sid = "s0" . strval($row+1);

    $sql = "insert into subcategory (sid,s_name,s_status) values('$sid','$sub','$status')";
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        $msg = "Record added successfully";
    }
    else
    {
        $msg =  "You have already registered";
    } 
    header("Location: property-category.php?msg=$msg");
}

?>