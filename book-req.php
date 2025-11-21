<?php include 'owner-header.php';?>

<div class="bookcontainer">
    <div class="tableheader">
        <div class="cell">Request ID</div>
        <div class="cell">Property Title</div>
        <div class="cell">Request Date</div>
        <div class="cell">Status</div>
        <div class="cell">Action</div>
    </div>
    
    <!-- Sample Table Rows -->
    <div class="table-row">
        <div class="cell" data-label="Request ID">12345</div>
        <div class="cell" data-label="Property Title">Beachfront Villa</div>
        <div class="cell" data-label="Request Date">12/11/2024</div>
        <div class="cell" data-label="Status">Pending</div>
        <div class="cell" data-label="Action"><button>View</button></div>
    </div>
    
    <div class="table-row">
        <div class="cell" data-label="Request ID">67890</div>
        <div class="cell" data-label="Property Title">Mountain Cabin</div>
        <div class="cell" data-label="Request Date">15/11/2024</div>
        <div class="cell" data-label="Status">Approved</div>
        <div class="cell" data-label="Action"><button>View</button></div>
    </div>
    
    <!-- Add more rows as needed -->
</div>


                <?php
                    
                 /*   $oid = $_SESSION['ownerid'];
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

                    $sql = "SELECT * FROM booking where owner_id = '$oid' ";
                    $result = mysqli_query($conn,$sql);

                   
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {

                            $pid = $row['p_id'];
                            $sql2 = "select * from property where p_id = '$pid' ";
                            $res2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_assoc($res2);

                            echo "<div class='row'>
                                    <div class='cell'>" . $row["booking_id"] . "</div>
                                     <div class='cell'>" . $row2["p_title"] . "</div>
                                    <div class='cell'>" . $row["booking_date"] . "</div>
                                    <div class='cell'>" . $row["from_date"] . "</div>
                                    <div class='cell'>" . $row["to_date"] . "</div>
                                    <div class='cell'> Pending </div>
                                    <div class='cell'><button class='view'>Accept</button>
                                    <button class='view'>Reject</button></div>
                                </div>";
                             
                                
                        }
                    } else {
                        echo "<div class='row'><div class='cell' colspan='3'>No results found</div></div>";
                    }*/
                ?>
            </table>
        </main>
    </div>

</body>
</html>

