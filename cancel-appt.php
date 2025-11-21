<?php

$conn = mysqli_connect('localhost','root','','hrs');

$astatus = "Cancelled";

if(isset($_GET['a_id'])){
    $a_id = $_GET['a_id'];

$sql = "update appointment set a_status = '$astatus' where a_id = '$a_id' ";

$res = mysqli_query($conn,$sql);
}


header("location: tenant-schedule.php");