<?php include "technest-header.php"; ?>

    <header>
        <h1>Properties for Rent</h1>
    </header>

    <?php
        $conn = mysqli_connect("localhost","root","","hrs");
        $sql = "select p_id,p_title, p_location, p_price,p_image1 from property where p_status = 1";
        $res = mysqli_query($conn,$sql);
        ?>
        <main>
            <?php
            if(mysqli_num_rows($res) > 0)
            { 
                while($row = mysqli_fetch_assoc($res)){
                ?>
                
                    <div class="property">
                        <img src="uploads/<?php echo $row['p_image1'];?>" alt="Property 1">
                        <h2><?php echo $row['p_title']; ?></h2>
                        <p><?php echo $row['p_location']; ?></p>
                        <p><?php echo $row['p_price']; ?></p>
                        <button class="view"><a href="prop-details.php?propid=<?php echo $row['p_id']; ?>">View</a></button>
                    </div> 
                <?php
                }
            }else{
                echo '<div class="property">';
                echo '<h2> No properties added</h2>';
                echo '</div>';
            }
                ?>
        </main>

    <?php include 'technest-footer.php'; ?>

</html>

   