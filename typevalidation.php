<?php

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['typesubmit']))
{
    $type = $_POST['type'];
    $status = $_POST['status'];

    $sql1 = "select * from type";
    $res1 = mysqli_query($conn,$sql1);
    $row = mysqli_num_rows($res1);

    $tid = "t0" . strval($row+1);

    $sql = "insert into type (type_ID,type_name,type_status) values('$tid','$type','$status')";
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