<?php include 'owner-header.php'; ?>
<?php
        //$conn=mysqli_connect('localhost','root','','hrs');
        $oid = $_SESSION['ownerid'];

        $sql = "select count(*) as properties from property where owner_id = '$oid' ";
        //exit;
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $properties = $row['properties'];

        $sql1 = "select count(*) as bookings from booking where owner_id = '$oid' ";
        $res1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($res1);
        $bookings = $row1['bookings'];

        $sql2 = "select count(*) as appts from appointment inner join property on appointment.p_id = property.p_id where property.owner_ID = '$oid' and a_date!='0000-00-00' ";  
        $res2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $appts = $row2['appts'];

       $sql3 = "select start_date,end_date,booking_status from booking where owner_id = '$oid' ";
        $res3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($res3);
        $start = isset($row3['start_date']) ? $row3['start_date'] : "";
        $end = isset($row3['end_date']) ? $row3['end_date'] : "";
        $bstatus = isset($row3['booking_status']) ? $row3['booking_status'] : "";
        $currentDate = date('Y-m-d'); 

        if($end == $currentDate){
            $bstatus = 'Tenure ended';
        }

      /*  $sql1 = 'select count(*) from appointment where owner_id = "$oid" ';
        $res1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_num_rows($res1);*/

        ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- own-header 
            <div class="own-header">
                <h1>Owner Dashboard</h1>
                <button>Log Out</button>
            </div>-->

            <!-- Statistics Section -->
            <div class="statistics">
                <div class="stat-card">
                    <h2><?php echo $properties; ?></h2>
                    <p>Total Properties</p>
                </div>
                <div class="stat-card">
                    <h2><?php echo $bookings; ?></h2>
                    <p>Active Bookings</p>
                </div>
                <div class="stat-card">
                    <h2><?php echo $appts; ?></h2>
                    <p>Appointment Request</p>
                </div>
            </div>

            <!-- Dashboard Sections -->
            <div class="dashboard-sections">
                <!-- Properties Section -->
                <div class="dashboard-card" id="properties">
                    <h3>Properties</h3>
                    <p>Manage your properties, add new listings, and view property details.</p>
                    <a href="owner2.php" class="btn">Manage Properties</a>
                </div>

                <!-- Bookings Section -->
                <div class="dashboard-card" id="bookings">
                    <h3>Bookings</h3>
                    <p>View current bookings and approve requests.</p>
                    <a href="owner-booking.php" class="btn">View Bookings</a>
                </div>

                <!-- Messages Section -->
                <div class="dashboard-card" id="messages">
                    <h3>Appointments</h3>
                    <p>Check and respond to appointment requests from tenants.</p>
                    <a href="" class="btn">Go to Messages</a>
                </div>

                <!-- Settings Section -->
                <div class="dashboard-card" id="settings">
                    <h3>Profile</h3>
                    <p>Update account information, profile photo, bank details.</p>
                    <a href="owner-profile.php" class="btn">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
