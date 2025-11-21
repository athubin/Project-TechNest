<?php

$conn = mysqli_connect("localhost","root","","hrs");

$prop_id = $_GET['propid'];

$sql = "update property set p_status = 0 where p_id = '$prop_id'";
$res = mysqli_query($conn,$sql);

header("location: admin-property.php");

?>