<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Rent</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        /* Body Styling 
        body {
            background: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }*/

        .pay-container{
            background: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* Container Styling */
        .prop-pay-container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .prop-pay-container .header {
            background: #4caf50;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .prop-pay-container .header h1 {
            font-size: 24px;
            font-weight: 700;
        }

        /* List of Properties */
        .prop-pay-container .property-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }

        .prop-pay-container .property-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: box-shadow 0.3s ease;
        }

        .prop-pay-container .property-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Property Details */
        .prop-pay-container .property-details {
            display: flex;
            flex-direction: column;
        }

        .prop-pay-container .property-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .prop-pay-container .property-address {
            font-size: 14px;
            color: #555;
        }

        /* Pay Rent Button */
        .prop-pay-container .pay-button {
            background: #4caf50;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .prop-pay-container .pay-button:hover {
            background: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .prop-pay-container .property-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .prop-pay-container .pay-button {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>-->
    <?php include "technest-header.php"; ?>
    <?php include "tenant-header.php"; ?>

    <?php
        $tid = $_SESSION['tenantid'];
        $curdate = date("Y-m-d");
        $sql = "select * from booking where tenant_id = '$tid' 
                    AND start_date <= '$curdate' AND end_date >= '$curdate' ";

        $res = mysqli_query($conn,$sql);
       
    ?>

    <div class = "pay-container">
    <div class="prop-pay-container">
        <div class="header">
            <h1>Select a Property to Pay Rent</h1>
        </div>
        <div class="property-list">
            <!-- Property 1 -->

            <?php 

                if(mysqli_num_rows($res) == 0 ){
                    echo "<h2> No properties booked </h2>";
                }
                else{

                while($row = mysqli_fetch_assoc($res)){

                    $pid = $row['p_id'];
                    $bid = $row['booking_id'];
                    $sql1 = "select p_title,p_location,p_price from property,booking where property.p_id = booking.p_id AND property.p_id = '$pid' ";
                    $res1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($res1);
            
                    $p_title = $row1['p_title'];
                    $p_location = $row1['p_location'];
                    $p_rent = $row1['p_price'];

                   // $_SESSION['prent']=$p_rent;
            
                    $sql2 = "select owner_name from owner, booking where owner.owner_ID = booking.owner_ID AND p_id = '$pid' ";
                    $res2 = mysqli_query($conn,$sql2);
                    $row2 = mysqli_fetch_assoc($res2); ?>
                    
                    <div class="property-item">
                        <div class="property-details">
                            <div class="property-title"><?php echo $p_title; ?></div>
                            <div class="property-address"><?php echo $p_location; ?></div>
                            <div class="property-address">Rent Amount: <?php echo $p_rent; ?></div>
                            <div class="property-address">Owner Name: <?php echo $row2['owner_name']; ?></div>
                        </div>
                        <button class="pay-button"><a href = "payment.php?bid=<?php echo $bid; ?>" >Pay Rent</a></button>
                     </div> 
                    <?php  } 
                } ?>
            
            <!-- Property 2 -->
           
        </div>
    </div>
    </div>
</body>
</html>
