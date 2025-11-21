<?php
    session_start();

    $oid = $_SESSION['ownerid'];

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "hrs";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if (isset($_POST['propertySubmit'])) {
        $pid = $_POST['propid'];
        $p_title = $_POST['title'];
        $p_desc = $_POST['description'];
        $p_loc = $_POST['location'];
        $p_price = $_POST['price'];
        $p_type = $_POST['propertyType'];
        $p_cat = $_POST['propertyCategory'];
        $p_sub = $_POST['propertySubCategory'];
        $p_bath = $_POST['bathrooms'];
        $p_contact = $_POST['contact'];
        
        $sql1 = "SELECT * FROM property WHERE p_id = '$pid'";
        $res1 = mysqli_query($conn, $sql1);
        $existingProperty = mysqli_fetch_assoc($res1);
        
        $existingImages = [
            'image1' => $existingProperty['p_image1'],
            'image2' => $existingProperty['p_image2'],
            'image3' => $existingProperty['p_image3'],
            'image4' => $existingProperty['p_image4'],
            'image5' => $existingProperty['p_image5'],
            'image6' => $existingProperty['p_image6']
        ];

        // Update property details
        $sql = "UPDATE property SET p_title = '$p_title', p_desc = '$p_desc', p_location = '$p_loc', p_price = '$p_price', 
                p_type = '$p_type', p_category = '$p_cat', p_subcat = '$p_sub', p_bath = '$p_bath', p_contact = '$p_contact'
                WHERE p_id = '$pid'";

        $res = mysqli_query($conn, $sql);

        // Define the target directory for uploads
        $targetDir = "uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageFields = ['image1', 'image2', 'image3', 'image4', 'image5', 'image6'];
        $fnames = [];

        foreach ($imageFields as $imageField) {
            if (isset($_FILES[$imageField]) && $_FILES[$imageField]['error'] === 0) {
                $file = $_FILES[$imageField];
                
                // Get file extension and validate it
                $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($fileExt, $allowedExt)) {
                    // Generate a new unique filename
                    $newFileName = basename($file['name']);
                    $fileDestination = $targetDir . $newFileName;
                    
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
                        $fnames[$imageField] = $newFileName;
                    }
                }
            } else {
                // If no new image is uploaded, keep the existing image
                $fnames[$imageField] = $existingImages[$imageField];
            }
        }

        // Insert or update the image paths in the database
        insertimgs($conn, $fnames, $pid);
        
        // Redirect after successful update
        $msg = $res ? "Property edited successfully" : "Property not modified";
        header("Location: owner-post.php?msg=$msg");
    }

    function insertimgs($conn, $fnames, $pid) {
        $img1 = $fnames['image1'] ?? NULL;
        $img2 = $fnames['image2'] ?? NULL;
        $img3 = $fnames['image3'] ?? NULL;
        $img4 = $fnames['image4'] ?? NULL;
        $img5 = $fnames['image5'] ?? NULL;
        $img6 = $fnames['image6'] ?? NULL;

        // Update images only if a new image was uploaded
        $sql1 = "UPDATE property SET p_image1 = '$img1' WHERE p_id = '$pid'";
        $sql2 = "UPDATE property SET p_image2 = '$img2' WHERE p_id = '$pid'";
        $sql3 = "UPDATE property SET p_image3 = '$img3' WHERE p_id = '$pid'";
        $sql4 = "UPDATE property SET p_image4 = '$img4' WHERE p_id = '$pid'";
        $sql5 = "UPDATE property SET p_image5 = '$img5' WHERE p_id = '$pid'";
        $sql6 = "UPDATE property SET p_image6 = '$img6' WHERE p_id = '$pid'";

        mysqli_query($conn, $sql1);
        mysqli_query($conn, $sql2);
        mysqli_query($conn, $sql3);
        mysqli_query($conn, $sql4);
        mysqli_query($conn, $sql5);
        mysqli_query($conn, $sql6);
    }
?>
