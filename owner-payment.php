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
<?php include "owner-header.php"; ?>
</div>

<?php
$conn = mysqli_connect("localhost", "root", "", "hrs");
$ownerid = $_SESSION['ownerid'];

// Fetch properties for the specific owner
$sql = "SELECT * FROM property WHERE owner_ID = '$ownerid' AND p_booked = 0";
$res = mysqli_query($conn, $sql);

$sql2 = "select booking_id from booking where owner_id = '$ownerid' ";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($res2);
$bid = $row2['booking_id'];
$sql1 = "select sum(payment_amt) as total from payment where booking_id = '$bid' ";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($res1);

?>

<div class="op">
    <div class="owner-payment">
        <h1>Tenant Payments</h1><br>
       <!-- <h2>Total Payments: <?php //echo $row1['total']; ?> </h2>-->
    </div>

    <div class="payment-owner-container">
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
        <div class="property">
            <div class="property-header">Property Name: <?php echo $row['p_title']; ?></div>
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
                        <?php
                        // Fetch tenant payments specific to the property
                        $property_id = $row['p_id'];
                        $sql1 = "SELECT tenant_name, booking.booking_id, payment.payment_date, payment.payment_month, payment.payment_amt
                                 FROM tenant
                                 JOIN booking ON tenant.tenant_ID = booking.tenant_ID
                                 JOIN payment ON booking.booking_id = payment.booking_id
                                 WHERE booking.owner_id = '$ownerid' AND booking.p_id = '$property_id'";
                        $res1 = mysqli_query($conn, $sql1);

                        while ($row1 = mysqli_fetch_assoc($res1)) {
                        ?>
                        <tr>
                            <td><?php echo $property_id; ?></td>
                            <td><?php echo $row1['tenant_name']; ?></td>
                            <td><?php echo $row1['payment_date']; ?></td>
                            <td><?php echo $row1['payment_month']; ?></td>
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
