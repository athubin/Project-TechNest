
<?php include 'admin-header.php'; ?>
<?php

    $servername = "localhost"; // Change if needed
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "hrs"; // Replace with your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $datefilter = "";
    if(isset($_POST['rptsubmit'])){
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

        $datefilter = " and login_date >= '$sdate' AND login_date <= '$edate'";
    } 


    $sql = "Select * from owner,login where owner.login_id = login.login_id" . $datefilter;
    $result = mysqli_query($conn,$sql); ?>

    <main class="main-content">
        <header>
            <h1>Dashboard</h1>
            <!--<button class="add-property">Add New Property</button>-->
        </header>

        <div clsss="rptfilter">
            <form action="" method="post">
                <span>Start Date: </span>
                <input type="date" name="sdate" value="<?php echo $sdate; ?>">
                <span>End Date: </span>
                <input type="date" name="edate" value="<?php echo $edate; ?>">
                <button type=submit name="rptsubmit" value="Show">Show</button>
                <button type=submit name="rptallsubmit" value="All">ALL</button>
            </form>
        </div>
        <?php
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row

        ?>
        


            <section class="property-list">
                <h2>Owner Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Phone No</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <?php
                            $oid = $row['owner_ID'];
                            $sql1 = "select login_id from owner where owner_ID = '$oid' ";
                            $res1 = mysqli_query($conn,$sql1);
                            $row1 = mysqli_fetch_assoc($res1);
                            $logid = $row1['login_id'];

                            $sql2 = "select status from login where login_id = '$logid' ";
                            $res2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_assoc($res2);
                            ?>
                            <td><?php echo $row['owner_ID'];?></td>
                            <td><?php echo $row['owner_name'];?></td>
                            <td><?php echo $row['owner_city'];?></td>
                            <td><?php echo $row['owner_phn'];?></td>
                            <?php
                            $sts = ($row2['status'] == 'Active' ? "Active" : "Not Active");
                            ?>  
                            <td><?php echo $sts;?></td>
                            <td>
                                <button><a href="owner-enable.php?oid=<?php echo $row['owner_ID'];?>">Active</a></button>
                                <button><a href="owner-disable.php?oid=<?php echo $row['owner_ID'];?>">Disable</a></button>
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
            <button id="downloadBtn">Download PDF</button>
            <?php 
        }
        else{
            echo "<h2>No records found in this period</h2>";
        } // if closing?>
        </main>
        
   </div>
   <script>
        document.getElementById("downloadBtn").
        addEventListener('click', function(){
            window.print();
        });
    </script>
</body>
</html>