<?php $title = "FAQ | TECHNEST RENTALS" ?>
<?php include "technest-header.php"; ?>
<div class = "about-bg">
    <img src = "images/faq.jpg">  
    <div class = "about-heading">
        <h1>FAQ</h1>
    </div>
</div>

<div class="faq-container">
<h2>Frequently Asked Questions</h2>

<button class="accordion">Does this site charges any broker-fee?</button>
<div class="panel">
  <p>Our site does not charge any broker fee.</p>
</div>

<button class="accordion">Whom to contact in case of any complaints regarding the property?</button>
<div class="panel">
  <p>You can directly contact the property owner or send a feedback through the site which will be immediately addressed.</p>
</div>

<button class="accordion">How to do the payments?</button>
<div class="panel">
  <p>The site provides 3 payment methods, from which any of the method can be chosen  for all the transactions. The payment methods are Pay-in-person, UPI and bank transfer respectively.</p>
</div>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

<?php include "technest-footer.php"; ?>

