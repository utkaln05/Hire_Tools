<?php
require_once __DIR__ . '/auth.php';
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ToolName   = isset($_POST['productName']) ? trim($_POST['productName']) : '';
    $Description= isset($_POST['productDescription']) ? trim($_POST['productDescription']) : '';
    $toolPrice  = isset($_POST['productPrice']) ? trim($_POST['productPrice']) : '';
    $MobileNo   = isset($_POST['MobileNo']) ? trim($_POST['MobileNo']) : '';
    $quantity   = isset($_POST['productQuantity']) ? trim($_POST['productQuantity']) : '';

    // Validate required fields
    if ($ToolName === '' || $Description === '' || $toolPrice === '' || $MobileNo === '' || $quantity === '') {
        header('Location: addrent.html');
        exit;
    }

    // Process file upload first
    $Image = null;
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "Images/tools/";
        if (!is_dir($target_dir)) {
            @mkdir($target_dir, 0775, true);
        }
        $filename = basename($_FILES['productImage']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed, true)) {
            $safeName = uniqid('tool_', true) . '.' . $ext;
            $target_file = $target_dir . $safeName;
            $check = @getimagesize($_FILES['productImage']['tmp_name']);
            if ($check !== false && move_uploaded_file($_FILES['productImage']['tmp_name'], $target_file)) {
                $Image = $target_file; // store relative path
            }
        }
    }

    // Insert into DB using prepared statements
    $stmt = $conn->prepare("INSERT INTO `rent` (`toolId`, `toolName`, `Description`, `toolPrice`, `MobileNo`, `quantity`, `Image`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssss", $ToolName, $Description, $toolPrice, $MobileNo, $quantity, $Image);
        if ($stmt->execute()) {
            header("Location: message.html");
            exit;
        } else {
            error_log('addrent.php insert failed: ' . $stmt->error);
            header('Location: addrent.html');
            exit;
        }
    } else {
        error_log('addrent.php prepare failed: ' . $conn->error);
        header('Location: addrent.html');
        exit;
    }
}

// Close database connection
$conn->close();
?>
