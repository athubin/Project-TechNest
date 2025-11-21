<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Tenant Payments</title>
    <style>

        .owner-payment {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .payment-owner-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .payment-owner-container .property {
            background: #fff;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .payment-owner-container .property-header {
            background: #3498db;
            color: #fff;
            padding: 15px;
            font-size: 18px;
        }

        .payment-owner-container .payments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-owner-container .payments-table th, .payments-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .payment-owner-container .payments-table th {
            background-color: #f4f4f9;
            font-weight: bold;
        }

        .payment-owner-container .payments-table tr:hover {
            background-color: #f1f1f1;
        }

        .payment-owner-container .no-payments {
            padding: 15px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body> -->

<?php include "owner-header.php"; ?>
</div>

<?php
    $conn=mysqli_connect("localhost","root","","hrs");
    $ownerid = $_SESSION['ownerid'];
    $sql = " select * from property where owner_ID = '$ownerid' ";
    $res = mysqli_query($conn,$sql);
    //$row = mysqli_fetch_assoc($res);
    
?>
<div class = "op">
    <div class = "owner-payment">
        <h1>Tenant Payments</h1>
    </div>

    <div class="payment-owner-container">
        <!-- Example Property 1 -->
        <div class="property">
            <div class="property-header">Property 1: <?php echo $name; ?></div>
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Tenant Name</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($res)){ 
                    
                    $name = $row['p_title'];

                    $sql1 = "select tenant_name,booking_id from tenant,booking where tenant.tenant_ID = booking.tenant_ID AND booking.owner_id = '$ownerid' ";
                    $res1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($res1);

                    $tname = $row1['tenant_name'];
                    $bid = $row1['booking_id'];

                    $sql2 = "select * from payment where booking_id = '$bid' ";
                    $res2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $paymentdate = $row2['payment_date'];
                    $paymentamt = $row2['payment_amt'];
                ?>
                    <tr>
                    <td><?php echo $tname; ?></td>
                    <td><?php echo $paymentdate; ?></td>
                    <td><?php echo $paymentamt; ?></td>
                </tr>
                <?php } ?>
                    
                   <!-- <tr>
                        <td>Jane Smith</td>
                        <td>2024-12-10</td>
                        <td>$1400</td>
                    </tr> -->
                </tbody>
            </table>
        </div>

        <!-- Example Property 2 -->
        <div class="property">
            <div class="property-header">Property 2: 456 Elm Street</div>
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Tenant Name</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Michael Brown</td>
                        <td>2024-12-05</td>
                        <td>$1000</td>
                    </tr>
                    <tr>
                        <td>Sarah Wilson</td>
                        <td>2024-12-15</td>
                        <td>$900</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Example Property with no payments -->
        <div class="property">
            <div class="property-header">Property 3: 789 Oak Avenue</div>
            <div class="no-payments">No payments have been recorded for this property.</div>
        </div>
    </div>
</div>
</body>
</html>

<!-- old -->

<div class="payment-owner-container">
        <!-- Example Property 1 -->
        <?php while($row = mysqli_fetch_assoc($res)){ ?>
 
            <div class="property">
            <div class="property-header">Property Name: <?php echo $row['p_title']; ?></div>
         
                <?php
                    $sql1 = "select tenant_name,booking_id from tenant,booking where tenant.tenant_ID = booking.tenant_ID AND booking.owner_id = '$ownerid' ";
                    $res1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($res1);

                    $tname = $row1['tenant_name'];
                    $bid = $row1['booking_id'];

                    $sql2 = "select * from payment where booking_id = '$bid' ";
                    $res2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($res2); 

                    $paymentdate = $row2['payment_date'];
                    $paymentamt = $row2['payment_amt'];
                    $paymentmonth = $row2['payment_month'];

            ?>
       <!-- <div class="property">
            <div class="property-header">Property Name: <?php echo $row['p_title']; ?></div>-->
            <div class="property-details">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Property ID</th>
                            <th>Tenant Name</th>
                            <th>Payment Date</th>
                            <th>Payment Month</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['p_id']; ?></td>
                            <td><?php echo $tname; ?></td>
                            <td><?php echo $paymentdate; ?></td>
                            <td><?php echo $paymentmonth; ?></td>
                            <td><?php echo $paymentamt; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <?php } ?>
