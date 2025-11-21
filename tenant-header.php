<?php
     $tentid = $_SESSION['tenantid'];
     $sql = "select * from notifications where tenant_ID = '$tentid' ";
   
     $res = mysqli_query($conn,$sql);
   
     $sql1 = "select count(not_id) as tot_noti from notifications where tenant_ID = '$tentid' AND not_status = '0' AND not_msg LIKE 'T%' ";
     $res1 = mysqli_query($conn,$sql1);
   
     $row1 = mysqli_fetch_assoc($res1);
?>
<div class = 'tenantcontainer'>
        <div class="tenant-sidebar">
            <h2><i class="fa-solid fa-house-user"></i>Tenant Dashboard</h2>
            <ul>
                <li class="nav-item"><a href="tenant-profile.php"><i class="fa-solid fa-bars"></i>     Dashboard</a></li>
                <li class="nav-item"><a href="t-details.php"><i class="fa-solid fa-user-plus"></i>     Add Profile</a></li>
                <li class="nav-item"><a href="tenant-schedule.php"><i class="fa-solid fa-calendar-check"></i>     Appointment Schedules</a></li>                
                <li class="nav-item"><a href="tenant-current-new.php"><i class="fa-solid fa-house"></i>Currently Booked Property</a></li>
                <li class="nav-item"><a href="tenant-prev.php"><i class="fa-solid fa-backward"></i>  Previous Booking</a></li>
                <li class="nav-item"><a href="monthly.php"><i class="fa-solid fa-money-check-dollar"></i>Payments</a></li>
                <li class="nav-item notification"><a href="tenant-notification.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                <?php if($row1['tot_noti']>0){ ?>
                  <span class="badge"><?php echo $row1['tot_noti'];?></span>
                <?php } ?>
                </li>
                <!--<li class="nav-item"><a href="tenant-review.php"><i class="fa-solid fa-bars"></i>     Review</a></li>-->

            </ul>
        </div>