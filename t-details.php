<?php include 'technest-header.php'; ?>
<?php include 'tenant-header.php'; ?>
<?php
    $id=$_SESSION['loginid'];
    $conn=mysqli_connect('localhost','root','','hrs');
    $sql="select * from tenant where login_id = $id";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res))
    { 
      $row = mysqli_fetch_assoc($res);

      $_SESSION['tenantname'] = $row['tenant_name'];

      $tenantname = $row['tenant_name'];
      $tenantphn = $row['tenant_phn'];
      $tenantemail = $row['tenant_email'];
      $tenanthouse = trim($row['tenant_housename']);
      $tenantstreet = $row['tenant_street'];
      $tenantcity = $row['tenant_city'];
      $tenantdistrict = $row['tenant_district'];
      $tenantstate = $row['tenant_state'];
      $tenantbank = $row['tenant_bank'];
      $tenantaccno = $row['tenant_accno'];
      $tenantifsc = trim($row['tenant_ifsc']);
      $tenantbranch  = $row['tenant_branch'];
      $tenantaadhaar = $row['tenant_aadhaar'];
    }
?>
<div class="tenantdetails">
    
    <div class="tpcontainer">            
        <form id="registrationForm" name="ownerpersonal" action="tenantvalidation.php" method="post" >
            <div class = "personal">
                <h2>Personal Details</h2>
            
                <div class="owner-form-group">
                    <label for="name">Tenant Name:</label>
                    <input type="hidden" id="loginid" name="loginid" value="<?php echo $id ;?> " required>
                    <input type="text" id="name" name="name" value="<?php echo $tenantname ;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="name">Phone Number:</label>
                    <input type="tel" id="phnno" name="phnno" value="<?php echo $tenantphn;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $tenantemail;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="hname">House Name:</label>
                    <input type="text" id="hname" name="hname" value="<?php echo $tenanthouse;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" value="<?php echo $tenantstreet;?> "required>
                </div>
                <div class="owner-form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $tenantcity;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" value="<?php echo $tenantdistrict;?> "required>
                </div>
                <div class="owner-form-group">
                    <label for="state">State:</label>
                    <input type="text" id="state" name="state" value="<?php echo $tenantstate;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="aadhaar">Aadhaar Number:</label>
                    <input type="text" id="aadhaar" name="aadhaar" pattern="\d{12}" title="Aadhaar number must be exactly 12 digits" value="<?php echo $tenantaadhaar;?>" required>
                </div>
            </div>

            <div class = "bank">
                <h2>Bank Details</h2>
                <div class="owner-form-group">
                    <label for="Bank name">Bank Name:</label>
                    <input type="text" id="bname" name="bname" value="<?php echo $tenantbank;?> " required>
                </div>
                <div class="owner-form-group">
                    <label for="Account Number">Bank Account Number:</label>
                    <input type="text" id="accno" name="accno" pattern="\d{9,18}" title="Bank account number must be between 9 and 18 digits" value="<?php echo $tenantaccno;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="ifsc">IFSC Code:</label>
                    <input type="text" id="ifsc" name="ifsc" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" title="IFSC code must be 11 characters: first 4 letters, a '0', and 6 alphanumeric characters" value="<?php echo $tenantifsc;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="branch">Branch Name:</label>
                    <input type="text" id="branch" name="branch" value="<?php echo $tenantbranch;?> "required>
                </div>
               <!-- <div class="owner-form-group">
                    <label for="branch">UPI ID:</label>
                    <input type="text" id="upi" name="upi" value="<?php //echo $upi;?> "required>
                </div> -->
                <div class="owner-form-group register">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </div>
        </form>          
    </div>
</div>
    

    <h2 class="photohead">Profile Photo</h2>

    <?php
                $conn = mysqli_connect("localhost", "root", "", "hrs");
                $query = " select tenant_photo from tenant where login_id = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)) {
                    $data = mysqli_fetch_assoc($result);
                    $photo =  $data['tenant_photo'];
                } else {
                    $photo = "";
                }
    ?>
    
   
    <div class="upload-container" id="upload-container">
        
        <div class="image-preview-wrapper">

            <?php
            if(!isset($photo))
            {
                $photo = "";
            }?>
            <img id="preview" class="image-preview" src='./uploads/<?php echo $photo; ?>'  style="display: block;">
            
        </div>
        <!--<i class="pen-icon">✏️</i>-->
        <form action="testphoto.php" enctype="multipart/form-data" method="post" onsubmit="return validateForm(event)">
            <div class="upicon">
                <i class="pen-icon1" id = "pen-icon1"><i class="fa-solid fa-camera"></i></i>
                <input type="hidden" id="loginid" name="loginid" value="<?php echo $id ;?> ">
                <input type="file" id="file-input" name="profile_photo"  onchange="previewImages(event)">
            </div>
            <div class="upsubmit">
               <input class="sbt-btn" type="submit" name="submit" value="Upload">
            </div>

            <div id="error-message" style="color: red; display: none;">Please select a photo before uploading.</div>

        </form>

        <div id="display-image">
            
        </div>
       
    </div> <!--upload container-->
</div>
</div>  
<script>
    // Get the input file and preview image elements
    const fileInput = document.getElementById('file-input');
    const previewImage = document.getElementById('preview');
    const uploadContainer = document.getElementById('pen-icon1');

    // When the container is clicked, trigger the file input
    uploadContainer.addEventListener('click', function() {
        fileInput.click();
    });

    // Function to preview the image
    function previewImages(event) {
        const file = event.target.files[0];
          
        if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block'; // Show the image preview
        }

       reader.readAsDataURL(file);
        }
    }

    function validateForm(event) {
        const fileInput = document.getElementById('file-input');
        const errorMessage = document.getElementById('error-message');
        
        if (!fileInput.files.length) {
            errorMessage.style.display = 'block';

            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
            
            return false; // Prevent form submission
        }
        
        errorMessage.style.display = 'none';
        return true; // Allow form submission
    }
</script>  


</body>
</html>

