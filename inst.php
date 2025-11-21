<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TECHNEST RENTALS</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Welcome and Instructions Section -->
     <?php include 'technest-header.php'; ?>
    <div class="instruction-container">
        <h1>Welcome to the Technest Rentals</h1>
        <p>To start booking or managing your rentals, please log in to your account.</p>
    </div>
    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box">
            <h2>Login to Your Account</h2>
            <!-- Step Instructions -->
            <div class="steps">
                <ol>
                    <li>Enter your registered email address.</li>
                    <li>Input your password.</li>
                    <li>Click 'Login' to access your account.</li>
                </ol>
            </div>
            <!-- Login Form -->
               <button type="submit" class="btn"><a href = "login.php">Login</a></button>
        </div>
    </div>

    <style>
        /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
/* Body styling */
body {
   /* font-family: 'Arial', sans-serif;*/
    background: linear-gradient(to right, #ff7e5f, #feb47b); /* Gradient background */
    color: #fff;
   /* height: 100vh;
    display: flex;*/
    justify-content: center;
    align-items: center;
    text-align: center;
}
/* Instruction Section */
.instruction-container {
    position: absolute;
    top: 20%;
    width: 100%;
}

.instruction-container h1 {
    font-size: 2.5rem;
    color: #fff;
    font-weight: bold;
    margin-bottom: 10px;
}

.instruction-container p {
    font-size: 1.2rem;
    color: #ffffff;
    margin-bottom: 30px;
}

/* Login container */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
/* Login box */
.login-box {
    background: rgba(0, 0, 0, 0.7);
    padding: 40px;
    border-radius: 12px;
    width: 320px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    margin-top: 10%;
    margin-bottom: 25px;
}
/* Step Instructions */

.steps ol {
    text-align: left;
    font-size: 1rem;
    color: #ffd700; /* Golden color for instructions */
    margin-bottom: 20px;
}

.steps li {
    margin-bottom: 10px;
}

/* Heading Text */
h2 {
    font-size: 1.8rem;
    color: #fff;
    margin-bottom: 20px;
}

/* Form input fields */
.textbox {
    margin-bottom: 15px;
}

.textbox input {
    width: 100%;
    padding: 14px;
    margin: 8px 0;
    border: 1px solid #fff;
    border-radius: 5px;
    font-size: 16px;
    background-color: #f1f1f1;
    color: #333;
    outline: none;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

.textbox input:focus {
    border-color: #ff7e5f;
    background-color: #fff;
}

/* Submit button */
.btn {
    width: 100%;
    padding: 14px;
    background: #ff7e5f; /* Warm coral color */
    color: #fff;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background: #feb47b; /* Light coral for hover effect */
}

/* Forgot password link */

.forgot-password {
    margin-top: 15px;
    font-size: 14px;
}

.forgot-password a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.forgot-password a:hover {
    color: #feb47b; /* Hover effect */
}

/* Sign-up link */
.signup-link {
    margin-top: 20px;
    font-size: 14px;
}

.signup-link a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.signup-link a:hover {
    color: #feb47b; /* Hover effect */
}
</style>

<?php include 'technest-footer.php'; ?>
</body>
</html>
