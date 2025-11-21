<?php include 'owner-header.php'; ?>
    <div class="owner-book-container">
        <h1>Booking Details</h1>

        <?php
            $oid = $_SESSION['ownerid'];

            $conn = mysqli_connect('localhost','root','','hrs');
            $sql = "select * from property where owner_ID = '$oid' && p_booked = 0";
            $res = mysqli_query($conn,$sql);
           // $row = mysqli_fetch_assoc($res);

            
            ?>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Booking Start Date</th>
                    <th>Tenure</th>
                    <th>Booking End Date</th>
                    <th>Tenant Name</th>
                    <th>Tenant Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    while($row = mysqli_fetch_assoc($res)){
                        $pid = $row['p_id'];
            
                        $sql1 = "select start_date,tenure,end_date,booking_status,tenant_name,tenant_phn from booking b,tenant t where p_id = '$pid' && b.tenant_ID = t.tenant_ID";
                        $res1 = mysqli_query($conn,$sql1);
                        $numrows = mysqli_num_rows($res1);
                        while($row1 = mysqli_fetch_assoc($res1)){

                       /* $bstatus = "Inactive";
                        if($row1['booking_status'] == "approved"){
                            $bstatus = "Active";
                        } */
                       if($numrows > 1){
                        $bstatus = "Tenure Renewed";
                       }
                        $bstatus = "Booked";
                        ?>

                        <tr>
                            <td><?php echo $row['p_title']; ?></td>
                            <td><?php echo $row1['start_date']; ?></td>
                            <td><?php echo $row1['tenure']." Months"; ?></td>
                            <td><?php echo $row1['end_date']; ?></td>
                            <td><?php echo $row1['tenant_name']; ?></td>
                            <td><?php echo $row1['tenant_phn']; ?></td>
                            <td><?php echo $bstatus; ?></td>
                        </tr>
                    <?php
                    }
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
