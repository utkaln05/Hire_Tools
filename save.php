<?php
$server= "localhost";
$username= "root";
$Password= "";
$dbname= "demo";

$con=mysqli_connect($server,$username,$Password,$dbname);

if(!$con){
    echo"not connected";
}


$name=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$sql = "INSERT INTO web (`name`, `email`, `password`) VALUES ('$name','$email','$pass')";
$result=mysqli_connect($con,$sql);
if($result){
    echo "done";
}
else{
    echo"not done";
}
?>