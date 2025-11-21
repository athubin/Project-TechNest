<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Current Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .property-details {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffff;
            margin-bottom: 20px;
        }
        .property-details h2 {
            margin-top: 0;
            color: #007bff;
        }
        .property-details p {
            margin: 5px 0;
            color: #333;
        }
        .no-booking {
            text-align: center;
            color: #555;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
        .actions button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        .renew-button {
            background-color: #28a745;
        }
        .end-button {
            background-color: #dc3545;
        }
        .renew-button:hover {
            background-color: #218838;
        }
        .end-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Current Property Booking</h1>
            <p>Tenant Name: John Doe</p>
        </div>

        <!-- Current Booking Details -->
        <div id="currentBooking" class="property-details">
            <h2>Property Name: Ocean View Apartment</h2>
            <p><strong>Address:</strong> 123 Seaside Blvd, Miami, FL</p>
            <p><strong>Booking Start Date:</strong> 2024-10-01</p>
            <p><strong>Booking End Date:</strong> 2024-12-31</p>
            <p><strong>Monthly Rent:</strong> $1,500</p>
        </div>

        <!-- Action Buttons -->
        <div id="actions" class="actions">
            <button class="renew-button" onclick="renewTenure()">Renew Tenure</button>
            <button class="end-button" onclick="endTenure()">End Tenure</button>
        </div>

        <!-- Placeholder for no booking -->
        <div id="noBookingMessage" class="no-booking" style="display: none;">
            No current booking found for this tenant.
        </div>
    </div>

    <script>
        // JavaScript to handle no current booking scenario
        const currentBooking = document.getElementById('currentBooking');
        const noBookingMessage = document.getElementById('noBookingMessage');
        const actions = document.getElementById('actions');

        // Example condition: If current booking doesn't exist, hide details and options
        const hasCurrentBooking = true; // Change to false to simulate no booking
        if (!hasCurrentBooking) {
            currentBooking.style.display = 'none';
            actions.style.display = 'none';
            noBookingMessage.style.display = 'block';
        }

        // Placeholder functions for button actions
        function renewTenure() {
            alert("Renew Tenure option selected. Implement renewal functionality here.");
            // You can add logic here to renew the booking
        }

        function endTenure() {
            alert("End Tenure option selected. Implement termination functionality here.");
            // You can add logic here to end the booking
        }
    </script>
</body>
</html>
