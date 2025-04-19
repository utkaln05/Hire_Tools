<?php
//include_once('dbconnection.php');


$con = new mysqli("localhost", "root", "", "finalproject") or die("connection failed");

if (isset($_POST['submit'])) {

    //fetch from html
    $UserName = "nikam";
    //$_POST["UserName"];
    $Password = $_POST['Password'];

    $query1 = "SELECT * FROM `try2` WHERE UserName= '$UserName'AND Pass='$Password'";
    $result = mysqli_query($con, $query1);


    //Selection from database
    // $query = "SELECT `Pass`  FROM `try2` where UserName='$UserName'";
    // $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        //Confirmation check
        if ($Password == $row['Pass']) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['Username'] = $row['UserName'];
           // $_SESSION['name']=$UserName;
            
            header("location:index.php");


        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('User not registered');</script>";
    }
}

?>
