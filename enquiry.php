<?php include 'admin-header.php'; ?>

<?php

$conn = mysqli_connect('localhost','root','','hrs');
$sql = "select * from admin";
$res = mysqli_query($conn,$sql);
//$row = mysqli_fetch_assoc($res);

?>

<main class="main-content">
<section class="property-list">
                <h2>Enquiries</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td><?php echo $row['sl_no'];?></td>
                            <td><?php echo $row['first_name'];?></td>
                            <td><?php echo $row['last_name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['message'];?></td>
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
    </body>
</html>
