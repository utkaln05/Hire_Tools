<?php
// Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a form submission or some data to insert
// For example, if you have form fields named 'name' and 'email'

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ToolName = $_POST['productName'];
    $Username = $_POST['Username'];
    $email = $_POST['email'];
    $mob = $_POST['mob'];
    $Pass = $_POST['Pass'];

    // Prepare SQL query to insert data

    $sql = "INSERT INTO `try2` (`Username`, `email`, `mob`, `Pass`) VALUES ('$Username','$email', '$mob', '$Pass')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration Sucessful')</script>";
        header("location:message.html");
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
