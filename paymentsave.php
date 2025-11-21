
<?php
session_start();

$bid = $_POST['bid'];
$paymonth = $_POST['paymonth'];
$paymethod = $_POST['paymethod'];
$payrent = $_POST['payrent'];
$oid = $_POST['ownerid'];
$title = $_POST['title'];

$rentpayable = $_POST['rentpayable'];

$paydate = date("Y-m-d");
//$payremarks = "";

$servername = "localhost"; // Change if needed
			$username = "root"; // Replace with your database username
			$password = ""; // Replace with your database password
			$dbname = "hrs"; // Replace with your database name

			// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "select * from payment";
$res1 = mysqli_query($conn,$sql1);
$row = mysqli_num_rows($res1);

$paymentid = "p0" . strval($row+1);

$targetDir = "uploads/";
$filename = $_FILES["reciept"]["name"];
$targetFile = $targetDir . basename($_FILES["reciept"]["name"]);



if (move_uploaded_file($_FILES["reciept"]["tmp_name"], $targetFile)) {
	
	
	echo "The file " . htmlspecialchars(basename($_FILES["reciept"]["name"])) . " has been uploaded.";
	
} else {
	echo "Sorry, there was an error uploading your file.";
}



$sql = "insert into payment (payment_id,booking_id,payment_method,payment_amt,payment_month,payment_ss,payment_date) 
					values ('$paymentid','$bid','$paymethod','$rentpayable','$paymonth','$filename','$paydate')";

$res = mysqli_query($conn,$sql);
if($res)
{
	$msg = "Payment successful";
}
else
{
	$msg =  "Payment failed";
} 

 /* newly added for notification */
      $tenantid = $_SESSION['tenantid'];

	 $currentDate = date('Y-m-d');
	 $notimsg = "OPayment update for the property " . $title . " of the month " . $paymonth;

	 $sql4 = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status) 
				 values ('$oid','$tenantid','$currentDate','$notimsg','0')";

	

	 $res4 = mysqli_query($conn,$sql4);
	 /* end of newly added */

//header("Location: payment-property.php?msg=$msg");
header("Location: athu.php?msg=$msg");

$_SESSION['paymentid'] = $paymentid;


?>