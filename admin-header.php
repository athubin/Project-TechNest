<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/adminproperty.css">
    <link rel="stylesheet" href="css/addtype.css">
    <link rel="stylesheet" href="css/userstyle.css">
    <script src="https://kit.fontawesome.com/5aca3b7b17.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Dashboard - Home Rental System</title>
</head>
<body>
<div class = "profile">
    <button id="openModal"><i class="fa-solid fa-user"></i></button>

    <h2>Technest Rentals</h2>
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
    <div class="admincontainer">
   
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="admin-booked-properties.php">Booked properties</a></li>
                <div class="navbar">
                    <div class="dropdown">
                        <li><button class="dropbtn">Manage Properties</a>
                        <i class="fa fa-caret-down"></i>
                        </button></li>
                        <div class="dropdown-content">
                            <a href="admin-property.php">Approve Properties</a>
                            <a href="admin-property-view.php">View Properties</a>
                        </div>
                    </div>
                </div>
                <li><a href="property-category.php">Property Category</a></li>
                <div class="navbar">
                    <div class="dropdown">
                        <li><button class="dropbtn">Manage Users
                        <i class="fa fa-caret-down"></i>
                        </button></li>
                        <div class="dropdown-content">
                            <a href="admin-tenant.php">Tenants</a>
                            <a href="admin-owner.php">Owners</a>
                        </div>
                    </div>
                </div>
                <li><a href="enquiry.php">Enquiries</a></li>
                <!--<li><a href="#">Manage Users</a></li>-->
                <li><a href="report.php">Reports</a></li>
               <!-- <li><a href="#">Settings</a></li>-->
                <li><a><button id="logoutBtn" class="logoutBtn">Logout</button></a></li>
            </ul>
        </nav>
        
        <div id="logoutPopup" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <h2>Are you sure you want to logout?</h2>
                <button id="confirmLogout">Yes, Logout</button>
                <button id="cancelLogout">Cancel</button>
            </div>
        </div>

        <script>
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutPopup = document.getElementById('logoutPopup');
            const closeBtn = document.querySelector('.close-btn');
            const cancelLogout = document.getElementById('cancelLogout');

            logoutBtn.onclick = function() {
                logoutPopup.style.display = 'flex';
            }

            closeBtn.onclick = function() {
                logoutPopup.style.display = 'none';
            }

            cancelLogout.onclick = function() {
                logoutPopup.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target === logoutPopup) {
                    logoutPopup.style.display = 'none';
                }
            }

            const redirectUrl = 'signout.php'; // Replace with your target page

                document.getElementById('confirmLogout').onclick = function() {
                    // Redirect to another page
                    window.location.href = redirectUrl; 
                }
        </script>