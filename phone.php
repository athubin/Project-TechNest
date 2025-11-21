<div id="actions" class="actions">
    <button class="renew-button">Renew Tenure</button>
    <button class="end-button" onclick="showPopup()">End Tenure</button>
</div>

<!-- Modal for Date Picker -->
<div id="date-picker-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <h3>Select End Date</h3>
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" name="end_date" min="<?php echo $pstartdate; ?>">
        <button class="submit-button" onclick="submitDate()">Submit</button>
    </div>
</div>

<style>
    /* Modal styles */
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.5); 
    }
    .modal-content {
        background-color: #fff;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 30%; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
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
    .submit-button {
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .submit-button:hover {
        background-color: #45a049;
    }
</style>

<script>
    // Function to display the modal
    function showPopup() {
        document.getElementById("date-picker-modal").style.display = "block";
    }

    // Function to hide the modal
    function closePopup() {
        document.getElementById("date-picker-modal").style.display = "none";
    }

    // Function to handle date submission
    function submitDate() {
        const selectedDate = document.getElementById("end-date").value;
        if (selectedDate) {
            alert(`Selected date: ${selectedDate}`);
            closePopup(); // Close the modal after submission
        } else {
            alert("Please select a date.");
        }
    }

    // Optional: Close modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById("date-picker-modal");
        if (event.target == modal) {
            closePopup();
        }
    };
</script>
