<?php include 'owner-header.php';?>

    <div class="book-container">

        <div class='tableheader'>
            <div class='cell'>Property Title</div>
            <div class='cell'>Request Date</div>
            <div class='cell'>Appointment Date</div>
            <div class='cell'>Appointment Time</div>
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

                    //$sql = "select appointment.*, property.owner_ID from appointment,property where property.owner_ID = '$oid' ";
                    $sql = "select appointment.*, property.owner_ID, property.p_title from appointment inner join property on appointment.p_id = property.p_id 
                            where owner_id = '$oid' and appointment.a_date != '0000-00-00' ";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {

                            $pid = $row['p_id'];  

                            $sql2 = "select * from property where owner_ID = '$oid' ";
                            
                            $tid = $row['tenant_ID'];
                            
                           
                           $sql3 = "select tenant_name,tenant_phn from tenant,appointment where tenant.tenant_ID = '$tid' AND appointment.p_id = '$pid' ";
                            $res3 = mysqli_query($conn,$sql3);
                            $row3 = mysqli_fetch_assoc($res3);
                            $aid = $row["a_id"];
                            $_SESSION['tenantid'] = $tid; 
                            $statbtn = ($row['a_status'] == "confirmed") ? "Reject" : "Accept";
                            $st = ($statbtn == "Accept") ? 1 : 0 ;

                            echo "<div class='row'>
                                    <div class='cell'>" . $row["p_title"] . "</div>
                                    <div class='cell'>" . $row["r_date"] . "</div>
                                    <div class='cell'>". $row['a_date']. "</div>
                                    <div class='cell'>". $row['a_time']. "</div>
                                    <div class='cell'>". $row3['tenant_name']. "</div>
                                    <div class='cell'>". $row3['tenant_phn']. "</div>
                                    <div class='cell'>". $row['a_status']. "</div>
                                    <div class='cell'><button class='view accept-btn'><a href = 'statusupdate.php?aid=$aid&st=$st&pid=$pid'>".$statbtn."</a></button></div>
                                    
                                </div>";
                               // <button class='view'><a href = 'statusupdate.php?aid=$aid&st=0&pid=$pid'>Reject</a></button></div>
                                
                        }
                    } else {
                        echo "<div class='row'><div class='cell' colspan='3'>No results found</div></div>";
                    }
                ?>
            </table>
        </main>


    </div>
</body>
</html>

<!--select property.owner_ID from appointment,property where property.p_id = appointment.p_id;-->