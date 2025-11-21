    <?php
    // Check if the 'msg' parameter exists in the URL
    if (isset($_GET['msg'])) {
        // Retrieve the message from the URL
        $message = htmlspecialchars($_GET['msg']); // Use htmlspecialchars to prevent XSS
    } else {
        // Default message if no 'msg' is provided
        $message = '';
    }
    ?>

   <?php include 'owner-header.php';?>
    <?php include 'popup.php'; ?>

    <?php 
    $ownerid = $_SESSION['ownerid'];
    /*echo $ownerid;
    exit;*/
       /* if(!isset($_SESSION['oname']) && $_SESSION['oname'] == ""){
            echo "<h2> Hello world </h2>";
            alert('please complete profile details','ok','cancel');
        }*/
        //alert('please complete profile details','ok','cancel');
    ?>
    <div class = "propertydiv">
        <?php //alert parameters: message, success button, cancel button, success redirect url, cancel redirect url ?>
        <?php if($_SESSION['oname'] == ""){
        alert('Please complete Profile Details','OK','Cancel','owner-profile.php','owner2.php'); 
        } ?>
        
    <h1>Post Your Property</h1>

    <form id="myForm" action="property-subadmin.php" method="POST" enctype="multipart/form-data" class="propertyform">

        <div class="propertyform-group">
            <?php if ($message): ?>
                <div id="successMessage"><?= $message ?></div>
            <?php endif; ?>
            <label for="title">Property Title:</label>
            <input type="text" id="title" name="title" required>
            <input type="hidden" id="ownerid" name="ownerid" value = <?php echo $ownerid; ?>>
        </div>

        <div class="propertyform-group">
            <label for="description">Property Description:</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>

        <div class="propertyform-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>

        <div class="propertyform-group">
            <label for="price">Rent Amount:</label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="propertyform-group">
            <label for="propertyType">Property Type:</label>
            <select id="propertyType" name="propertyType" required>
                <option value="">Select Type</option>
                <?php
                    $conn = mysqli_connect('localhost','root','','hrs');

                    $sql = 'select * from type';
                    $res = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($res)){ ?>
                        <option value="<?php echo $row['type_name']; ?>"><?php echo $row['type_name']; ?></option>
                    <?php } ?>
                <!--<option value="Flat">Flat</option>
                <option value="House">House</option>-->
            </select>
        </div>

        <div class="propertyform-group">
            <label for="propertyCategory">Property Category:</label>
            <select id="propertyCategory" name="propertyCategory" required>
                <option value="">Select Category</option>
                <?php 
                    $sql1 = 'select * from category';
                    $res1 = mysqli_query($conn,$sql1);
                    while($row1 = mysqli_fetch_assoc($res1)){ ?>
                        <option value="<?php echo $row1['category_name']; ?>"><?php echo $row1['category_name']; ?></option>
                    <?php } ?>
                <!--<option value="furnished">Furnished</option>
                <option value="unfurnished">Un-furnished</option>
                <option value="semifurnished">Semi-furnished</option>-->
            </select>
        </div>

        <div class="propertyform-group">
            <label for="propertySubCategory">Property Sub-Category:</label>
            <select id="propertySubCategory" name="propertySubCategory" required>
                <option value="">Select Sub-Category</option>
                <?php 
                    $sql2 = 'select * from subcategory';
                    $res2 = mysqli_query($conn,$sql2);
                    while($row2 = mysqli_fetch_assoc($res2)){ ?>
                        <option value="<?php echo $row2['s_name']; ?>"><?php echo $row2['s_name']; ?></option>
                    <?php } ?>
                <!--<option value="1BHK">1BHK</option>
                <option value="2BHK">2BHK</option>
                <option value="3BHK">3BHK</option>-->
            </select>
        </div>

        <div class="propertyform-group">
            <label for="bathrooms">Number of Bathrooms:</label>
            <input type="number" id="bathrooms" name="bathrooms" required>
        </div>

        <div class="propertyform-group">
            <label for="contact">Contact Information:</label>
            <input type="text" id="contact" name="contact" required>
        </div>

        <label for="images">Upload Property Images:</label>
        <p>It is mandatory to upload 6 images</p><br>
        <?php $id=1; 
        
        ?>
        <?php
        $totalImages = 6;
        for($a=1; $a<= $totalImages; $a++){
        ?>

            <div class="propertyform-group img-container" id="img-container<?php echo $a;?>">
                <div class="image-preview-wrapper">
                    <?php if(!isset($photo)){ $photo = ""; }?>
                    <img id="preview<?php echo $a;?>" class="image-preview" src='./uploads/<?php echo $photo; ?>'  style="display: block;">
                </div>
                <!--<i class="pen-icon">✏️</i>-->
                    
                <div class="upicon" id="upload-container<?php echo $a;?>">
                    <i class="pen-icon"><i class="fa-solid fa-camera"></i></i>
                    <!--<input type="hidden" id="loginid" name="loginid" value="<?php echo $id ;?> ">-->
                    <input type="file" id="file-input<?php echo $a;?>" name="image<?php echo $a; ?>"  onchange="previewImages(event,'preview<?php echo $a;?>')" required>
                </div>
            </div>
        <?php } ?>
        
        <div class="property-form-submit">
            <button type="submit" class="sub" name="propertySubmit">Submit Property</button>
        </div>
       <!-- </div> -->

      <!-- <div class="property-form-submit">
            <button type="submit" class="sub" name="propertySubmit" onclick="showSuccessMessage(event)">Submit Property</button>
        </div>

        <div id="successMessage" style="display:none; color:green; font-weight:bold;">Property submitted successfully!</div>-->
    </form>
    

</div>
        </div>
<script>
    
    

    const totImages = 6;    
    let z = 'file-input';
    //let y = 'img-container';
    let y = 'upload-container';
    
    const fileInput = [];
    const uploadContainer=[];

    for(let a=1; a<= totImages; a++){
        let fileinput = z + a;
        let imgcntr = y + a;
        fileInput[a] = document.getElementById(fileinput);
        uploadContainer[a] = document.getElementById(imgcntr);

        uploadContainer[a].addEventListener('click', function() {
            fileInput[a].click();
        });
    }

    function previewImages(event, previewId) {
    
        const previewImage = document.getElementById(previewId);
        const file = event.target.files[0];
        const reader = new FileReader();
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = ''; // Clear previous preview

        if (file) {
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                previewImage.src = e.target.result;
                //previewContainer.appendChild(imgElement);
                previewImage.style.display = 'block'; // Show the image preview
            }
            reader.readAsDataURL(file); // Convert file to data URL for preview
        }
    }

    /*function showSuccessMessage(event) {

        const form = document.getElementById("myForm");
        event.preventDefault(); // Prevent the form from submitting immediately
        
        // Display the success message
        document.getElementById("successMessage").style.display = "block";
        
        // Optionally, you can hide the success message after a few seconds
        setTimeout(function() {
            document.getElementById("successMessage").style.display = "none";
        }, 5000); // Hide after 5 seconds

        form.submit();
    }*/
    // Check if there is a message to display
    const successMessage = document.getElementById('successMessage');
    
    // If the message exists, set a timeout to hide it after 5 seconds
    if (successMessage) {
        successMessage.style.color = 'green';
        successMessage.style.textAlign = 'center';
        setTimeout(function() {
            successMessage.style.display = 'none';  // Hide the message
        }, 5000);  // 5000 milliseconds = 5 seconds
    }

</script>  
</body>
</html>

