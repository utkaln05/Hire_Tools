<?php
// Database connection
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL user
$password = "";  // Default XAMPP MySQL password is empty
$dbname = "fixyfy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $userName = $conn->real_escape_string($_POST['UserName']);
    $email = $conn->real_escape_string($_POST['Email']);
    $mobileNo = $conn->real_escape_string($_POST['MobileNo']);
    $nPassword = $conn->real_escape_string($_POST['Npassword']);
    $cPassword = $conn->real_escape_string($_POST['Cpassword']);

    // Check if passwords match
    if ($nPassword !== $cPassword) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($nPassword, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO `try2` (`Username`, `email`, `mob`, `pass`) VALUES ('$userName', '$email', '$mobileNo', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href = 'login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
