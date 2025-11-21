<?php

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['typesubmit']))
{
    $cat = $_POST['cat'];
    $status = $_POST['status'];

    $sql1 = "select * from category";
    $res1 = mysqli_query($conn,$sql1);
    $row = mysqli_num_rows($res1);

    $cid = "c0" . strval($row+1);

    $sql = "insert into category (category_ID,category_name,category_status) values('$cid','$cat','$status')";
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