<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Photo</title>
</head>
<body>
    <h1>Upload Profile Photo</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_photo" required>
        <button type="submit">Upload</button>
    </form>-->

    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $filename = $_FILES["profile_photo"]["name"];
        $targetFile = $targetDir . basename($_FILES["profile_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $login = $_POST['loginid'];

        // Check if the file is an image
        if (isset($_FILES["profile_photo"])) {
            $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.<br>";
                $uploadOk = 0;
            }
        }

        // Check file size (5MB limit)
        if ($_FILES["profile_photo"]["size"] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        $db = mysqli_connect("localhost", "root", "", "hrs");

            // Get all the submitted data from the form

            if(isset($_SESSION['ownerid'])){
                $url = "owner-profile.php";
                $sql = "Update owner set owner_photo = '$filename' where login_id = $login ";
            }
            else{
                $url = "t-details.php";
                $sql = "Update tenant set tenant_photo = '$filename' where login_id = $login ";

            }
            
            // Execute query
            mysqli_query($db, $sql);

        // Attempt to upload file if no errors
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
                
                header('location:' . $url);
               
                echo "The file " . htmlspecialchars(basename($_FILES["profile_photo"]["name"])) . " has been uploaded.";
              
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
    }
        ?>
