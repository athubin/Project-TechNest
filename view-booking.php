<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Property Dashboard</title>
    <style>
/* Container */
.view-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1rem;
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

/* Property Card */
.view-container .property-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.view-container .property-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.view-container .property-details {
    padding: 1rem;
    text-align: center;
}

.view-container .property-details h2 {
    margin: 0.5rem 0;
    font-size: 1.2rem;
}

.view-container .property-details p {
    margin: 0.3rem 0;
}

/* Buttons */
.view-container .action-button {
    padding: 0.5rem 1rem;
    margin: 0.5rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9rem;
}

.view-container .action-button:hover {
    opacity: 0.8;
}

.view-container .action-button.delete {
    background-color: #f44336;
    color: white;
}

.view-container .action-button {
    background-color: #4caf50;
    color: white;
}
</style>
</head>
<body>-->

    <?php include 'owner-header.php'; ?>
</div>

<?php
    $conn = mysqli_connect("localhost","root","","hrs");

    $oid = $_SESSION['ownerid'];

    //$sql = "select * from property where owner_ID = '$oid' AND p_owner_status = 1 ";
    $sql = "select * from property where owner_ID = '$oid'";
    $res = mysqli_query($conn,$sql);
    
    
?>
<div class = "view-header">
    <h1>Properties Posted</h1>
</div>

    <main class="view-container">

        <?php 
            while($row = mysqli_fetch_assoc($res)){
                $p_img = $row['p_image1'];
                
                $pid = $row['p_id'];
                $pstat = $row['p_owner_status'];
                $pbooked = $row['p_booked'];

                $bstatus = "Available";
                if($row['p_booked'] == 0){
                    $bstatus = "Rented";
                }
                $delButton = ($pstat == 0) ? "Enable" : "Disable" ;
                $confText = ($pstat == 0) ? "Sure to Enable Property?" : "Sure to Disable Property?" ;
                //$disabled = ($pbooked == 0) ? " disabled " : "" ;
                $disabledStyle = ($pstat == 0) ? 'style="background:#f44336"' : "";
                $passVars = "'".$pid ."'" . ", " . "'". $pstat. "'" ;
                $disabled = "";
                if($pbooked == 0){
                    $disabled = " disabled ";
                    $disabledStyle = 'style="cursor:not-allowed"';
                }
                ?> 

                <div class="property-card">
                    <img src= "uploads/<?php echo $p_img; ?>"  alt="Property Image" class="property-image">
                    <div class="property-details">
                        <h2><?php echo $row['p_title']; ?></h2>
                        <p><strong>Location:</strong><?php echo $row['p_location']; ?></p>
                        <p><strong>Price:</strong><?php echo $row['p_price']; ?></p>
                        <p><strong>Status:</strong><?php echo $bstatus; ?></p>
                        <!--<button class="action-button delete"><a href = "property-own-action.php?pid=<?php //echo $pid;?>">Delete</a></button>-->
                        <?php if($pbooked == 0){ ?>
                        <div class="tooltip">
                        <?php } ?>
                        <button <?php echo $disabledStyle; ?>
                            <?php echo $disabled; ?>
                            class="action-button delete" 
                            onclick="showDisableProp(<?php echo $passVars; ?>)">
                            <?php echo $delButton; ?>
                        </button>
                        <?php if($pbooked == 0){ ?>
                        <span class="tooltiptext">Currently rented properties cannot be disabled.</span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- Hidden Renew Tenure (initially hidden) -->

            <div id = "disablePropModal" class="endmodal">
                <div class="modal-content">
                    <span class="close-button" onclick="closeModal()">&times;</span>
                    <h3 id="dispText"><?php echo $confText; ?></h3>
                    <form action="property-own-action.php" method="post">
                        <input type="hidden" id="pid" name="pid" value="<?php echo $pid ; ?>">
                        <input type="hidden" id="pstat" name="pstat" value="<?php echo $pstat ; ?>">
                        <div class="modal-buttons">
                            <button id="dispBtn" type="submit">Disable</button>
                            <button type="button" onclick="closeModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

    
    </main>
<script>
    function showDisableProp(propid,propstat){
        document.getElementById("pid").value=propid;
        document.getElementById("pstat").value=propstat;
        if(propstat == 0){
            var txt = "Sure to Enable?";
            var dispbtn = "Enable";
        }
        else{
            var txt = "Sure to Disable?";
            var dispbtn = "Disable";
        }
        document.getElementById("dispText").innerHTML = txt;
        document.getElementById("dispBtn").innerHTML = dispbtn;
        const modal = document.getElementById("disablePropModal");
        modal.style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        const modal = document.getElementById('disablePropModal');
        modal.style.display = 'none';
    }

</script>
</body>
</html>
