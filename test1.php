<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Popup Modal</title>
  <style>
    /* Reset styling */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Basic body styling */
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f2f5;
    }

    /* Accept button styling */
    .accept-btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .accept-btn:hover {
      background-color: #45a049;
    }

    /* Modal overlay */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    /* Modal content */
    .modal-content {
      background: #ffffff;
      width: 90%;
      max-width: 400px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    /* Close button styling */
    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border: none;
      font-size: 20px;
      color: #333;
      cursor: pointer;
    }

    /* Modal heading */
    .modal-content h3 {
      margin-bottom: 15px;
      text-align: center;
      color: #4a4a4a;
    }

    /* Form fields */
    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #4a4a4a;
    }

    .form-group input[type="number"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
    }

    /* Save button styling */
    .save-btn {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .save-btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <!-- Accept button to trigger modal -->
  <button class="accept-btn" onclick="openModal()">Accept</button>

  <!-- Modal overlay -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal-content">
      <!-- Close button -->
      <button class="close-btn" onclick="closeModal()">×</button>
      
      <h3>Enter Details</h3>

      <!-- Form fields inside modal -->
      <form action="#" method="POST">
        <div class="form-group">
          <label for="advanceAmount">Advance Amount Received:</label>
          <input type="number" id="advanceAmount" name="advance_amount" required>
        </div>
        <div class="form-group">
          <label for="tenureMonths">Tenure in Months:</label>
          <input type="number" id="tenureMonths" name="tenure_months" required>
        </div>
        <button type="submit" class="save-btn">Save</button>
      </form>
    </div>
  </div>

  <!-- JavaScript for opening and closing modal -->
  <script>
    function openModal() {
      document.getElementById("modalOverlay").style.display = "flex";
    }

    function closeModal() {
      document.getElementById("modalOverlay").style.display = "none";
    }
  </script>

</body>
</html>
