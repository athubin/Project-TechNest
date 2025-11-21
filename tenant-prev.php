<?php include 'technest-header.php'; ?>
<?php include 'tenant-header.php'; ?>

<div class = "prevtenant">
    <div class="header">
        <h1>Previous Bookings</h1>
    </div>

    <!-- Table for previous bookings -->
    <table id="bookingsTable">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Tenure</th>
                <th>Property Name</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example rows (you can remove these and use JavaScript or server-side rendering to populate data dynamically) -->

            <?php
                $tid = $_SESSION['tenantid'];
                $conn = mysqli_connect('localhost','root','','hrs');
                $currentDate = date('Y-m-d');
               // $sql = "select * from booking where tenant_id = '$tid' and start_date <= '$currentDate' AND end_date >= '$currentDate' ";
               $sql = "select * from booking where tenant_id = '$tid' ";
                $res = mysqli_query($conn,$sql);

                if(mysqli_num_rows($res) > 0)
                { 
                    while($row = mysqli_fetch_assoc($res)) { 

                        $pid = $row['p_id'];
                        $bid = $row['booking_id'];
                        $sql2 = "select * from property,booking where booking.owner_id = property.owner_ID AND property.p_id = '$pid' AND booking.booking_id = '$bid' ";
                        $res2 = mysqli_query($conn,$sql2);
                        $row2 = mysqli_fetch_assoc($res2);
                        

                        $sql3 = "SELECT DATE_FORMAT(start_date, '%d-%m-%Y') AS formatted_date FROM booking where /*p_id = '$pid' &&*/ booking_id = '$bid' ";
                        $res3 = mysqli_query($conn,$sql3);
                        $row3 = mysqli_fetch_assoc($res3);
                    ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row3['formatted_date']; ?></td>
                        <td><?php echo $row['tenure']; ?></td>
                        <td><?php echo $row2['p_title']; ?></td>
                        <td><?php echo $row2['p_location']; ?></td>
                    </tr>
                    <?php } 
                } ?>
           <!-- <tr>
                <td>101</td>
                <td>2024-10-15</td>
                <td>Maintenance Check</td>
                <td>Apartment 3A</td>
            </tr>
            <tr>
                <td>102</td>
                <td>2024-09-20</td>
                <td>Annual Inspection</td>
                <td>Apartment 3A</td>
            </tr>-->
        </tbody>
    </table>

    <!-- Placeholder message if no bookings exist -->
    <div id="noBookingsMessage" class="no-bookings" style="display: none;">
        No previous bookings found for this tenant.
    </div>

    <script>
        // JavaScript to handle no bookings scenario
        const table = document.getElementById('bookingsTable');
        const noBookingsMessage = document.getElementById('noBookingsMessage');

        // Check if the table has rows in the tbody
        if (table.tBodies[0].rows.length === 0) {
            table.style.display = 'none'; // Hide the table
            noBookingsMessage.style.display = 'block'; // Show the no bookings message
        }
    </script>
</body>
</html>
