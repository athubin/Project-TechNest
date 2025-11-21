<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Payment History</title>
    <style>

        .payment-header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .payment-container {
            margin: 20px auto;
            max-width: 800px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .payment-container .table-container {
            padding: 20px;
        }

        .payment-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payment-container table th, table td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 10px;
        }

        .payment-container table th {
            background-color: #f4f4f4;
        }

        .payment-container table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .payment-container .no-records {
            text-align: center;
            padding: 20px;
            font-size: 1.2em;
            color: #666;
        }

        
    </style>
</head>
<body>-->
    <?php include "technest-header.php" ?>
    <?php include "tenant-header.php" ?>

    <?php 
        
     /*   $conn = mysqli_connect("localhost","root","","hrs");
        $tid = $_SESSION['tenantid'];
        $sql = " select * from payment,booking where payment.booking_id = booking.booking_id AND booking.tenant_ID = '$tid' ";
        $res = mysqli_query($conn,$sql);
        //$row = mysqli_fetch_assoc($res);

        

    ?>
    <div class="payment-history">
        <div class="payment-header">
            <h1>Payment History</h1>
        </div>

        <div class="payment-container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Property</th>
                            <th>Location</th>
                            <th>Month</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data for reference -->
                         <?php
                            while($row=mysqli_fetch_assoc($res)){ 
                            $date = $row['payment_date'];
                            $amount = $row['payment_amt'];
                            $propid = $row['p_id'];
                            $month = $row['payment_month'];
                            $method = $row['payment_method'];

                            $sql2 = "select p_title,p_location from property where p_id = '$propid' ";
                            $res2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_assoc($res2);

                            $title = $row2['p_title'];
                            $location = $row2['p_location']; ?>
                            <tr>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $location; ?></td>
                            <td><?php echo $month; ?></td>
                            <td><?php echo $method; ?></td>
                            </tr>
                            <?php } ?>
                        
                        <!--<tr>
                            <td>2024-11-01</td>
                            <td>$1200</td>
                            <td>Paid</td>
                            <td>Bank Transfer</td>
                        </tr>
                        <tr>
                            <td>2024-10-01</td>
                            <td>$1200</td>
                            <td>Overdue</td>
                            <td>-</td>
                        </tr>-->
                    </tbody>
                </table>

                <!-- Uncomment this div if no records are present -->
                <!-- <div class="no-records">No payment history available.</div> -->
            </div>
        </div>
    </div>

    
</body>
</html>*/
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const properties = document.querySelectorAll('.payment-owner-container .property');

    properties.forEach(property => {
        const header = property.querySelector('.payment-owner-container .property-header');
        const details = property.querySelector('.payment-owner-container .property-details');

        header.addEventListener('click', () => {
            const isVisible = details.style.display === 'block';
            details.style.display = isVisible ? 'none' : 'block';
        });
    });
});
</script>
<!--</head>
<body> -->
</div>

<?php
$conn = mysqli_connect("localhost", "root", "", "hrs");
$tid = $_SESSION['tenantid'];

// Fetch properties for the specific owner
/*$sql = "SELECT * FROM property WHERE owner_ID = '$ownerid' AND p_booked = 0";
$res = mysqli_query($conn, $sql);

$sql2 = "select booking_id from booking where owner_id = '$ownerid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);
$bid = $row2['booking_id'];
$sql1 = "select sum(payment_amt) as total from payment where booking_id = '$bid' ";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);*/

$curdate = date('Y-m-d');

$sql = "select * from booking where tenant_id = '$tid' and start_date <= '$curdate' ";
$res = mysqli_query($conn,$sql);
//$row = mysqli_fetch_assoc($res);



?>

<div class="tp">
<div class="owner-payment">
<h1>Tenant Payments</h1><br>
<!-- <h2>Total Payments: <?php //echo $row1['total']; ?> </h2>-->
</div>

<div class="payment-owner-container">
<?php while ($row = mysqli_fetch_assoc($res)) { ?>
<div class="property">
    <?php $pid = $row['p_id']; 
    $sql1 = "select * from property where p_id = '$pid' ";
    $res2 = mysqli_query($conn,$sql1);
    $row2 = mysqli_fetch_assoc($res2);?>
    <div class="property-header">Property Name: <?php echo $row2['p_title']; ?></div>
    <div class="property-details">
        <table class="payments-table">
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Tenant Name</th>
                    <th>Payment Date</th>
                    <th>Payment Month</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch tenant payments specific to the property
               // $property_id = $row['p_id'];
                $sql3 = "SELECT tenant_name, booking.booking_id, payment.payment_date, payment.payment_month, payment.payment_amt, payment.payment_method
                         FROM tenant
                         JOIN booking ON tenant.tenant_ID = booking.tenant_ID
                         JOIN payment ON booking.booking_id = payment.booking_id
                         WHERE booking.tenant_id = '$tid' AND booking.p_id = '$pid' 
                         ORDER BY payment_date DESC";
                $res1 = mysqli_query($conn, $sql3);

                while ($row1 = mysqli_fetch_assoc($res1)) {
                ?>
                <tr>
                    <td><?php echo $pid; ?></td>
                    <td><?php echo $row1['tenant_name']; ?></td>
                    <td><?php echo $row1['payment_date']; ?></td>
                    <td><?php echo $row1['payment_month']; ?></td>
                    <td><?php echo $row1['payment_method']; ?></td>
                    <td><?php echo $row1['payment_amt']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
</div>
</div>
</body>
</html>

