<?php
require_once __DIR__ . '/auth.php';
include_once('dbconnection.php');

// Expecting fields from sell.html: name, email, mobile, price, location, image (file), owner
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mobile   = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
    $price    = isset($_POST['price']) ? trim($_POST['price']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $owner    = isset($_POST['owner']) ? trim($_POST['owner']) : '';

    if ($name === '' || $email === '' || $mobile === '' || $price === '' || $location === '' || $owner === '') {
        header('Location: sell.html');
        exit;
    }

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'Images/sell/';
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed, true)) {
            $safeName = uniqid('sell_', true) . '.' . $ext;
            $target   = $targetDir . $safeName;
            $check = @getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $imagePath = $target;
            }
        }
    }

    // Insert into `sell` table (toolName, mobile, price, email, image, location, ownerName)
    $stmt = $con->prepare("INSERT INTO `sell` (`toolName`, `mobile`, `price`, `email`, `image`, `location`, `ownerName`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('sssssss', $name, $mobile, $price, $email, $imagePath, $location, $owner);
        if ($stmt->execute()) {
            header('Location: message.html');
            exit;
        } else {
            error_log('sell.php insert failed: ' . $stmt->error);
            header('Location: sell.html');
            exit;
        }
    } else {
        error_log('sell.php prepare failed: ' . $con->error);
        header('Location: sell.html');
        exit;
    }
}
?>
