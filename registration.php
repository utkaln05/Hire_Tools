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
    $Username = isset($_POST['Username']) ? trim($_POST['Username']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mob      = isset($_POST['mob']) ? trim($_POST['mob']) : '';
    $PassRaw  = isset($_POST['Pass']) ? $_POST['Pass'] : '';
    $Confirm  = isset($_POST['ConfirmPass']) ? $_POST['ConfirmPass'] : '';

    if ($Username === '' || $email === '' || $mob === '' || $PassRaw === '' || $Confirm === '') {
        // Basic validation failed
        header('Location: registration.html');
        exit;
    }

    if ($PassRaw !== $Confirm) {
        // Passwords do not match
        header('Location: registration.html');
        exit;
    }

    $Pass = password_hash($PassRaw, PASSWORD_DEFAULT);

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO `try2` (`Username`, `email`, `mob`, `Pass`) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('ssss', $Username, $email, $mob, $Pass);
        if ($stmt->execute()) {
            header("Location: message.html");
            exit;
        } else {
            // Log error in server logs
            error_log('registration.php insert failed: ' . $stmt->error);
            header('Location: registration.html');
            exit;
        }
    } else {
        error_log('registration.php prepare failed: ' . $conn->error);
        header('Location: registration.html');
        exit;
    }
}

// Close database connection
$conn->close();
?>
