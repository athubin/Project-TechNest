<?php
// Database connection parameters
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

// SQL query to fetch data
$sql = "SELECT * FROM category";
$result = mysqli_query($conn,$sql);
?>

<!--<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Category view</title>
    <style>
        .t-container {
            width: 60%;
            margin: 20px auto;
            /*border: 1px solid #ddd;
            border-radius: 5px;*/
            overflow: hidden;
        }
        .header {
            background-color: #f2f2f2;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            border-bottom: solid;
        }
        .row {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .row:last-child {
            border-bottom: none;
        }
        .cell {
            flex: 1;
        }

        .back{
            float:left;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/adminprofile.css">
    <link rel="stylesheet" href="css/addtype.css">
    <title>Admin Dashboard - Home Rental System</title>
</head>
<body>
<div class = "profile">
    <button id="openModal"><img src="images/admin.jpg" width=25px height=25px></button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeModal">&times;</span>
            <h2>Admin Profile</h2>
            <p><strong>Name:</strong> Admin User</p>
            <p><strong>Email:</strong> admin@example.com</p>
            <p><strong>Role:</strong> Administrator</p>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');

        openModalButton.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModalButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</div>
    <div class="container">
   
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Manage Properties</a></li>
                <li><a href="propertycat.php">Property Category</a></li>
                <li><a href="#">Manage Users</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>-->

        <?php include 'admin-header.php'; ?>
    
    <div class='t-container'>

    <h1>Category Details</h1>

        <div class='header'>
            <div class='cell'>Category ID</div>
            <div class='cell'>Category Name</div>
            <div class='cell'>Category Status</div>
        </div>
    

<?php
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='row'>
                <div class='cell'>" . $row["category_ID"] . "</div>
                <div class='cell'>" . $row["category_name"] . "</div>
                <div class='cell'>" . $row["category_status"] . "</div>
              </div>";
    }
} else {
    echo "<div class='row'><div class='cell' colspan='3'>No results found</div></div>";
}
?>

<a href="property-category.php"><button class="back">BACK</button>
</div>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
