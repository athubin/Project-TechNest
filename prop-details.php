<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detailed View</title>
    <link rel="stylesheet" href="css/propdetails-css.css">
</head>

<body>-->
  <?php include 'technest-header.php'; ?>
    <?php 
      
      $pid = $_GET['propid'];
      $conn = mysqli_connect("localhost","root","","hrs");
      $sql = "select * from property where p_id = '$pid' ";
      $res = mysqli_query($conn,$sql);
    
      while($row = mysqli_fetch_assoc($res)){

      
    ?>
    
    <div class="propcontainer">
        <div class = "prophead">
            <h1><?php echo $row['p_title']; ?></h1>
            <p><?php echo $row['p_location']; ?></p>
      </div>

        <div class = "listing">

        <section class="property-details">
            <h2>Property Details</h2>
            <ul>
                <li><strong>Rent:</strong> ₹<?php echo $row['p_price']; ?></li>
               <!-- <li><strong>Security Deposit:</strong> ₹ 5,000</li>
                <li><strong>Size:</strong> 2,500 sq ft</li>-->
                <li><strong>BHK:</strong> <?php echo $row['p_subcat']; ?></li>
                <li><strong>Bathrooms:</strong><?php echo $row['p_bath']; ?></li>
                <!--<li><strong>Year Built:</strong> 2015</li>
                <li><strong>Lot Size:</strong> 0.25 acres</li>
                <li><strong>Floor:</strong> 2 Floors</li>-->
                <li><strong>Furnished Status:</strong><?php echo $row['p_category']; ?></li>
            </ul>
        </section>
<?php
/*$oid = $row["owner_id"];
 $sql2 = "select owner_ID,owner_name,owner_phn,owner_email from owner where owner_ID = '$oid' ";
 $res2 = mysqli_query($conn,$sql2);
 $row2 = mysqli_fetch_assoc($res2);*/
 ?>
        <div class = "owner">
          <h2>Owner details</h2>
          <?php 
            if(isset($_SESSION['tenantid'])){
              $oid = $row["owner_id"];
              $sql2 = "select owner_ID,owner_name,owner_phn,owner_email from owner where owner_ID = '$oid' ";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_fetch_assoc($res2);
            ?>
          <ul>
            <li><strong>Owner name: </strong><?php echo $row2['owner_name']; ?></li>
            <li><strong>Owner phone number: </strong> <?php echo $row2['owner_phn']; ?> </li>
            <li><strong>Owner email ID: </strong> <?php echo $row2['owner_email']; ?> </li>
          </ul>
          <?php } ?>
        </div>
</div>

        <div class="listcontainer">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img src="uploads/<?php echo $row['p_image1']; ?>" style="width:100%;">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="uploads/<?php echo $row['p_image2']; ?>" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="uploads/<?php echo $row['p_image3']; ?>" style="width:100%">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">4 / 6</div>
    <img src="uploads/<?php echo $row['p_image4']; ?>" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 6</div>
    <img src="uploads/<?php echo $row['p_image5']; ?>" style="width:100%">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">6 / 6</div>
    <img src="uploads/<?php echo $row['p_image6']; ?>" style="width:100%">
  </div>
    
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <div class="row">
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image1']; ?>" style="width:100%; height:100%" onclick="currentSlide(1)" >
    </div>
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image2']; ?>" style="width:100%" onclick="currentSlide(2)" >
    </div>
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image3']; ?>" style="width:100%" onclick="currentSlide(3)" >
    </div>
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image4']; ?>" style="width:100%" onclick="currentSlide(4)" >
    </div>
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image5']; ?>" style="width:100%" onclick="currentSlide(5)" >
    </div>    
    <div class="column">
      <img class="demo cursor" src="uploads/<?php echo $row['p_image6']; ?>" style="width:100%" onclick="currentSlide(6)" >
    </div>
  </div>
</div>

<section class="description">
            <h2>Description</h2>
            <p><?php echo $row['p_desc']; ?></p>
</section>
<?php
      }
      //print_r($_SESSION); exit;
      ?>
      
<div class="schedule">
    <button class="contact-button"><a href="appointment.php?propid=<?php echo $pid; ?> ">Schedule Appointment</a></button>
</div>

        <script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  //captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</div>
<?php include 'technest-footer.php' ?>
    
</body>
</html>