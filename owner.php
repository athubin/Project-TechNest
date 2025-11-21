<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technest Rentals - Owner Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic Reset and Font Import */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #3a4d63;
            color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 40px;
            color: #ffab00;
        }

        .sidebar ul {
            list-style-type: none;
            width: 100%;
        }

        .sidebar ul li {
            margin: 20px 0;
            width: 100%;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ffffff;
            padding: 10px;
            display: block;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #ffab00;
            color: #3a4d63;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #333333;
        }

        .header button {
            background-color: #ffab00;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .header button:hover {
            background-color: #333333;
        }

        /* Dashboard Sections */
        .dashboard-sections {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-card {
            background-color: #ffffff;
            width: calc(50% - 20px);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #3a4d63;
        }

        .dashboard-card p {
            color: #666666;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .dashboard-card .btn {
            text-align: center;
            background-color: #ffab00;
            color: #ffffff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .dashboard-card .btn:hover {
            background-color: #333333;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Technest Rentals</h2>
        <ul>
            <li><a href="#properties">Properties</a></li>
            <li><a href="#bookings">Bookings</a></li>
            <li><a href="#messages">Messages</a></li>
            <li><a href="#settings">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Owner Dashboard</h1>
            <button>Log Out</button>
        </div>

        <!-- Dashboard Sections -->
        <div class="dashboard-sections">
            <!-- Properties Section -->
            <div class="dashboard-card" id="properties">
                <h3>Properties</h3>
                <p>Manage your properties, add new listings, and view property details.</p>
                <a href="#" class="btn">Manage Properties</a>
            </div>

            <!-- Bookings Section -->
            <div class="dashboard-card" id="bookings">
                <h3>Bookings</h3>
                <p>View current bookings, approve requests, and see booking history.</p>
                <a href="#" class="btn">View Bookings</a>
            </div>

            <!-- Messages Section -->
            <div class="dashboard-card" id="messages">
                <h3>Messages</h3>
                <p>Check and respond to messages from tenants and potential renters.</p>
                <a href="#" class="btn">Go to Messages</a>
            </div>

            <!-- Settings Section -->
            <div class="dashboard-card" id="settings">
                <h3>Settings</h3>
                <p>Update account information, preferences, and security settings.</p>
                <a href="#" class="btn">Update Settings</a>
            </div>
        </div>
    </div>

</body>
</html>
