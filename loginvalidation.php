<?php

session_start();

$dbhost = "localhost";
$dbname="hrs";
$dbuser="root";
$dbpass="";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$name = $_GET['user'];
$pwd = $_GET['pass'];
$role = $_GET['type'];
$mail = $_GET['email'];
$logtype = $_GET['logtype'];

if($logtype=="login")
{

    $sql = "select * from login where username = '$name'  && password = '$pwd' && type = '$role' ";
    $res = mysqli_query($conn,$sql);

    $check = mysqli_fetch_assoc($res);
   
    if($check){
        $id = $check['login_id'];
        $_SESSION['loginid']= $id;
        
        if($role == 'Owner')
        {
            $sql3 = "select owner_ID from owner where login_id = '$id'";
            $res3 = mysqli_query($conn,$sql3);

            $row = mysqli_fetch_assoc($res3);
            $_SESSION['ownerid'] = $row['owner_ID'];
            
            header("Location:http://localhost/project/testnew.php");
            exit();
        }
        elseif($role == 'Tenant')
        {
            $sql4 = "select tenant_ID from tenant where login_id = '$id'";
            $res4 = mysqli_query($conn,$sql4);

            $row = mysqli_fetch_assoc($res4);
            $_SESSION['tenantid'] = $row['tenant_ID'];

            header("Location:http://localhost/project/tenantnew.php");
            exit();
        }
        else{
            header("Location:http://localhost/project/admin.php");
            exit();
        }
    }
    else
    {
        echo "Invalid user credentials";
    }
}

else
{
    $id = $check['login_id'];
    $_SESSION['loginid']= $id;

    if($role == 'Owner')
    {
        $sql2 = "select * from owner";
        $res2 = mysqli_query($conn,$sql2);
        $row = mysqli_num_rows($res2);

        $oid = "O0" . strval($row+1);
        $sql = "insert into login (username,email,password,type,status) values('$name','$mail','$pwd','$role','Active')";
    
        
        $res = mysqli_query($conn,$sql);
        $last_id = mysqli_insert_id($conn);

        $sql1 = "insert into owner (login_id,owner_ID) values ('$last_id','$oid')";
        $res1 = mysqli_query($conn,$sql1);

        $_SESSION['ownerid']=$oid;
        if($res)
        {
            header("Location:http://localhost/project/login.php");
            exit();
        }
        else
        {
            echo "You have already registered";
        }
    }
    else{
        $sql2 = "select * from tenant";
        $res2 = mysqli_query($conn,$sql2);
        $row = mysqli_num_rows($res2);

        $tid = "t0" . strval($row+1);
        $sql = "insert into login (username,email,password,type,status) values('$name','$mail','$pwd','$role','Active')";
    
        
        $res = mysqli_query($conn,$sql);
        $last_id = mysqli_insert_id($conn);

        $sql1 = "insert into tenant (login_id,tenant_ID) values ('$last_id','$tid')";
        $res1 = mysqli_query($conn,$sql1);

        $_SESSION['tenantid']=$tid;
        if($res)
        {
            header("Location:http://localhost/project/login.php");
            exit();
        }
        else
        {
            echo "You have already registered";
        }
    }

    
}

?>