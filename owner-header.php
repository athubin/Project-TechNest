<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technest Rentals - Owner Dashboard</title>
    <script src="https://kit.fontawesome.com/5aca3b7b17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/owner.css">
    <link rel="stylesheet" href="css/ownernew.css">
    <link rel="stylesheet" href="css/booking.css">
    <style> 
        /* Reset and Basic Styling 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

       /* body {*/
      /* .own-container{
            background-color: #f4f6f9;
            display: flex;
        }

        /* Sidebar Styling */
       /* .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #3a4d63;
            color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 40px;
            color: #ffab00;
        }

        .sidebar ul {
            list-style-type: none;
            width: 100%;
        }

        .sidebar ul li {
            margin: 20px 0;
            width: 100%;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ffffff;
            padding: 10px;
            display: block;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 17px;
        }

        .sidebar ul li a:hover {
            background-color: #ffab00;
            color: #3a4d63;
        }

        /* Main Content */
      /*  .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        /* Enhanced own-header */
       /* .own-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #3a4d63;
            padding: 15px 30px;
            color: #ffffff;
            /*border-radius: 8px;
            margin-bottom: 30px;*/
        }

      /*  .own-header h1 {
            font-size: 24px;
            color: #ffab00;
        }

        .own-header h3 {
            font-size: 24px;
            color: #ffab00;
            font-style: italic;
            font-family: none;
        }

        .own-header button {
            background-color: #ffab00;
            color: #3a4d63;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .own-header button:hover {
            background-color: #3a4d63;
            color: #ffab00;
        }

        /* Dashboard Sections */
      /*  .dashboard-sections {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-card {
            background-color: #ffffff;
            width: calc(50% - 13px);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #3a4d63;
        }

        .dashboard-card p {
            color: #666666;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .dashboard-card .btn {
            text-align: center;
            background-color: #ffab00;
            color: #ffffff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .dashboard-card .btn:hover {
            background-color: #333333;
        }

        /* Statistics Section */
      /*  .statistics {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            width: calc(33% - 13px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card h2 {
            font-size: 24px;
            color: #3a4d63;
            margin-bottom: 10px;
        }

        .stat-card p {
            color: #666666;
            font-size: 18px;*/
        }
    </style>
</head>
<body>

    <?php

        $conn = mysqli_connect("localhost","root","","hrs");
        $ownerid = $_SESSION['ownerid'];
        $logid = $_SESSION['loginid'];

        $sql3 = "select username from login where login_id = '$logid' ";
        $res3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($res3);

        $sql2 = "select owner_name from owner where owner_ID = '$ownerid' ";
        $res2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($res2);

        $sql = "select * from notifications where owner_ID = '$ownerid' ";
    
        $res = mysqli_query($conn,$sql);
    
        $sql1 = "select count(not_id) as tot_noti from notifications where owner_ID = '$ownerid' AND not_status = '0' AND not_msg LIKE 'O%' ";
        $res1 = mysqli_query($conn,$sql1);
    
        $row1 = mysqli_fetch_assoc($res1)
    ?>

    <div class="own-header">
        <h2>Technest Rentals</h2>
        <h1>Owner Dashboard</h1>
        <h3>Welcome <?php echo $row3['username']; ?></h3>
        <button id = 'logoutBtn' class = 'logoutBtn'>Log Out</button>
    </div>

    <div class="own-container"> 

        <!-- Sidebar -->
        <div class="sidebar">
            <!--<h2>Technest Rentals</h2>-->
            <ul>
                <li><a href="owner3.php"><i class="fa-solid fa-bars"></i> Dashboard</a></li>
                <li><a href="owner2.php"><i class="fa-solid fa-house-laptop"></i> Properties</a></li>
                <li><a href="owner-confirm.php"><i class="fa-solid fa-calendar-check"></i> Appointment Requests</a></li>
                <li><a href="owner-booking.php"><i class="fa-solid fa-bookmark"></i> Booking Confirmations</a></li>
                <li><a href="booked.php"><i class="fa-solid fa-bookmark"></i> Booking Details</a></li>
               <!-- <li><a href="#messages"><i class="fa-solid fa-comment"></i> Messages</a></li> -->
                <li><a href="owner-profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a href="owner-payment.php"><i class="fa-solid fa-money-check-dollar"></i> Payments</a></li>
                <li class="nav-item notification"><a href="owner-notification.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                <?php if($row1['tot_noti']>0){ ?>
                    <span class="badge"><?php echo $row1['tot_noti'];?></span>
                <?php }  ?>
                
                </li>
            </ul>
        </div>

        <?php
            include 'logout.php';
        ?>