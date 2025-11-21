<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Owner-Notification</title>
  
</head>
<body>
<?php //include 'technest-header.php'; ?>
<?php include 'owner-header.php'; ?>
<?php 
    
 $ownerid = $_SESSION['ownerid'];
 $conn = mysqli_connect("localhost","root","","hrs");
 $sql = "SELECT *, SUBSTRING(not_msg, 2) AS trimmed_text FROM notifications WHERE owner_ID = '$ownerid' AND not_msg LIKE 'O%'";
  /*echo $sql;
  exit;*/

  $res = mysqli_query($conn,$sql);

?>
        
        <div class="tenantcontent">
            <div class="payment-container">
                <h2>Notifications</h2>
            </div>

            <?php
                if (mysqli_num_rows($res) > 0) {
                  $sl = 0;
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($res)) {
                        $sl++;
            ?>
                        <div class="notification-container">
                            <?php 
                            $dt = strtotime($row['not_date']);
                            //echo $sl . ". " . date("d/m/Y", $dt); 
                            echo '<span style="margin-right: 10px;">' . $sl . '.</span>' . date("d/m/Y", $dt); ?>
   
                            <!-- newly commented --Your appointment request <?php //echo $stmsg; ?> for <?php //echo $row['p_title']; ?>-->
                            <?php 
                              $readmsg = ($row['not_status'] == 0) ? '<strong>'. $row['trimmed_text'].'</strong>' : $row['trimmed_text'];
                              //echo '<span style="margin-left: 10%; ">' . $read . $row['trimmed_text']. '</strong></span>';
                              echo '<span style="margin-left: 10%; ">' . $readmsg. '</span>'; 
                              echo "<div class='read'>";
                              $notid = $row['not_id'];
                              if($row['not_status'] == 0){
                                echo "<a href='notiupdate.php?notid=$notid&rs=1'><button>Mark as read</button></a>";
                              }
                              else{
                                echo "<a href='notiupdate.php?notid=$notid&rs=0'><button>Mark as Unread</button></a>";
                              }
                              echo "</div>";
                            ?>
                        </div>
                <?php }
                } ?>
        </div>
    </div>

</body>
</html>
