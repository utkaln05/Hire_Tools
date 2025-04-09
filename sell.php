<?php
include_once('dbconnection.php');
//$name = $_SESSION['Pass'];

if (isset($_POST['submit'])) 
{
    $query = "SELECT * FROM `` WHERE UserName='$name';";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) 
    {
       // $email = $row['Email'];
        $mobileNo = $row['MobileNo'];

    }
    
    $PName = $_POST[''];
    $PName = $_POST['sell-location'];
    $PName = $_POST['sell-location'];
    $PName = $_POST['sell-location'];
    $PName = $_POST['sell-location'];
    $PName = $_POST['sell-location'];
    $PName = $_POST['sell-location'];
    echo $PName;
   

    $query = INSERT INTO `sell` (`toolName`, `mobile`, `price`, `email`, `image`, `location`, `ownerName`, `description`) VALUES ('', '', '', '', '', '', '', '')
    
    $result = mysqli_query($con, $query);

    if($result)
    {
        header("location:fertilizers.php");
        
    }
}
?>
