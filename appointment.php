  <?php include 'technest-header.php'; 
  //session_start(); ?>
  <?php include "popup.php"; ?>
    <?php
    $pid = $_GET['propid'];
    if(!isset($_SESSION['tenantid'])){
        //header('location: login.php');
        alert("Please login to continue booking procedure","OK","Cancel","login.php","prop-details.php?propid=$pid");
        exit();
    }

if(empty($_SESSION['tenantname'])){
  alert("Please Complete your Profile Details to continue booking","Add Profile","Cancel","t-details.php","home-listings.php");
 //print_r($_SESSION);
 exit;
}
?>

<?php
  if(isset($_POST['appsub']))
  {
    $conn = mysqli_connect("localhost","root","","hrs");

    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    //$pid = $_GET['propid'];

    $sql = "select * from appointment";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res);

    $aid = "a0" . strval($row+1);

    $tid = $_SESSION['tenantid'];
    echo "Appointmnet sent successfully!";
    
    $astatus = "Pending";

    $currentDate = date('Y-m-d');

    $bstatus = 0;

    $sql1 = "insert into appointment (a_id,r_date,tenant_ID,p_id,a_date,a_time,a_status,b_status) values ('$aid','$currentDate','$tid','$pid','$date','$time','$astatus','$bstatus')";
    $res1 = mysqli_query($conn,$sql1);

    /* newly added for notification */
      $tenantid = $_SESSION['tenantid'];

      $sql = "select p_title,owner_ID from property where p_id = '$pid' ";
      $res = mysqli_query($conn,$sql);

      $row = mysqli_fetch_assoc($res);

      $oid = $row['owner_ID'];

      $currentDate = date('Y-m-d');
      $notimsg = "OYou have an appointment request for the property " . $row['p_title'];

      $sql = "insert into notifications (owner_ID,tenant_ID,not_date, not_msg, not_status) 
                  values ('$oid','$tenantid','$currentDate','$notimsg','0')";

      $res = mysqli_query($conn,$sql);
      /* end of newly added */

  }
  ?>
<div class = "schedule-container">
  <div class="appointment-form">
    <h2>Schedule Your Appointment</h2>
    <?php
     $currentDate = date('Y-m-d');
     ?>
    <form action="" method="POST">
      <div class="form-group">
        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="appointment_date" min=<?php echo $currentDate; ?> required>
      </div>
      <div class="form-group">
        <label for="time">Choose Time:</label>
        <input type="time" id="time" name="appointment_time" required>
      </div>
      <button type="submit" class="submit-btn" name="appsub">Set Appointment</button>
    </form>
  </div>
</div>

</body>
</html>
