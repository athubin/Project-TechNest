<?php
    session_start();
    if(!isset($title)){
        $title = "TECHNEST RENTALS";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <script src="https://kit.fontawesome.com/5aca3b7b17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/property-css.css">
    <link rel="stylesheet" href="css/tenant.css">
    <link rel="stylesheet" href="css/contactstyle.css">
    <link rel="stylesheet" href="css/propdetails-css.css">
    <link rel="stylesheet" href="css/tenant-css.css">
    <!--<link rel="stylesheet" href="css/owner.css">-->
    <link rel="stylesheet" href="css/ownernew.css">
    <link rel="stylesheet" href="css/faq-style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
  
</head>
<body>

    <!-- Top Menu -->
    <nav class="top-menu">
        <!-- Logo -->
        <div class="circle-image">
            <a href="home-new.php"><img src="images/H3.png" alt="Logo" class="circle-image"></a>
        </div>
        
        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="home-new.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="home-listings.php">Properties</a>
            <?php 
                if(!isset($_SESSION['tenantid'])){
            ?>     
            <a href="inst.php">Post Property</a>
            <?php 
            } ?>
            <a href="contact.php">Contact Us</a>
            <a href="faq-new.php">FAQ</a>
            
        </div>
        <div class="welcome">
        <?php 
        if(isset($_SESSION['loginid'])){
            $lid = $_SESSION['loginid'];
          //  print_r($_SESSION);
            $conn = mysqli_connect("localhost","root","","hrs");
            $sql = "select username from login where login_id = '$lid'";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            echo "Welcome ".$row['username']; 

            echo '<a href="tenant-profile.php"><button class = "myprofile">My Profile</button></a>';
            
            echo '<a><button id="logoutBtn" class="logoutBtn">Logout</button></a>';

            
        }

        else{
           echo '<a href="login.php" class="login-btn">Login</a>';
        }
        echo "</div>";
        include 'logout.php';
        ?>
        
        <!-- Login Button -->
       <!-- <a href="login.php" class="login-btn">Login</a>-->
    </nav>
