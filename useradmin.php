<?php

$conn = mysqli_connect('localhost','root','','hrs');

if(isset($_POST['complaintsubmit'])){
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $msg = $_POST['subject'];

    $sql = "insert into admin (first_name,last_name,email,message) values ('$fname','$lname','$email','$msg')";
    $res = mysqli_query($conn,$sql);

    header("location:contact.php");
}
