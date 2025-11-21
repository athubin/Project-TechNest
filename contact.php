<?php $title = "ContactUs | TECHNEST RENTALS"; ?>
<?php include "technest-header.php"; ?>

<div class = "bgimg">
  <img src = "images/c3.jpg">
    <div class = "contact-heading">
 <h1>Contact Us</h1>
    </div>

    <div class = "userform">

      <form action = "useradmin.php" method = "post">

        <label for="fname"></label>
        <input type="text" id="fname" name="firstname" placeholder="FIRST NAME">

        <label for="lname"></label>
        <input type="text" id="lname" name="lastname" placeholder="LAST NAME">

        <label for="email"></label>
        <input type="text" id="email" name="email" placeholder="Email">

        <label for="subject"></label>
        <textarea id="subject" name="subject" placeholder="MESSAGE" style="height:200px"></textarea>
        <br>
        <input type="reset" value="Reset">
        <input type="submit" name = "complaintsubmit" value="Submit">
     </form>
</div>
     </div>
</div>

<?php include "technest-footer.php"; ?>
