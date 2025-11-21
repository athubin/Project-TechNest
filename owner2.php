<?php include 'owner-header.php'; ?>
<?php include 'popup.php' ?>

    <div class="container">
        <h1>Manage Properties</h1>
        <div class="options">
            <!-- Add Property Card -->
            <div class="option-card">
                <h2>Add Property</h2>
                <p>List a new property for rent on Technest Rentals.</p>
                <a href="owner-post.php">Add Property</a>
            </div>
            
            <!-- Edit Property Card -->
            <div class="option-card">
                <h2>Edit Property</h2>
                <p>Update details or make changes to your existing properties.</p>
                <a href="owner-prop-edit.php">Edit Property</a>
            </div>
            
            <!-- View Properties Card -->
            <div class="option-card">
                <h2>View Properties</h2>
                <p>See all properties currently listed on Technest Rentals.</p>
                <a href="view-booking.php">View Properties</a>
            </div>

        </div>
    </div>

   <?php //include 'popup.php'; ?> 
</body>
</html>
