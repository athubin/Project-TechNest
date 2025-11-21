<?php

session_start();

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$name = $_POST['user'];
$pwd = md5($_POST['pass']);
$role = $_POST['type'];
$mail = isset($_POST['email']) ? $_POST['email'] : "";
$logtype = $_POST['logtype'];


if($logtype=="login")
{

    $sql = "select * from login where username = '$name'  && password = '$pwd' && type = '$role' && status = 'Active' ";
    $res = mysqli_query($conn,$sql);

    $check = mysqli_fetch_assoc($res);
    //$status = $check['status'];
    /*$id = $check['login_id']; 
    $_SESSION['loginid']= $id;*/
    
    if($check){
        $status = $check['status'];
        $id = $check['login_id'];
        $_SESSION['loginid']= $id;
        
        if($role == 'Owner')
        {
            $sql3 = "select owner_ID,owner_name from owner where login_id = '$id'";
            $res3 = mysqli_query($conn,$sql3);

            $row = mysqli_fetch_assoc($res3);
            $_SESSION['ownerid'] = $row['owner_ID'];
            $_SESSION['oname'] = $row['owner_name'];
            
            header("Location:http://localhost/technest/owner3.php");
            exit();
        }
        elseif($role == 'Tenant')
        {
            $sql4 = "select tenant_ID, tenant_name, tenant_status from tenant where login_id = '$id'";
            $res4 = mysqli_query($conn,$sql4);

            $row = mysqli_fetch_assoc($res4);

            if ($row['tenant_status'] === 'Not Active') {
                // Display inactive account message
                echo "<script>alert('Your account is currently inactive. Please contact support.');</script>";
               // header("location:login.php");
               // header('location:login.php?msg=Your Account is currently inactive. Please contact support');
                exit();
            }
            else{
                $_SESSION['tenantid'] = $row['tenant_ID'];
                $_SESSION['tenantname'] = $row['tenant_name'];
    
                header("Location:http://localhost/technest/home-new.php");
                exit();
            }
        }
        else{
            header("Location:http://localhost/technest/admin.php");
            exit();
        }
    }
    else
    {
        $sql4 ="select * from login where username = '$name'  && password = '$pwd'";
        $res4 = mysqli_query($conn,$sql4);
        if(mysqli_num_rows($res4)){
           $msg = "Login disabled!..Please contact support";
        }
        else{
            $msg = "Invalid user credentials";
        }
        
        //$status = $res4['status'];
        /*$status = isset($check['status']) ? $check['status'] : "Active";
        echo $status;
        exit;
        $msg = ($status == "Active") ? "Invalid user credentials" : "Login disabled!..Please contact support";*/
        
        //header('location:login.php?msg=Invalid user credentials');
        header('location:login.php?msg=' . $msg);
    }
}

else /*for registration*/
{
    /*$sql = "select * from login where username = '$name'  && password = '$pwd' && type = '$role' ";
    $res = mysqli_query($conn,$sql);

    $check = mysqli_fetch_assoc($res);
    $id = $check['login_id'];
    $_SESSION['loginid']= $id;*/

    $curdate = date('Y-m-d');
 

    if($role == 'Owner')
    {
        $sql2 = "select * from owner";
        $res2 = mysqli_query($conn,$sql2);
        $row = mysqli_num_rows($res2);

        $sql3 = "select username from login where username = '$name' AND type = '$role' ";
        $res3 = mysqli_query($conn,$sql3);
        if(mysqli_num_rows($res3) == 0){

            $oid = "O0" . strval($row+1);
            $sql = "insert into login (username,email,password,type,login_date,status) values('$name','$mail','$pwd','$role','$curdate','Active')";
    
        
            $res = mysqli_query($conn,$sql);
            $last_id = mysqli_insert_id($conn);

            $sql1 = "insert into owner (login_id,owner_ID) values ('$last_id','$oid')";
            $res1 = mysqli_query($conn,$sql1);

            $_SESSION['ownerid']=$oid;
            
            if($res)
            {
               //header("Location:http://localhost/technest/login.php");
               header("Location:http://localhost/technest/login.php?msg=Registered..!, Please login..");
                exit();
            }
            else
            {
                header('location:login.php?msg=Not Registered, Please try again');
                exit();
            }
        }
        else{
            header('location:login.php?msg=Already registered, Please login');
            exit();
        }
    }
    else if($role == 'Tenant'){
        $sql2 = "select * from tenant";
        $res2 = mysqli_query($conn,$sql2);
        $row = mysqli_num_rows($res2);

        $sql3 = "select username from login where username='$name' AND type='$role' ";
        $res3 = mysqli_query($conn,$sql3);
        if(mysqli_num_rows($res3) == 0){

            $tid = "t0" . strval($row+1);
            $sql = "insert into login (username,email,password,type,login_date,status) values('$name','$mail','$pwd','$role','$curdate','Active')";
        
            
            $res = mysqli_query($conn,$sql);
            $last_id = mysqli_insert_id($conn);

            $sql1 = "insert into tenant (login_id,tenant_ID) values ('$last_id','$tid')";
            $res1 = mysqli_query($conn,$sql1);

            $_SESSION['tenantid']=$tid;
            if($res)
            {
                header("Location:http://localhost/technest/login.php?msg=Registered..!, Please login..");
                exit();
            }
            else
            {
                header('location:login.php?msg=Not Registered, Please try again');
                exit();
            }
        }
        else{
            header('location:login.php?msg=Already registered, Please login');
            exit();
        }
    }
} 

?>