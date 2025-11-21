<?php include 'owner-header.php'; ?>

<?php
    $conn = mysqli_connect("localhost","root","","hrs");
    $oid = $_SESSION['ownerid'];
    $sql = "SELECT * FROM property WHERE owner_ID = '$oid' AND p_owner_status = 1";
    $res = mysqli_query($conn, $sql);
?>

<div class="view-header">
    <h1>Properties Posted</h1>
</div>

<main class="view-container">

    <?php 
        while($row = mysqli_fetch_assoc($res)) {
            $p_img = $row['p_image1'];
            $pid = $row['p_id'];
            $bstatus = "Available";
            if ($row['p_booked'] == 0) {
                $bstatus = "Rented";
            }
    ?>

        <div class="property-card">
            <img src="uploads/<?php echo $p_img; ?>" alt="Property Image" class="property-image">
            <div class="property-details">
                <h2><?php echo $row['p_title']; ?></h2>
                <p><strong>Location:</strong> <?php echo $row['p_location']; ?></p>
                <p><strong>Price:</strong> <?php echo $row['p_price']; ?></p>
                <p><strong>Status:</strong> <?php echo $bstatus; ?></p>
                <!-- Delete button with a confirmation prompt -->
                <button class="action-button delete" onclick="confirmDelete(<?php echo $pid; ?>)">Delete</button>
            </div>
        </div>

        <!-- Popup for confirmation with a unique ID -->
        <div id="deleteConfirmation<?php echo $pid; ?>" class="deleteConfirmation" style="display:none;">
            <div class="popup-overlay">
                <div class="popup-content">
                    <h3>Are you sure you want to delete this property?</h3>
                    <button onclick="deleteProperty(<?php echo $pid; ?>)" id="confirmDelete<?php echo $pid; ?>">Confirm</button>
                    <button onclick="closePopup(<?php echo $pid; ?>)">Cancel</button>
                </div>
            </div>
        </div>

    <?php
        }
    ?>

</main>

<script>
    let propertyIdToDelete = null;

    // Show the confirmation popup for the specific property ID
    function confirmDelete(pid) {
        propertyIdToDelete = pid;
        // Show the corresponding confirmation popup by the unique property ID
        document.getElementById("deleteConfirmation" + pid).style.display = "block";
    }

    // Close the popup for the specific property ID
    function closePopup(pid) {
        document.getElementById("deleteConfirmation" + pid).style.display = "none";
    }

    // Delete the property (this will redirect to the deletion page)
    function deleteProperty(pid) {
        // Redirect to the property delete action with the PID
        window.location.href = "property-own-action.php?pid=" + pid;
    }
</script>

<style>
    /* Styles for the popup */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .popup-content button {
        margin: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup-content button#confirmDelete {
        background-color: red;
        color: white;
    }

    .popup-content button {
        background-color: #4CAF50;
        color: white;
    }
</style>
</body>
</html>
