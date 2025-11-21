<?php
    session_start();

   /* $oid = $_SESSION['ownerid'];
    print_r($_SESSION);
    exit;*/

    $dbhost="localhost";
    $dbuser="root"; 
    $dbpass="";
    $dbname="hrs";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    
    if(isset($_POST['propertySubmit']))
    {
        $p_title = $_POST['title'];
        $p_desc = $_POST['description'];
        $p_loc = $_POST['location'];
        $p_price = $_POST['price'];
        $p_type = $_POST['propertyType'];
        $p_cat = $_POST['propertyCategory'];
        $p_sub = $_POST['propertySubCategory'];
        $p_bath = $_POST['bathrooms'];
        $p_contact = $_POST['contact'];
        $ownerid = $_POST['ownerid'];
        /*echo $ownerid;
        exit;*/
       

        $target_dir = "uploads/";
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //$uploadOk = 1;
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $sql1 = "select * from property";
        $res1 = mysqli_query($conn,$sql1);
        $row = mysqli_num_rows($res1);

        $pid = "p0" . strval($row+1);
        $pstatus = 0;
        $pbooked = 1;
        $ownerstatus = 1;
        $p_date = date('Y-m-d');

        $sql = "insert into property (p_id,p_title,p_desc,p_date,p_location,p_price,p_type,p_category,p_subcat,p_bath,p_contact,owner_id,p_status,p_booked,p_owner_status) 
                values('$pid','$p_title','$p_desc','$p_date','$p_loc','$p_price','$p_type','$p_cat','$p_sub','$p_bath','$p_contact','$ownerid',$pstatus,$pbooked,$ownerstatus)";
        $res = mysqli_query($conn,$sql);

        $_SESSION['p_stat'] = $pstatus;
        $_SESSION['pid'] = $pid;


        // Define the target directory where images will be uploaded
        $targetDir = "uploads/";

        // Create the directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        // Loop through the image inputs (image1 to image5)
        $imageFields = ['image1', 'image2', 'image3', 'image4', 'image5','image6'];
        $fnames = [];
    
    foreach ($imageFields as $imageField) {
        if (isset($_FILES[$imageField]) && $_FILES[$imageField]['error'] === 0) {
            $file = $_FILES[$imageField];
            
            // Check if the file is a valid image
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileError = $file['error'];

            // Get the file extension and validate it
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExt, $allowedExt)) {
                // Generate a unique file name to avoid conflicts
                //$newFileName = uniqid('', true) . '.' . $fileExt;
                $newFileName = basename($fileName);
                $fileDestination = $targetDir . $newFileName;
                
               
                // Move the uploaded file to the target directory
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $fnames[$imageField] = $fileName;
                    echo "File uploaded successfully: $newFileName<br>";
                } else {
                    echo "Error uploading file: $fileName<br>";
                }
            } else {
                echo "Invalid file type for $fileName. Only jpg, jpeg, png, gif are allowed.<br>";
            }
        }
    }

    //if (count($fnames) == 6) {
       // $description = $_POST['description'];
        //insertImages($conn, $fnames,$pid);
        insertimgs($conn, $fnames,$pid);
   // }
}

if($res)
{
    $msg = "Property added successfully";
}
else
{
    $msg =  "Property not added";
} 
header("Location: owner-post.php?msg=$msg");
exit;

function insertimgs($conn, $fnames,$pid){
    $img1 = $fnames['image1'] ?? NULL;
    $img2 = $fnames['image2'] ?? NULL;
    $img3 = $fnames['image3'] ?? NULL;
    $img4 = $fnames['image4'] ?? NULL;
    $img5 = $fnames['image5'] ?? NULL;
    $img6 = $fnames['image6'] ?? NULL;

    $sql1 = "update property set p_image1 = '$img1' where p_id = '$pid'";
    $sql2 = "update property set p_image2 = '$img2' where p_id = '$pid'";
    $sql3 = "update property set p_image3 = '$img3' where p_id = '$pid'";
    $sql4 = "update property set p_image4 = '$img4' where p_id = '$pid'";
    $sql5 = "update property set p_image5 = '$img5' where p_id = '$pid'";
    $sql6 = "update property set p_image6 = '$img6' where p_id = '$pid'";

    $res = mysqli_query($conn,$sql1);
    $res1 = mysqli_query($conn,$sql2);
    $res2 = mysqli_query($conn,$sql3);
    $res3 = mysqli_query($conn,$sql4);
    $res4 = mysqli_query($conn,$sql5);
    $res5 = mysqli_query($conn,$sql6);

}
    