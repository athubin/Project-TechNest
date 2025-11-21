    <?php include 'owner-header.php';?>
	<?php

		$oid = $_SESSION['ownerid'];
		$conn = mysqli_connect("localhost","root","","hrs");
		$sql = "select * from property where owner_id = '$oid' order by p_id desc ";
		$res = mysqli_query($conn,$sql);
		
	  ?>
    <div class = "propertydiv">
    <h1>Property Edit</h1>
	<?php //echo "post ";
	//print_r('$_POST');
	if( !isset($_POST['editsubmit'])){ ?>
	<form action="" method="POST" class="propertyform">
		<label for="prop">Select property to edit</label>
		<select id="prop" name="property" required>
			<?php 
			while($row = mysqli_fetch_assoc($res)){ 
				$prop = $row['p_title'] . " - " . $row['p_location'] . " - ₹" . $row['p_price'];
			?>
                <option value="<?php echo $row['p_id'];?>"><?php echo $prop; ?></option>
			<?php } ?>
		</select>
		<input class="editsubtn" type="submit" name="editsubmit" value="Edit">
	</form>
	<?php } else { 
	$p_id = $_POST['property'];
	
	$sql1 = "select * from property where p_id = '$p_id' "; 
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1) ;
	?>
    <form action="ownprop-edit-save.php" method="POST" enctype="multipart/form-data" class="propertyform">
        <div class="propertyform-group">
            <label for="title">Property Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $row1['p_title']; ?>" required>
            <input type="hidden" id="propid" name="propid" value="<?php echo $row1['p_id']; ?>">
        </div>

        <div class="propertyform-group">
            <label for="description">Property Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo $row1['p_desc']; ?></textarea>
        </div>

        <div class="propertyform-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $row1['p_location']; ?>"required>
        </div>

        <div class="propertyform-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $row1['p_price']; ?>" required>
        </div>

        <div class="propertyform-group">
            <label for="propertyType">Property Type:</label>
            <select id="propertyType" name="propertyType" required>
                <option value="<?php echo $row1['p_type']; ?>"><?php echo $row1['p_type']; ?></option>
                <option value="flat">Flat</option>
                <option value="house">House</option>
            </select>
        </div>

        <div class="propertyform-group">
            <label for="propertyCategory">Property Category:</label>
            <select id="propertyCategory" name="propertyCategory" required>
                <option value="<?php echo $row1['p_category']; ?>"><?php echo $row1['p_category']; ?></option>
                <option value="furnished">Furnished</option>
                <option value="unfurnished">Un-furnished</option>
                <option value="semifurnished">Semi-furnished</option>
            </select>
        </div>

        <div class="propertyform-group">
            <label for="propertySubCategory">Property Sub-Category:</label>
            <select id="propertySubCategory" name="propertySubCategory" required>
                <option value="<?php echo $row1['p_subcat']; ?>"><?php echo $row1['p_subcat']; ?></option>
                <option value="1BHK">1BHK</option>
                <option value="2BHK">2BHK</option>
                <option value="3BHK">3BHK</option>
            </select>
        </div>

        <div class="propertyform-group">
            <label for="bathrooms">Number of Bathrooms:</label>
            <input type="number" id="bathrooms" name="bathrooms" value="<?php echo $row1['p_bath']; ?>" required>
        </div>

        <div class="propertyform-group">
            <label for="contact">Contact Information:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row1['p_contact']; ?>" required>
        </div>

        <label for="images">Upload Property Images:</label>
        <?php $id=1; 
        
        ?>
        <?php
        $totalImages = 6;
        for($a=1; $a<= $totalImages; $a++){
        ?>

            <div class="propertyform-group img-container" id="img-container<?php echo $a;?>">
                <div class="image-preview-wrapper">
                    <?php if(!isset($photo)){ $photo = ""; }?>
					<?php
						$b = 'p_image'.$a;
						$photo = $row1[$b];
					?>
                    <img id="preview<?php echo $a;?>" class="image-preview" src='./uploads/<?php echo $photo; ?>'  style="display: block;">
                </div>
                <!--<i class="pen-icon">✏️</i>-->
                    
                <div class="upicon" id="upload-container<?php echo $a;?>">
                    <i class="pen-icon"><i class="fa-solid fa-camera"></i></i>
                    <input type="file" id="file-input<?php echo $a;?>" name="image<?php echo $a; ?>" 
							value="<?php echo $photo; ?>"
							onchange="previewImages(event,'preview<?php echo $a;?>')">
					
                </div>
            </div>
        <?php } ?>
        
        <div class="property-form-submit">
            <button type="submit" class="sub" name="propertySubmit">Submit Property</button>
        </div>
       <!-- </div> -->
    </form>
    <?php } ?>

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

</script>  
</body>
</html>

