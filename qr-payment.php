<?php
// Example: Fetch landlord's UPI ID from the database (Here we are simulating the process)
//$propertyId = 'P001'; //$_GET['property_id'];  // Get the property ID from the URL

// In real use, you would query the database for this property
// For simulation, we are hardcoding the UPI ID for this example
//$upiId = 'landlord@upi'; //'landlord@upi';  // Example UPI ID

// Generate UPI URL and QR Code
//$upiUrl = "upi://pay?pa=" . urlencode($upiId) . "&pn=" . urlencode("Landlord's Property") . "&tn=" . urlencode("Rent Payment");

//$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($upiUrl) . "&size=200x200";

$conn = mysqli_connect("localhost","root","","hrs");
$bid = $_GET['bid'];
$sql = "select * from booking where booking_id = '$bid' ";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);

$oid = $row['owner_id'];
$pid = $row['p_id'];

$sql1 = "select owner_upi from owner where owner_ID = '$oid' ";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);

$upi = $row1['owner_upi'];

$sql2 = "select p_price from property where p_id = '$pid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);

$rent = $row2['p_price'];
$upiId = trim($upi); //'athirakbinu@oksbi'; // Landlord's UPI ID

$paymentAmount = $rent; // Example rent amount

$paymentMethod = "UPI";

// Generate UPI URL with the payment amount included
 $upiUrl = "upi://pay?pa=" . urlencode($upiId) 
        . "&pn=" . urlencode("Landlord's Property") 
        . "&tn=" . urlencode("Rent Payment") 
        . "&am=" . urlencode($paymentAmount) // Payment amount
        . "&cu=INR"; // Currency

// Generate the QR code URL
$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($upiUrl) . "&size=200x200";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
</head>
<body>
    <?php include 'technest-header.php'; ?>
    <?php include 'tenant-header.php'; ?>
    
    <!--<div class = 'tenantcontainer'>
        <div class="sidebar">
            <h2>Tenant Dashboard</h2>
            <ul>
                <li class="nav-item"><a href="#profile">Add Profile</a></li>
                <li class="nav-item"><a href="">Appointment Schedules</a></li>                
                <li class="nav-item"><a href="#current-booking">Currently Booked Property</a></li>
                <li class="nav-item"><a href="#previous-bookings">Previous Booking</a></li>
                <li class="nav-item"><a href="payment.php">Payments</a></li>
                <li class="nav-item"><a href="tenant-notification.php">Notifications</a></li>
            </ul>
        </div>-->

        <?php
           // $conn = mysqli_connect('localhost','root','','hrs');
            $bid = $_GET['bid'];
            $sql = "select * from booking where booking_id = '$bid' ";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);

            $pid = $row['p_id'];

            $sql1 = "select p_title,p_location,p_price from property where p_id = '$pid' ";
            $res1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
        ?>
        
        <div class='qrcontainer'>
            <h1>Property Details</h1>
            <p><strong>Property Name:</strong><?php echo $row1['p_title']; ?></p>
            <p><strong>Description:</strong><?php echo $row1['p_location']; ?></p>

            <h3>Pay Rent</h3>
            <p class="qr-instruction">Scan the QR code below to pay your rent:</p>

            <!-- Display the QR Code -->
            <img src="<?php echo $qrCodeUrl; ?>" alt="UPI QR Code for Rent Payment">

            <form action="paymentsave.php" method="post">
            <input type="hidden" name="bid" value="<?php echo $bid; ?>">
            <input type="hidden" name="paymethod" value="<?php echo $paymentMethod; ?>">
            <input type="hidden" name="rentpayable" value="<?php echo $paymentAmount; ?>">
            <input type="hidden" name="paymonth" value="<?php echo $paymonth; ?>">
            <button type="submit">Continue</button>
            </form>
        </div>

</body>
</html>