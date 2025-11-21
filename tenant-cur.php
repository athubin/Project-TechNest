<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Current Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .tbcontainer {
            max-width: 600px;
            margin: 0 auto;
        }
        .tbcontainer .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .tbcontainer .property-details {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffff;
        }
        .tbcontainer .property-details h2 {
            margin-top: 0;
            color: #007bff;
        }
        .tbcontainer .property-details p {
            margin: 5px 0;
            color: #333;
        }
        .tbcontainer .no-booking {
            text-align: center;
            color: #555;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>-->
    <?php include 'technest-header.php'; ?>
    <?php include 'tenant-header.php'; ?>
    <div class="tbcontainer">
        <div class="header">
            <h1>Current Property Booking</h1>
        </div>

        <?php

            $tid = $_SESSION['tenantid'];

            $sql3 = "select * from booking where tenant_id = '$tid' ";
            $res3 = mysqli_query($conn,$sql3);

            if(mysqli_num_rows($res3) > 0){

                while($row3 = mysqli_fetch_assoc($res3)){

                    $pid = $row3['p_id'];
            
                    $sql = "select p_title,p_location,p_price from property where p_id = '$pid ' ";
                    $res = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($res);

                    /*$sql1 = "select * from booking where tenant_ID = '$tid' ";
                    $res1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($res1);*/

                    $sql2 = "SELECT start_date, DATE_FORMAT(start_date, '%d-%m-%Y') AS formatted_date, booking_id FROM booking where tenant_ID = '$tid' AND p_id = '$pid' ";
                    $res2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $bid = $row2['booking_id'];

                    $pname = $row['p_title'];
                    $ploc = $row['p_location'];
                    $pstartdate = $row2['start_date'];
                    $psd = $row2['formatted_date'];
                    $ptenure = $row3['tenure'];
                    $pprice = $row['p_price'];
        ?>

                <div id="currentBooking" class="property-details">
                    <h2>Property Name: <?php echo $pname; ?></h2>
                    <p><strong>Address:</strong><?php echo $ploc; ?></p>
                    <p><strong>Booking Start Date:</strong><?php echo $psd; ?></p>
                    <p><strong>Tenure:</strong> <?php echo $ptenure; ?></p>
                    <p><strong>Monthly Rent:</strong>  <?php echo $pprice; ?></p>
                </div>
        
                <div id="actions" class="actions">
                    <button class="renew-button">Renew Tenure</button>
                    <!-- <button class="end-button" onclick="showDatePicker()"><a href="endtenure.php?bid=<?php echo $bid;?>" >End Tenure</button> -->
                    <button class="end-button" onclick="showDatePicker()">End Tenure</button>
                    <?php //echo $psd; ?>
                </div>

                <!-- Hidden date picker (initially hidden) -->
                <div id="date-picker-container" style="display:none;">
                    <label for="end-date">Select End Date:</label>
                    <input type="date" id="end-date" name="end_date" min='<?php echo $pstartdate; ?>'>
                </div>
        <?php
                }
            }
            else{
                echo "<h2> No Bookings </h2>";
            }
        ?>

<script>
    // Assuming $tenure_start_date is a PHP variable holding the tenure start date
    const tenureStartDate = "<?php echo $pstartdate; ?>"; // Format: YYYY-MM-DD
te
    // Function to show the date picker and set the minimum date
    function showDatePicker() {
        // Show the date picker
        document.getElementById('date-picker-container').style.display = 'block';

        // Get the date picker input element
        const endDateInput = document.getElementById('end-date');

        // Set the min attribute to the tenure start date
        endDateInput.min = tenureStartDate; // The date format is automatically handled by the browser
    }
</script>
        <!-- Current Booking Details -->
        

        <!-- Placeholder for no booking -->
        <!--<div id="noBookingMessage" class="no-booking" style="display: none;">
            No current booking found for this tenant.
        </div>
    </div>

    <script>
        // JavaScript to handle no current booking scenario
        const currentBooking = document.getElementById('currentBooking');
        const noBookingMessage = document.getElementById('noBookingMessage');

        // Example condition: If current booking doesn't exist, show no booking message
        const hasCurrentBooking = true; // Change to false to simulate no booking
        if (!hasCurrentBooking) {
            currentBooking.style.display = 'none';
            noBookingMessage.style.display = 'block';
        }
    </script>-->
</body>
</html>
