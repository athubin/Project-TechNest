<?php include 'owner-header.php';?>

    <div class="booking-container">

        <div class='owntableheader'>
            <div class='cell'>Property Title</div>
            <div class='cell'>Request Date</div>
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

// Optimized query to join tenant and appointment tables
$sql = "SELECT 
            appointment.*,
            property.owner_ID, 
            property.p_title, 
            tenant.tenant_ID, 
            tenant.tenant_name, 
            tenant.tenant_phn
        FROM 
            appointment 
        INNER JOIN 
            property ON appointment.p_id = property.p_id
        INNER JOIN 
            tenant ON appointment.tenant_ID = tenant.tenant_ID
        WHERE 
            property.owner_ID = '$oid' AND a_status = 'confirmed'";

$result = mysqli_query($conn, $sql);
$curdate = date('Y-m-d');

if (mysqli_num_rows($result) > 0) {
    // Loop through each row to display data
    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['p_id'];  
        $bstatus = $row['b_status'];

        $bstatusmsg = $bstatus == 0 ? "Not Approved" : "Approved";

        if($row['a_date']=='0000-00-00'){
            $bstatusmsg = 'Tenure Renewed';
        }

       /* $sql4 = "select * from tenant,appointment where tenant.tenant_ID = appointment.tenant_ID";
                            $res4 = mysqli_query($conn,$sql4);
                            $row4 = mysqli_fetch_assoc($res4); // tenant details
                            $tid = $row4['tenant_ID'];*/

        $tid = $row['tenant_ID'];
        echo "<div class='row'>
                <div class='cell'>" . htmlspecialchars($row["p_title"]) . "</div>
                <div class='cell'>" . htmlspecialchars($row["r_date"]) . "</div>
                <div class='cell'>" . htmlspecialchars($row["tenant_name"]) . "</div>
                <div class='cell'>" . htmlspecialchars($row["tenant_phn"]) . "</div>
                <div class='cell'>" . htmlspecialchars($bstatusmsg) . "</div>";

        if ($bstatus == 0) {
            $ppid = '"' . $pid . '"' ;
            $ttid = '"' . $tid . '"' ;
            echo "<div class='cell'><button class='view accept-btn' onclick='openModal($ppid,$ttid)'>Accept</button></div>";
        } else {
            echo "<div class='cell'><button class='view'>Accepted</button></div>"; 
        }

        echo "</div>";
    }
} else {
    echo "<div class='row'><div class='cell' colspan='5'>No results found</div></div>";
}

// Close connection

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
                <input type="hidden" id="pid" name="pid" value = <?php echo $pid; ?>>
                <input type="hidden" id="tid" name="tid" value = <?php echo $tid; ?>>
                <label for="advanceAmount">Advance Amount Received:</label>
                <input type="number" id="advanceAmount" name="advance_amount" required>
                </div>
                <div class="form-group">
                <label for="tenureMonths">Tenure in Months:</label>
                <input type="number" id="tenureMonths" name="tenure_months" required>
                </div>
                <div class="form-group">
                <label for="startMonth">Tenure starting month and year:</label>
                <input type="date" id="startMonth" name="start_month" min='$curdate' required>
                </div>
                <button type="submit" class="save-btn" name='confirm'>Save</button>
            </form>
            </div>
        </div>

  

    </div>
<!-- JavaScript for opening and closing modal -->
<script>
    function openModal(pid,tid) {
      document.getElementById("pid").value = pid;
      document.getElementById("tid").value = tid;
      document.getElementById("modalOverlay").style.display = "flex";
    }

    function closeModal() {
      document.getElementById("modalOverlay").style.display = "none";
    }
  </script>
</body>
</html>

<!--select property.owner_ID from appointment,property where property.p_id = appointment.p_id;--> 