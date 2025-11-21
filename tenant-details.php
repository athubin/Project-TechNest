<?php include 'technest-header.php'; ?>
<?php include 'tenant-header.php'; ?>
    <div class="trcontainer">
        <header>
            <h2>Tenant Registration Form</h2>
        </header>
        <form action="/submit" method="POST">
             <!--Personal Details Section -->

             <h3>Personal Details</h3>
            <div class="section">
                
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>

                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" required> <br>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" required><br>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <!-- Bank Details Section -->
            <h3>Bank Details</h3>
            <div class="section">
                
                <label for="bankName">Bank Name</label>
                <input type="text" id="bankName" name="bankName" placeholder="Enter your bank name" required>

                <label for="accountNumber">Account Number</label>
                <input type="text" id="accountNumber" name="accountNumber" placeholder="Enter your account number" pattern="\d{10,18}" required>

                <label for="ifsc">IFSC Code</label>
                <input type="text" id="ifsc" name="ifsc" placeholder="Enter your IFSC code" required>

                <label for="branch">Branch Name</label>
                <input type="text" id="branch" name="branch" placeholder="Enter your branch name" required>
            </div>

            <!-- Submit Button -->
            <button type="submit">Register</button>
        </form>
        <footer>
            <p>Powered by <a href="#">Your Company</a></p>
        </footer>
    </div>
</body>
</html>
