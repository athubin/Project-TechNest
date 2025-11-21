<?php include 'admin-header.php'; ?>
<?php

    $servername = "localhost"; // Change if needed
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "hrs"; // Replace with your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "Select * from property where p_booked=0";
    $result = mysqli_query($conn,$sql);

   $datefilter = "";
    if(isset($_POST['rptsubmit'])){
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

        $datefilter = " and p_date >= '$sdate' AND p_date <= '$edate'";
    }

    $sql = "Select * from owner,property where property.owner_ID = owner.owner_ID and property.p_booked = 0" . $datefilter;
    $result = mysqli_query($conn,$sql); 

?>
<main style="width:75%">
<h2 class="view">Rented Properties</h2>

<div class="rptfilter">
            <form action="" method="post">
                <span>Start Date: </span>
                <input type="date" name="sdate" value="<?php echo $sdate; ?>">
                <span>End Date: </span>
                <input type="date" name="edate" value="<?php echo $edate; ?>">
                <button type=submit name="rptsubmit" value="Show">Show</button>
                <button type=submit name="rptallsubmit" value="All">ALL</button>
            </form>
        </div>

    <section class="property-list-view">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Rent</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <?php $pid = $row['p_id']; ?>
                <td><?php echo $row['p_id'];?></td>
                <td><?php echo $row['p_title'];?></td>
                <td><?php echo $row['p_location'];?></td>

                <td>Rs.<?php echo $row['p_price'];?></td>
                <?php
               /* $sts = ($row['p_status'] == 1 && $row['p_booked'] == 1 ? "Available" : "Rented");
                $sts = ($row['p_status'] == 1 && $row['p_booked'] == 0 ? "Available" : "Not Available");
                $sts = ($row['p_status'] == 0 && $row['p_booked'] == 0 ? "Not Available" : "Available");*/

                if($row['p_status']==1){
                    if($row['p_booked']==1){
                        $sts = 'Available';
                    }
                    else{
                        $sts = 'Rented';
                    }
                }
                else{
                    if($row['p_booked']==0){
                        $sts = 'Rented';
                    }
                    else{
                        $sts = "Not Available";
                    }
                   
                }
                
                $stsbtn = ($row['p_status'] == 1)? 'Disable' : 'Enable';
                $status = $row['p_status'];
                ?>
                <td><?php echo $sts;?></td>
                <td><?php echo $row['p_date'];?></td>
                <td>
                    <a href = "property-disable.php?pid=<?php echo $pid;?>&&status=<?php echo $status;?>"><button><?php echo $stsbtn; ?></button></a>
                </td>
            </tr>
            <?php }  // while closing?>
            <!--<tr>
                <td>2</td>
                <td>Modern Apartment</td>
                <td>Downtown</td>
                <td>$200/night</td>
                <td>Unavailable</td>
                <td>
                    <button>Edit</button>
                    <button>Delete</button>
                </td>
            </tr>-->
            <!-- Add more property rows as needed -->
        </tbody>
    </table>
</section>
            </main>

<style>
    .rptfilter {
    margin-left: 25%;
    margin-bottom: 63px;
    }
</style>