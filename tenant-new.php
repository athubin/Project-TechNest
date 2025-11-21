<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Menu Design</title>
    <script src="https://kit.fontawesome.com/5aca3b7b17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/home.css">
    <style>
        /* Tenant top menu styling */
        .tenant-menu {
            display: flex;
            justify-content: flex-end;
            background-color: #4CAF50;
            color: white;
            padding: 0.8em;
        }
        .tenant-menu a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 0.9em;
        }
        .tenant-menu a:hover {
            background-color: #3e8e41;
        }
    </style>
  
</head>
<body>
<nav class="tenant-menu">
        <div class = "sitename">Technest Rentals</div>
        <a href="#profile">Profile Details</a>
        <a href="#bookings">Bookings</a>
        <a href="#payments">Payments</a>
        <a href="#messages">Messages</a>
        <a href="#logout">Logout</a>
    </nav>
    <!-- Top Menu -->
  <!--  <nav class="top-menu">
        <!-- Logo -->
       <!--<div class="logo">
            <a href="#home"><img src="images/logo-new.jpg" alt="Logo"></a>
        </div>
        
        <!-- Navigation Links -->
     <!--   <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#properties">Properties</a>
            <a href="#post-property">Post Property</a>
            <a href="#contact">Contact Us</a>
            <a href="#faq">FAQ</a>
        </div>-->
        
        <!-- Login Button -->
       <!-- <a href="#login" class="login-btn">Login</a>
    </nav>-->

    <?php include 'technest-header.php' ; ?>
    <div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="images/bgimg1.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="images/h3.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="images/fc.jpg" style="width:100%">
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>

  <div class = "heading">
    TECHNEST RENTALS
  </div>

  <div class = "tagline">
    A hub for online house bookings & rentals
  </div>

  <form class="search" action=" ">
    <input type="text" placeholder="Search for a location" name="search">
    <input type="submit" name="submit" value="SEARCH">
  </form>
</div>

<div class = "newadd">
<h1>NEWLY ADDED</h1>
</div>
<section class="property-listings">

<?php
  $conn = mysqli_connect("localhost","root","","hrs");
  $sql = "select p_title,p_location,p_price,p_image1 from property order by p_id desc limit 4";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
  ?>
<div class="property-card">
    <img src="uploads/<?php echo $row['p_image1']; ?>" alt="Property 1"> 
    <h2><?php echo $row['p_title']; ?></h2>
    <p>Location: <?php echo $row['p_location']; ?></p>
    <p>Price: $<?php echo $row['p_price']; ?></p>
    <a href="" class="button">View Details</a>
</div>
<?php
  }
  ?>
</section>

 <!-- Footer -->
 <div class="footer-bottom">
        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        
        <!-- Copyright Message -->
        <p>&copy; 2024 Home Rental System. All Rights Reserved.</p>
    </div>



<script>

let slideIndex = 0;
showSlides(slideIndex);
setTimeout(showSlides(1), 2000); 


  // Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

 // let slideIndex = 0;
//showSlides();

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

 // slideIndex++;

 // if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";

  dots[slideIndex-1].className+=" Active";

 // slides[slideIndex-1].style.display = "block";
//console.log(slideIndex);
  //setTimeout(showSlides(slideIndex), 5000); // Change image every 2 seconds
}







</script>

</body>
</html>
