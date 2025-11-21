<!--<style>
    /* Styles for the modal (popup) */
    .endmodal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1000; /* Above other elements */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Black background with transparency */
    }

    .endmodal .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 300px;
        border-radius: 10px;
        text-align: center;
    }

    .endmodal .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .endmodal .close-button:hover,
    .endmodal .close-button:focus {
        color: black;
        text-decoration: none;
    }

    .endmodal .modal-buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 15px;
    }

    .endmodal .modal-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: darkorange;
    }

    .endmodal .modal-buttons button:hover {
        background-color: #ddd;
    }
</style>-->
<?php include 'technest-header.php'; ?>
    <?php include 'tenant-header.php'; ?>
    <div class="tbcontainer">
        <div class="header">
            <h1>Current Property Booking</h1>
        </div>

        <?php

            $tid = $_SESSION['tenantid'];

            $currentDate = date('Y-m-d'); 

            $sql3 = "select * from booking where tenant_id = '$tid' AND end_date >= '$currentDate' ";
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

                    $bid = $row3['booking_id'];

                    $pname = $row['p_title'];
                    $ploc = $row['p_location'];
                    $pstartdate = $row2['start_date'];
                    $psd = $row2['formatted_date'];
                    $ptenure = $row3['tenure'];
                    $pprice = $row['p_price'];
                    $enddate = $row3['end_date'];
                    $renewdatebtn = $enddate;
                    $status = $row3['booking_status'];
                    $renewdatebtn = date_create($renewdatebtn);
                    //$renewdatebtn_date_only = $renewdatebtn->format('Y-m-d');

                    date_sub($renewdatebtn,date_interval_create_from_date_string("2 Months"));
                    $renewdatebtn = $renewdatebtn->format('Y-m-d');

                    $sql5 = "select * from appointment where p_id = '$pid' and a_date = '0000-00-00' ";
                    $res5 = mysqli_query($conn,$sql5);
                    $row5 = mysqli_fetch_assoc($res5);

                    $numrows = mysqli_num_rows($res5);

                    if($numrows > 0){
                        $bstat = $row5['b_status'];
                        $renewstatus = ($bstat == 0) ? 'Requested' : 'Approved' ;
                    }

        ?>

                <div id="currentBooking" class="property-details">
                    <h2>Property Name: <?php echo $pname; ?></h2>
                    <p><strong>Address:</strong><?php echo $ploc; ?></p>
                    <p><strong>Booking Start Date:</strong><?php echo $psd; ?></p>
                    <p><strong>Tenure:</strong> <?php echo $ptenure; ?></p>
                    <p><strong>Monthly Rent ₹:</strong> <?php echo $pprice; ?></p>
                    <?php /*if(!empty($enddate)){
                            echo "<p><strong>Tenure ends on: </strong>" . date("d-m-Y", strtotime($enddate)) . "</p>" ; }*/ ?>
                    
                    <?php if($status == 'Tenure ended'){
                        echo "<p><strong>Tenure ends on: </strong>" . date("d-m-Y", strtotime($enddate)) . "</p>" ; } ?>
                    <?php if($numrows>0){
                        echo "<p><strong>Renew Tenure status: </strong>" . $renewstatus . "</p>" ; } ?>           
                </div>
        
                <div id="actions" class="actions">
                <!--<p><strong>Monthly Rent ₹:</strong> <?php echo $bid; ?></p>-->

                    <?php
                        $rtdisabledbtn = ($currentDate >= $renewdatebtn) ? '' : 'disabled';
                        $etdisabledbtn = ($status == 'Tenure ended') ? 'disabled' : '';
                        $rtdisabledbtn = ($etdisabledbtn == 'disabled') ? 'disabled' : $rtdisabledbtn ;
                    ?>
                    <button class="renew-button" onclick="showRenewTenure('<?php echo $pid;?>')" <?php echo $rtdisabledbtn; ?>>Renew Tenure</button>
                    <button class="end-button" onclick="showDatePicker('<?php echo $bid; ?>')" <?php echo $etdisabledbtn; ?>>End Tenure</button>

                </div>

                
 
        <?php
                }
            }
            else{
                echo "<h2> No Bookings </h2>";
            }
        ?>

<!-- Hidden Renew Tenure (initially hidden) -->

<div id = "renewTenureModal" class="endmodal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal1()">&times;</span>
        <h3>Sure to Renew Tenure</h3>
        <form action="renewtenure.php" method="post">
            <input type="hidden" id="pid" name="pid" value="<?php echo $pid ; ?>">
            <div class="modal-buttons">
                <button type="submit">Yes</button>
                <button typpe="button" onclick="closeModal1()">Cancel</button>
            </div>
        </form>
    </div>
</div>


<!-- Hidden date picker (initially hidden) -->
<div id="endTenureModal" class="endmodal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <h3>Select End Date</h3>
        <form action="endtenure.php" method="post">
            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="enddate" min="<?php echo $pstartdate; ?>">
            <input type="hidden" id="bid" name="bid" value="<?php echo $bid; ?>">
            <div class="modal-buttons">
                <button onclick="submitEndDate()">Submit</button>
                <button type="button" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>

function showRenewTenure(propid){ 
    document.getElementById("pid").value=propid;
    const modal = document.getElementById("renewTenureModal");
    modal.style.display = 'block';
}


const tenureStartDate = "<?php echo $pstartdate; ?>"; // Start date from PHP

// Show the modal
function showDatePicker(bookid) { 
    document.getElementById("bid").value=bookid;
    const modal = document.getElementById('endTenureModal');
    modal.style.display = 'block';

    // Set the min date for the date picker
    const endDateInput = document.getElementById('end-date');
    endDateInput.min = tenureStartDate;
}

// Close the modal
function closeModal() {
    const modal = document.getElementById('endTenureModal');
    modal.style.display = 'none';
}

// Handle submission
function submitEndDate() {
    const selectedDate = document.getElementById('end-date').value;

    if (!selectedDate) {
        alert('Please select a date.');
        return;
    }

    // You can process the date here or send it to the server via AJAX
    console.log('Selected End Date:', selectedDate);

    // Optionally, redirect or process further
    alert('End date submitted: ' + selectedDate);
    closeModal();
}
</script>
