<?php
$username=$_POST['username'];
$password=$_POST['password'];
require 'database.php';

//Using crypt() to get password salty
$pswdhash=crypt($password);
$result = mysqli_query($con,"INSERT INTO user (name,password) VALUES ('".$username."','".$pswdhash."');");

//catch the error when using an exist username
if(!$result){
    header("Location: wusnm.html");
    exit;
    }
mysqli_close();
header("Location: sus.html");
?>