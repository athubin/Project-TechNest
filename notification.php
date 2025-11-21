<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Notification</title>
    <style>
        /* Notification Container */
.notification-container {
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

/* Notification Box */
.notification-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
    width: 300px;
    max-width: 90%;
}

.notification-box h2 {
    margin: 0 0 10px 0;
    font-size: 20px;
    color: #333;
}

.notification-box p {
    margin: 15px 0;
    font-size: 16px;
    color: #555;
}

/* Close Button */
.close-btn {
    font-size: 16px;
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    background-color: #28a745;
    color: white;
    transition: background-color 0.3s;
}

.close-btn:hover {
    background-color: #218838;
}

/* Trigger Button */
.trigger-btn {
    font-size: 16px;
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s;
}

.trigger-btn:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
    <div class="notification-container" id="notification">
        <div class="notification-box">
            <h2>Appointment Confirmed</h2>
            <p>Your appointment request has been successfully confirmed by the owner!</p>
            <button class="close-btn" onclick="closeNotification()">Close</button>
        </div>
    </div>

    <button class="trigger-btn" onclick="showNotification()">Send Notification</button>

    <script>
        function showNotification() {
            document.getElementById('notification').style.display = 'flex';
        }

        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
    </script>
</body>
</html>
