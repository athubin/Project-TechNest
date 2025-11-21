<?php include 'owner-header.php';?>

<?php
    $id=$_SESSION['loginid'];
    $conn=mysqli_connect('localhost','root','','hrs');
    $sql="select * from owner where login_id = $id";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res))
    {
      $row = mysqli_fetch_assoc($res);
      $ownername = trim($row['owner_name']);
      $ownerphn = trim($row['owner_phn']);
      $owneremail = trim($row['owner_email']);
      $ownerhouse = trim($row['owner_housename']);
      $ownerstreet = trim($row['owner_street']);
      $ownercity = trim($row['owner_city']);
      $ownerdistrict = trim($row['owner_district']);
      $ownerstate = trim($row['owner_state']);
      $ownerbank = trim($row['owner_bank']);
      $owneraccno = trim($row['owner_accno']);
      $ownerifsc = trim($row['owner_ifsc']);
      $ownerbranch  = trim($row['owner_branch']);
      $owneraadhaar = trim($row['owner_aadhaar']);
      $upi = $row['owner_upi'];
    }

    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }

    $_SESSION['oname'] = $ownername;
   /* else{
      $ownername = "";
      $ownerphn = "";
      $owneremail = "";
      $ownerhouse = "";
      $ownerstreet ="";
      $ownercity ="";
      $ownerdistrict = "";
      $ownerstate ="";
      $ownerbank = "";
      $owneraccno = "";
      $ownerifsc ="";
      $ownerbranch  ="";
    }*/
?>
<div class="details">

    <div class="opcontainer">            

        <div class = "personal">
            <h2>Personal Details</h2>
            <form id="registrationForm" name="ownerpersonal" action="ownervalidation.php" method="post" >
            <div class="owner-form-group">
                <label for="name">Owner Name:</label>
                <input type="hidden" id="loginid" name="loginid" value="<?php echo $id;?>" required>
                <input type="text" id="name" name="name" value="<?php echo $ownername;?>" required>
            </div>

            <!--<div class="owner-form-group">
                <label for="phnno">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $ownerphn;?>" required>
                <span id="phone-error" style="color: red; display: none;">Please enter a 10-digit number.</span>
            </div>-->

            <div class="owner-form-group">
                <label for="phnno">Phone Number:</label>
                <input type="tel" id="phone" name="phone" pattern="\d{10}" title="Phone number must be exactly 10 digits" value="<?php echo $ownerphn;?>" required>
            </div>


                <div class="owner-form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $owneremail;?> " required>
                </div>

                <div class="owner-form-group">
                    <label for="hname">House Name:</label>
                    <input type="text" id="hname" name="hname" value="<?php echo $ownerhouse;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" value="<?php echo $ownerstreet;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $ownercity;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" value="<?php echo $ownerdistrict;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="state">State:</label>
                    <input type="text" id="state" name="state" value="<?php echo $ownerstate;?>" required>
                </div>
                <div class="owner-form-group">
                    <label for="aadhaar">Aadhaar Number:</label>
                    <input type="text" id="aadhaar" name="aadhaar" pattern="\d{12}" title="Aadhaar number must be exactly 12 digits" value="<?php echo $owneraadhaar;?>" required>
                </div>
        </div>

        <div class = "bank">
            <h2>Bank Details</h2>
            <div class="owner-form-group">
                <label for="Bank name">Bank Name:</label>
                <input type="text" id="bname" name="bname" value="<?php echo $ownerbank;?>" required>
            </div>
            
            <div class="owner-form-group">
                <label for="Account Number">Bank Account Number:</label>
                <input type="text" id="accno" name="accno" pattern="\d{9,18}" title="Bank account number must be between 9 and 18 digits" value="<?php echo $owneraccno;?>" required>
            </div>

            <div class="owner-form-group">
                <label for="ifsc">IFSC Code:</label>
                <input type="text" id="ifsc" name="ifsc" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" title="IFSC code must be 11 characters: first 4 letters, a '0', and 6 alphanumeric characters" value="<?php echo $ownerifsc;?>" required>
            </div>

            <div class="owner-form-group">
                <label for="branch">Branch Name:</label>
                <input type="text" id="branch" name="branch" value="<?php echo $ownerbranch;?>" required>
            </div>

            <div class="owner-form-group">
                <label for="upi">UPI ID:</label>
                <input 
                    type="text" 
                    id="upi" 
                    name="upi" 
                    pattern="^[a-zA-Z0-9.\-_]{2,256}@[a-zA-Z]{2,64}" 
                    title="Please provide a valid UPI ID in the format username@bankname (e.g., user@bank)" 
                    value="<?php echo $upi;?>" 
                    required>
            </div>




            <div class="owner-form-group register">
                <button type="submit" name="submit">Submit</button>
            </div>

        </div>
    </form>
<?php
/* if($msg != ""){ ?>
<div class="msg" id="msg">
<?php echo $msg; ?>
</div>
<?php } */?>


</div>
</div>
    

    <h2 class="photohead">Profile Photo</h2>

    <?php
                $conn = mysqli_connect("localhost", "root", "", "hrs");
                $query = " select owner_photo from owner where login_id = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)) {
                    $data = mysqli_fetch_assoc($result);
                    $photo =  $data['owner_photo'];
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
                <i class="pen-icon1" id ="pen-icon"><i class="fa-solid fa-camera"></i></i>
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


<!--</div>  -->
<script>

    /* validating phone no
    document.getElementById('phone').addEventListener('input', function () {
        const phoneInput = this.value;
        const phoneError = document.getElementById('phone-error');

        // Check if the phone number is valid
        const phoneRegex = /^\d{10}$/; // Exactly 10 digits
        if (phoneRegex.test(phoneInput)) {
            phoneError.style.display = 'none';
            this.setCustomValidity(''); // Clear custom validity message
        } else {
            phoneError.style.display = 'block';
            this.setCustomValidity('Invalid phone number. It must be 10 digits long.');
        }
    });
    end of phone validation*/

    // Get the input file and preview image elements
    const fileInput = document.getElementById('file-input');
    const previewImage = document.getElementById('preview');
    const uploadContainer = document.getElementById('pen-icon');

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
   setTimeout(function(){
        document.getElementById('msg').style.display="none";
    },3000);

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

