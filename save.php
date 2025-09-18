<?php
$server= "localhost";
$username= "root";
$Password= "";
$dbname= "demo"; // keep existing DB unless schema is migrated

$con = mysqli_connect($server, $username, $Password, $dbname);

if (!$con) {
    http_response_code(500);
    exit("Database connection failed");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass  = isset($_POST['pass']) ? $_POST['pass'] : '';

    if ($name === '' || $email === '' || $pass === '') {
        http_response_code(400);
        exit('Missing required fields');
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO web (`name`, `email`, `password`) VALUES (?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hash);
        if (mysqli_stmt_execute($stmt)) {
            echo 'done';
        } else {
            http_response_code(500);
            echo 'not done';
        }
        mysqli_stmt_close($stmt);
    } else {
        http_response_code(500);
        echo 'not done';
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}

?>