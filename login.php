<?php include "technest-header.php"; ?>

<div class="container">
<div class = "hero">
   <div class = "form-box">
       <div class = "button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="login()">LOGIN</button>
          <button type="button" class="toggle-btn" onclick="register()">REGISTER</button>
       </div>      
     
       <form id="login" class = "input-group" action="login-valid.php" method="post">
           <input type="text" class="input-field" placeholder="User ID" name="user" required>
           <input type="password" class="input-field" placeholder="Password" name="pass" required>
           <div class = "radio-login">Login as</div>
           <input type="radio" class="radio-btn" name="type" value="Tenant">Tenant
           <input type="radio" class="radio-btn" name="type" value="Owner">Owner
           <input type="radio" class="radio-btn" name="type" value="Admin">Admin
           <button type="submit" class="submit-btn" name="logtype" value="login">LOGIN</button>
       </form>

       <?php
         $msg = (isset($_GET['msg']) ? $_GET['msg'] : "");
         //
         $dstyle = (substr($msg,0,13) == "Registered..!") ? " style='color:green;'" : "";
            echo '<div class = "errmsg" id="errmsg"' . $dstyle . '>'. $msg . '</div>';
            //echo '<div class = "errmsg" id="errmsg">' . $msg . '</div>';
       ?>

       <form id="register" class = "input-group" action="login-valid.php" method="post">
           <input type="text" class="input-field" placeholder="User ID" name="user" required>
           <input type="email" class="input-field" placeholder="Email ID" name="email" required>
           <input type="password" class="input-field" placeholder="Password" name="pass" required>
           <div class = "radio-login">Register as</div>
           <input type="radio" class="radio-btn" name="type" value="Tenant">Tenant
           <input type="radio" class="radio-btn" name="type" value="Owner">Owner
           <button type="submit" class="submit-btn" name="logtype" value="register">REGISTER</button>
       </form>

   
   </div>
</div>
</div>

<?php include "technest-footer.php"; ?>

<script>

   setTimeout(function(){
      document.getElementById('errmsg').style.display="none";
   },8000);

   var x = document.getElementById("login");
   var y = document.getElementById("register");
   var z = document.getElementById("btn");

   function register(){
      x.style.left = "-400px";
      y.style.left = "15px";
      z.style.left = "190px";
   }

   function login(){
      x.style.left = "10px";
      y.style.left = "400px";
      z.style.left = "0px";
   }
</script>
