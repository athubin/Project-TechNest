<style>
    .mySlides {
    display: none;
    opacity: 0;
    transition: opacity 2s ease-in-out;
}

.mySlides.fade {
    opacity: 1; /* Show the slide with a fade effect */
}
</style>
	<?php $title = "Home | TECHNEST RENTALS" ; ?>
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

  <form class="search" action="home-listings.php" method="get">
    <input type="text" placeholder="Search for a location" name="location">
    <input type="submit" name="search" value="SEARCH">
  </form>
</div>

<div class = "newadd">
<h1>NEWLY ADDED</h1>
</div>
<section class="property-listings">

<?php
  $conn = mysqli_connect("localhost","root","","hrs");
  $sql = "select p_id, p_title,p_location,p_price,p_image1 from property order by p_id desc limit 4";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
  ?>
<div class="property-card">
    <img src="uploads/<?php echo $row['p_image1']; ?>" alt="Property 1"> 
    <h2><?php echo $row['p_title']; ?></h2>
    <p>Location: <?php echo $row['p_location']; ?></p>
    <p>Price: ₹<?php echo $row['p_price']; ?></p>
    <a href="prop-details.php?propid=<?php echo $row['p_id']; ?>" class="button">View Details</a>
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

var currentIndex = 1;
      
//Show current image
showSlides(currentIndex);

setInterval(()=>{
	showSlides(currentIndex += 1);
},3000);

//Function to move Next
function plusSlides(n) {
	showSlides(currentIndex += n);
}

//Function to move back
function currentSlide(n) {
	showSlides(currentIndex = n);
}


//Initiate moving of slides
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    
    if (n > slides.length) { currentIndex = 1; }
    if (n < 1) { currentIndex = slides.length; }
    
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("fade");
        slides[i].style.display = "none";
    }
    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[currentIndex - 1].style.display = "block";
    slides[currentIndex - 1].classList.add("fade");
    dots[currentIndex - 1].className += " active";
}



</script>

</body>
</html>