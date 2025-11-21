<?php
session_start();
//print_r($_SESSION);
$id = $_SESSION['loginid'];

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass=""; 

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$login = $_POST['loginid'];
$name = $_POST['name'];
$phnno = $_POST['phnno'];
$mail = $_POST['email'];
$hname = $_POST['hname'];
$street = $_POST['street'];
$city = $_POST['city'];
$district = $_POST['district'];
$state = $_POST['state'];
$bname = $_POST['bname'];
$accno = $_POST['accno'];
$ifsc = $_POST['ifsc'];
$branch = $_POST['branch'];
$aadhaar = $_POST['aadhaar'];

$sql1 = "select * from tenant";
$res1 = mysqli_query($conn,$sql1);
$row = mysqli_num_rows($res1);

$tid = $_SESSION['tenantid'];

//$tid = "t0" . strval($row+1);

//$sql = "insert into owner values('$oid','$login','$name', '$phnno', '$mail', '$hname' , '$street', '$city','$district', '$state', '$bname', '$accno', '$ifsc', '$branch','Active')";

$sql1 = "update tenant set tenant_name = '$name', tenant_phn = '$phnno', tenant_email = '$mail', tenant_housename = '$hname', tenant_street = '$street', tenant_city = '$city', tenant_district ='$district', tenant_state = '$state', tenant_aadhaar = '$aadhaar', tenant_bank = '$bname', tenant_accno = '$accno', tenant_ifsc = '$ifsc', tenant_branch = '$branch', tenant_status = 'Active' where login_id ='$id' ";

//$_SESSION['tenantid'] = $tid;

$res = mysqli_query($conn,$sql1);
if($res){
    header("location:t-details.php");
    exit;
    //echo "Details updated successfully";
}
?>
