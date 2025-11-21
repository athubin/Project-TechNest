<?php include 'technest-header.php'; ?>
<?php include 'tenant-header.php'; ?>

<div class="dashboard">
    <header class="dashboard-header">
      <h1>Tenant Dashboard</h1>
    </header>

    <section class="appointments">
      <h2>Scheduled Appointments</h2>

<?php 

$tid = $_SESSION['tenantid'];

$sql = "select * from appointment  where tenant_ID = '$tid' and a_date!='0000-00-00' ";
$res= mysqli_query($conn,$sql);

if(mysqli_num_rows($res) > 0){
?>  
  <table class="appointments-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Owner Name</th>
        <th>Property Title</th>
        <th>Status</th>
        <!--<th>Actions</th>-->
      </tr>
      </thead>
      <tbody>
        <?php
        while($row = mysqli_fetch_assoc($res)){

          $a_id = $row['a_id'];
          $adate = $row['a_date'];
          $atime = $row['a_time'];
          $astatus = $row['a_status'];
          $pid = $row['p_id'];
    
          $sql1 = "select owner_name,p_title,p_booked from owner inner join property on owner.owner_ID = property.owner_ID where property.p_id = '$pid' ";
          $res1 = mysqli_query($conn,$sql1);
          $row1 = mysqli_fetch_assoc($res1);
      
          $oname = $row1['owner_name'];
          $pname = $row1['p_title'];
      
          ?>
          <tr>
              <td><?php echo "$adate" ; ?></td>
              <td><?php echo "$atime" ; ?></td>
              <td><?php echo "$oname" ; ?></td>
              <td><?php echo "$pname" ; ?></td>
              <td><?php echo "$astatus" ; ?></td>
              <?php /*if ($row1['p_booked'] == 0){
                $sts = "CONFIRMED";
                $cancel = "";
              }
              else{
                $sts = "CANCEL";
                $cancel = "cancel-appt.php?a_id=".$a_id;
              }*/?>
              <!--<td><button type="button" name="cancel" value="cancel"><a href=<?php echo $cancel ?>><?php echo $sts; ?></a></button></td>-->
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php
  }
  else{
    echo "<h3>No Appointments scheduled</h3>";
  }
  ?>
    </section>
  </div>
</body>
</html>
