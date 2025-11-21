<!DOCTYPE html>
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

    <style>
        /* Sidebar Styling */
        .sidebar {
            background-color: #2c3e50;
            width: 250px;
            padding: 20px;
            position: fixed;
            height: 100%;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        .sidebar h2 {
            color: #ecf0f1;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin: 15px 0;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #2980b9;
        }

        /* Dropdown Styling */
        .dropdown {
            position: relative;
        }

        .dropbtn {
            background-color: #34495e;
            color: white;
            font-size: 18px;
            padding: 10px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dropbtn:hover {
            background-color: #2980b9;
        }

        /* Dropdown content styling */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #34495e;
            min-width: 200px;
            z-index: 1;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        /* Dropdown links */
        .dropdown-content a {
            padding: 12px 16px;
            color: white;
            text-decoration: none;
            display: block;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #2980b9;
        }

        /* Display dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
        }

        /* Logout Button */
        .logoutBtn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .logoutBtn:hover {
            background-color: #c0392b;
        }

        /* Modal for Profile */
        .profile {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        #modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Popup for logout confirmation */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .popup button {
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="profile">
        <button id="openModal"><i class="fa-solid fa-user"></i></button>
        <h2>Technest Rentals</h2>

        <!-- Profile Modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-button" id="closeModal">&times;</span>
                <h2>Admin Profile</h2>
                <p><strong>Name:</strong> Admin User</p>
                <p><strong>Email:</strong> admin@example.com</p>
                <p><strong>Role:</strong> Administrator</p>
            </div>
        </div>

        <!-- Sidebar and Admin Dashboard -->
        <div class="admincontainer">
            <nav class="sidebar">
                <h2>Admin Dashboard</h2>
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="admin-property.php">Manage Properties</a></li>
                    <li><a href="property-category.php">Property Category</a></li>

                    <!-- Dropdown Menu -->
                    <li class="dropdown">
                        <button class="dropbtn">Manage Users
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="admin-tenant.php">Tenants</a>
                            <a href="admin-owner.php">Owners</a>
                        </div>
                    </li>

                    <li><a href="report.php">Reports</a></li>
                    <li><a><button id="logoutBtn" class="logoutBtn">Logout</button></a></li>
                </ul>
            </nav>

            <!-- Logout Confirmation Popup -->
            <div id="logoutPopup" class="popup">
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <h2>Are you sure you want to logout?</h2>
                    <button id="confirmLogout">Yes, Logout</button>
                    <button id="cancelLogout">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal for Profile
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

        // Logout Popup
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
</body>
</html>
