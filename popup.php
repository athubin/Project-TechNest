
<!--<html>
    <head>
        <style>
            .popup {
    display: flex; /* Hidden by default */
    position: fixed; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index:999;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

.close-btn {
    cursor: pointer;
    float: right;
    font-size: 20px;
}
button {
    margin: 10px;
    padding: 10px 20px;
    font-size: initial; 
}
</style>
</head>


<body>-->
<?php
   function alert($msg,$ok,$cancel,$surl,$curl){
?>
<div id="logoutPopup1" class="popup">
  <div class="popup-content">
    <span class="close-btn close-btn1">&times;</span>
    <h2><?php echo $msg; ?></h2>
    <button id="confirmLogout1"><?php echo $ok; ?></button>
    <button id="cancelLogout1"><?php echo $cancel; ?></button>
  </div>
</div>


<script>
  //const logoutBtn1 = document.getElementById('logoutBtn1');
  const logoutPopup1 = document.getElementById('logoutPopup1');
  const closeBtn1 = document.querySelector('.close-btn1');
  const cancelLogout1 = document.getElementById('cancelLogout1');

          /*  logoutBtn1.onclick = function() {
                logoutPopup1.style.display = 'flex';
            }
*/
            closeBtn1.onclick = function() {
                logoutPopup1.style.display = 'none';
                window.location.href = "<?php echo $curl; ?>";
            }

            cancelLogout1.onclick = function() {
                logoutPopup1.style.display = 'none';
                window.location.href = "<?php echo $curl; ?>"; 
            }

            window.onclick = function(event) {
                if (event.target === logoutPopup1) {
                    logoutPopup1.style.display = 'none';
                }
            }

            //const redirectUrl1 = 'owner-profile.php'; // Replace with your target page

                //document.getElementById('confirmLogout1').onclick = function() {
                    document.getElementById('confirmLogout1').onclick = function() {
                    // Redirect to another page
                    window.location.href = "<?php echo $surl; ?>"; 
                }
        </script>
   <?php } ?>
