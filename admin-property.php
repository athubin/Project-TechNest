<?php session_start() ?>
<?php include 'admin-header.php'; ?>

<div class = "adminprop">
    <div class="propcontainer">
        <h2>Property Approval Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Property Name</th>
                    <th>Rent Amount</th>
                    <th>Location</th>
                    <th>Owner Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

<?php
    
    $conn = mysqli_connect('localhost','root','','hrs');
    
    $sql = "select p_id,p_title,p_price,p_location,p_status,owner_name from property p, owner o where p.owner_ID = o.owner_ID";
     
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($res)){
        $pstatus = "Not Approved";
        if($row['p_status'] == 1){
            $pstatus = "Approved";
        };
?>  
           
                <!-- Example property request entries -->
                <tr>
                    <td><?php echo $row['p_id']; ?></td>
                    <td><?php echo $row['p_title']; ?></td>
                    <td><?php echo $row['p_price']; ?></td>
                    <td><?php echo $row['p_location']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <!--<td><?php //echo $row['p_status']; ?></td>-->
                    <td><?php echo $pstatus; ?></td>
                    <td class="action-buttons">
                        <a href="prop-approve.php?propid=<?php echo $row['p_id']; ?>"><button class="approve-btn">Approve</button></a>
                        <a href="prop-deny.php?propid=<?php echo $row['p_id']; ?>"><button class="deny-btn">Deny</button></a>
                    </td>
                </tr>

                <?php } ?>
                <!-- Additional property request rows as needed -->
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
