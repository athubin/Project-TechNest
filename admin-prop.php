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
        .status {
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }
        .approved {
            background-color: #4CAF50;
        }
        .rejected {
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
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example property request entries -->
            <tr>
                <td>101</td>
                <td>John Doe</td>
                <td>New York, NY</td>
                <td class="status" id="status-101">Pending</td>
                <td class="action-buttons">
                    <button class="approve-btn" onclick="approveProperty(101)">Approve</button>
                    <button class="deny-btn" onclick="denyProperty(101)">Deny</button>
                </td>
            </tr>
            <tr>
                <td>102</td>
                <td>Jane Smith</td>
                <td>San Francisco, CA</td>
                <td class="status" id="status-102">Pending</td>
                <td class="action-buttons">
                <a href=""><button class="approve-btn" onclick="approveProperty(102)">Approve</button></a>
                    <button class="deny-btn" onclick="denyProperty(102)"><a href="">Deny</a></button>
                </td>
            </tr>
            <!-- Additional property request rows as needed -->
        </tbody>
    </table>
</div>

<script>
    function approveProperty(propertyId) {
        // Update the status text and style for the approved property
        const statusCell = document.getElementById(`status-${propertyId}`);
        statusCell.textContent = 'Approved';
        statusCell.className = 'status approved';
    }

    function denyProperty(propertyId) {
        // Update the status text and style for the denied property
        const statusCell = document.getElementById(`status-${propertyId}`);
        statusCell.textContent = 'Rejected';
        statusCell.className = 'status rejected';
    }
</script>

</body>
</html>
