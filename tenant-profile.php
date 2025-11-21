    <?php include 'technest-header.php'; ?>
    
        <?php include 'tenant-header.php'; ?>

        <?php
            $tid = $_SESSION['tenantid'];
            $conn = mysqli_connect('localhost','root','','hrs');
            $currentDate = date('Y-m-d');
            $sql = "select count(*) AS count from booking where tenant_id = '$tid' and start_date <= '$currentDate' AND end_date >= '$currentDate' ";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            $count = $row['count'];

            $sql2 = "select count(*) as booking from booking where tenant_id = '$tid' and start_date <= '$currentDate' AND end_date >= '$currentDate'  ";
            $res2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($res2);
            $booking = $row2['booking'];

            $sql3 = "select count(not_id) as tot_noti from notifications where tenant_ID = '$tentid' AND not_status = '0' AND not_msg LIKE 'T%' ";
            $res3 = mysqli_query($conn,$sql3);
          
            $row3 = mysqli_fetch_assoc($res3);
            $noti = $row3['tot_noti'];
        ?>

        <!-- Main Content -->
        <div class="tenantcontent">
            <h3>Welcome to your Dashboard</h3>
            <p>Select an option from the sidebar to get started.</p>

            <!-- Statistics Section -->
            <div class="stats-section">
                <div class="stat-card">
                    <h4>Total Properties Booked</h4>
                    <p><?php echo $count; ?></p>
                </div>
                <div class="stat-card">
                    <h4>Active Bookings</h4>
                    <p><?php echo $booking; ?></p>
                </div>
                <!--<div class="stat-card">
                    <h4>Pending Payments</h4>
                    <p>1</p>
                </div>-->
                <div class="stat-card">
                    <h4>Notifications</h4>
                    <p><?php echo $noti; ?></p>
                </div>
            </div>

            <!-- Main Sections -->
            <a href = "t-details.php" style = "text-decoration: none"><div id="profile" class="section">
                <h3>Add Profile</h3>
                <p>Here you can add or update your profile information to keep your account up-to-date.</p>
            </div></a>

            <a href = "tenant-current-new.php" style = "text-decoration: none"><div id="current-booking" class="section">
                <h3>Currently Booked Property</h3>
                <p>View details about the property you are currently renting, including the address, rent, and tenancy period.</p>
            </div></a>

            <a href = "tenant-prev.php" style = "text-decoration: none"><div id="previous-bookings" class="section">
                <h3>Previous Bookings</h3>
                <p>Check your past bookings and rental history to keep track of your tenancy records.</p>
            </div></a>

            <a href = "monthly.php" style = "text-decoration: none"><div id="rent-payments" class="section">
                <h3>Monthly Rent Payments</h3>
                <p>Manage your monthly rent payments, view payment history, and set up payment reminders.</p>
            </div></a>

            <a href = "tenant-notification.php" style = "text-decoration: none"><div id="notifications" class="section">
                <h3>Notifications</h3>
                <p>Stay updated with important notifications and announcements from the property management.</p>
            </div></a>
        </div>
    </div>
</body>
</html>
