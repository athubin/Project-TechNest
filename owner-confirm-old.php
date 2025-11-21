<?php include 'owner-header.php';?>

    <div class="book-container">

        <div class='tableheader'>
            <div class='cell'>Property Title</div>
            <div class='cell'>Request Date</div>
            <div class='cell'>Appointment Date</div>
            <div class='cell'>Appointment Time</div>
            <div class='cell'>Tenant Name</div>
            <div class='cell'>Tenant Contact</div>
            <div class='cell'>Status</div>
            <div class='cell'>Action</div>
        </div>

                <?php
                
                    
                    $oid = $_SESSION['ownerid'];
                    $lid = $_SESSION['loginid'];
                    $servername = "localhost"; // Change if needed
                    $username = "root"; // Replace with your database username
                    $password = ""; // Replace with your database password
                    $dbname = "hrs"; // Replace with your database name

                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    // Check connection
                    if (mysqli_connect_errno()) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    //$sql = "select appointment.*, property.owner_ID from appointment,property where property.owner_ID = '$oid' ";
                    $sql = "select appointment.*, property.owner_ID, property.p_title from appointment inner join property on appointment.p_id = property.p_id 
                            where owner_id = '$oid'";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {

                            $pid = $row['p_id'];  

                            $sql2 = "select * from property where owner_ID = '$oid' ";
                            //$res2 = mysqli_query($conn,$sql2);
                            //$row2 = mysqli_fetch_assoc($res2);

                            //$sql3 = "select tenant_name,tenant_phn from tenant,appointment where tenant.tenant_ID = appointment.tenant_ID  ";
                            $tid = $row['tenant_ID'];
                            $sql3 = "select tenant_name,tenant_phn from tenant,appointment where tenant.tenant_ID = '$tid'";
                            $res3 = mysqli_query($conn,$sql3);
                            $row3 = mysqli_fetch_assoc($res3);

                            echo "<div class='row'>
                                    <div class='cell'>" . $row["p_title"] . "</div>
                                    <div class='cell'>" . $row["r_date"] . "</div>
                                    <div class='cell'>". $row['a_date']. "</div>
                                    <div class='cell'>". $row['a_time']. "</div>
                                    <div class='cell'>". $row3['tenant_name']. "</div>
                                    <div class='cell'>". $row3['tenant_phn']. "</div>
                                    <div class='cell'>". $row['a_status']. "</div>
                                    <div class='cell'><button class='view accept-btn' onclick=openModal()>Accept</button>
                                    <button class='view'>Reject</button></div>
                                </div>";
                             
                                
                        }
                    } else {
                        echo "<div class='row'><div class='cell' colspan='3'>No results found</div></div>";
                    }
                ?>
            </table>
        </main>

      <!-- Modal overlay -->
        <div class="modal-overlay" id="modalOverlay">
            <div class="modal-content">
            <!-- Close button -->
            <button class="close-btn1" onclick="closeModal()">×</button>
            
            <h3>Enter Details</h3>

            <!-- Form fields inside modal -->
            <form action="booking-tbl.php" method="POST">
                <div class="form-group">
                <input type="hidden" name="pid" value = <?php echo $pid; ?>>
                <input type="hidden" name="tid" value = <?php echo $tid; ?>>
                <label for="advanceAmount">Advance Amount Received:</label>
                <input type="number" id="advanceAmount" name="advance_amount" required>
                </div>
                <div class="form-group">
                <label for="tenureMonths">Tenure in Months:</label>
                <input type="number" id="tenureMonths" name="tenure_months" required>
                </div>
                <button type="submit" class="save-btn" name='confirm'>Save</button>
            </form>
            </div>
        </div>

  

    </div>
<!-- JavaScript for opening and closing modal -->
<script>
    function openModal() {
      document.getElementById("modalOverlay").style.display = "flex";
    }

    function closeModal() {
      document.getElementById("modalOverlay").style.display = "none";
    }
  </script>
</body>
</html>

<!--select property.owner_ID from appointment,property where property.p_id = appointment.p_id;-->