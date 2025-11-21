<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Approve Properties</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .approve-btn, .deny-btn {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            color: white;
            border-radius: 5px;
        }
        .approve-btn {
            background-color: #4CAF50;
        }
        .deny-btn {
            background-color: #f44336;
        }
        .approve-btn:hover {
            background-color: #45a049;
        }
        .deny-btn:hover {
            background-color: #e53935;
        }

        /* Notification Styling */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.4s, transform 0.4s;
            z-index: 1000;
        }
        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }
        .notification.deny {
            background-color: #f44336;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Property Approval Dashboard</h2>
    <table>
        <thead>
            <tr>
                <th>Property ID</th>
                <th>Owner Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example property request entries -->
            <tr>
                <td>101</td>
                <td>John Doe</td>
                <td>New York, NY</td>
                <td class="action-buttons">
                    <button class="approve-btn" onclick="approveProperty(101)">Approve</button>
                    <button class="deny-btn" onclick="denyProperty(101)">Deny</button>
                </td>
            </tr>
            <tr>
                <td>102</td>
                <td>Jane Smith</td>
                <td>San Francisco, CA</td>
                <td class="action-buttons">
                    <button class="approve-btn" onclick="approveProperty(102)">Approve</button>
                    <button class="deny-btn" onclick="denyProperty(102)">Deny</button>
                </td>
            </tr>
            <!-- Additional property request rows as needed -->
        </tbody>
    </table>
</div>

<!-- Notification Box -->
<div id="notification" class="notification"></div>

<script>
    function showNotification(message, type = 'approve') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = 'notification show ' + (type === 'deny' ? 'deny' : '');
        
        // Show notification
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);  // Hide after 3 seconds
    }

    function approveProperty(propertyId) {
        showNotification(`Property ID ${propertyId} approved!`, 'approve');
        // Add AJAX request to approve property in the backend here
    }

    function denyProperty(propertyId) {
        showNotification(`Property ID ${propertyId} denied!`, 'deny');
        // Add AJAX request to deny property in the backend here
    }
</script>

</body>
</html>
