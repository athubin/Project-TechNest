
<?php include 'admin-header.php'; ?>
<?php

    $servername = "localhost"; // Change if needed
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "hrs"; // Replace with your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "Select * from property order by p_id DESC limit 5";
    $result = mysqli_query($conn,$sql);

    $sql1 = "Select * from property";
    $result1 = mysqli_query($conn,$sql1);

    $sql2 = "Select * from property where p_status = '1' && p_booked = 1"; // for showing available properties
    $res2 = mysqli_query($conn,$sql2);

    $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
    $last_day_this_month  = date('Y-m-t');

    $sql3 = "Select * from booking where booking_date BETWEEN '$first_day_this_month' AND '$last_day_this_month' "; // for showing available bookings this month
    $res3 = mysqli_query($conn,$sql3);

    $sql4 = "Select * from property where p_status = 0";
    $res4 = mysqli_query($conn,$sql4);

   /* $sql5 = "select sum(payment_amt) as total from payment";
    $res5 = mysqli_query($conn,$sql5);
    $row5 = mysqli_fetch_assoc($res5);*/

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row

?>
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>

            <section class="cards">
                <div class="card">
                    <h3>Total Properties</h3>
                    <p><?php echo mysqli_num_rows($result1);?></p>
                </div>
                <div class="card">
                    <h3>Available Properties</h3>
                    <p><?php echo mysqli_num_rows($res2);?></p>
                </div>
                <div class="card">
                    <h3>Bookings This Month</h3>
                    <p><?php echo mysqli_num_rows($res3);?></p>
                </div>
                <div class="card">
                    <h3>Pending Requests</h3>
                    <p><?php echo mysqli_num_rows($res4);?></p>
                </div>

               <!-- <div class="card">
                    <h3>Total Payments</h3>
                    <p><?php //echo $row5['total'];?></p>
                </div>-->

            </section>

            <section class="property-list">
                <h2>Properties</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Rent</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <?php $pid = $row['p_id']; ?>
                            <td><?php echo $row['p_id'];?></td>
                            <td><?php echo $row['p_title'];?></td>
                            <td><?php echo $row['p_location'];?></td>
                            <td>Rs.<?php echo $row['p_price'];?></td>
                            <?php
                            if($row['p_status']==1){
                                if($row['p_booked']==1){
                                    $sts = 'Available';
                                }
                                else{
                                    $sts = 'Rented';
                                }
                            }
                            else{
                                if($row['p_booked']==0){
                                    $sts = 'Rented';
                                }
                                else{
                                    $sts = "Not Available";
                                }
                               
                            }
                            
                            $stsbtn = ($row['p_status'] == 1)? 'Disable' : 'Enable';
                            $status = $row['p_status'];
                            ?>
                            <td><?php echo $sts;?></td>
                            <td>
                                <a href = "property-disable.php?pid=<?php echo $pid;?>&&status=<?php echo $status;?>"><button><?php echo $stsbtn; ?></button></a>
                            </td>
                        </tr>
                        <?php }  // while closing?> 
                        
                        <!-- Add more property rows as needed -->
                    </tbody>
                </table>
            </section>
        </main>
        <?php 
        } // if closing?>
   </div>
</body>
</html>