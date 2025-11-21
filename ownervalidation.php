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
$phnno = $_POST['phone'];
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
$upi = $_POST['upi'];

$sql1 = "select * from owner";
$res1 = mysqli_query($conn,$sql1);
$row = mysqli_num_rows($res1);

//$oid = "O0" . strval($row+1);
//$oid = "O09"

//$sql = "insert into owner values('$oid','$login','$name', '$phnno', '$mail', '$hname' , '$street', '$city','$district', '$state', '$bname', '$accno', '$ifsc', '$branch','Active')";

$sql1 = "update owner set owner_name = '$name', owner_phn = '$phnno', owner_email = '$mail', owner_housename = '$hname', owner_street = '$street', owner_city = '$city', owner_district ='$district', owner_state = '$state', owner_aadhaar = '$aadhaar', owner_bank = '$bname', owner_accno = '$accno', owner_ifsc = '$ifsc', owner_branch = '$branch', owner_upi = '$upi', owner_status = 'Active' where login_id ='$id' ";

//$_SESSION['ownerid'] = $oid;

$res = mysqli_query($conn,$sql1);
if($res){
   $msg = "Record Updated Succesfully";
}
else{
    $msg = "Record not updated";
}
header("Location: owner-profile.php?msg=$msg");
?>