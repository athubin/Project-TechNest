<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Scheduled Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Scheduled Appointments</h1>
        <p>Tenant Name: John Doe</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Owner name</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2024-11-30</td>
                <td>10:00 AM</td>
                <td>Plumbing Maintenance</td>
                <td>Apartment 3A</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2024-12-02</td>
                <td>2:00 PM</td>
                <td>Lease Renewal Discussion</td>
                <td>Management Office</td>
            </tr>
            <tr>
                <td>3</td>
                <td>2024-12-10</td>
                <td>11:30 AM</td>
                <td>Routine Inspection</td>
                <td>Apartment 3A</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
