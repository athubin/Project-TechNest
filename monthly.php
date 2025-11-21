<?php include 'technest-header.php'; ?>
<?php include 'tenant-header.php'; ?>
<?php
if(isset($_GET['msg'])){ 
    $style = (substr($_GET['msg'],8) == 'successful') ? 'green' : 'red';
?>
    <div id="hide" style="color:<?php echo $style;?>"><?php echo $_GET['msg']; ?></div>
<?php } ?>
<div class="paymcontainer">
    <h1>What Would You Like to Do?</h1>
    <div class="payoptions">
        <a href="pay-history.php" class="payoption">View Payment History</a>
        <a href="payment-property.php" class="payoption">Pay Current Rent</a>
    </div>
</div>
<script>
    setTimeout(function(){
        document.getElementById("hide").style.display = "none"; 
    }, 3000);
</script>
</body> 
</html>