<?php
session_start();

// 1. Only handle POST submissions — otherwise route based on auth state
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        header("Location: index.php");
    } else {
        header("Location: login.html");
    }
    exit();
}

// 2. Connect to database
$mysqli = new mysqli("localhost", "root", "", "finalproject");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 3. Grab & trim inputs
$username = isset($_POST['UserName']) ? trim($_POST['UserName']) : '';
$password = isset($_POST['Password']) ? trim($_POST['Password']) : '';

// 4. Simple required‑field check
if ($username === '' || $password === '') {
    echo "<script>
            alert('Please enter both username and password.');
            window.location.href = 'login.html';
          </script>";
    exit();
}

// 5. Look up the stored “Pass” value for this user
$stmt = $mysqli->prepare("
    SELECT Pass
      FROM `try2`
     WHERE Username = ?
     LIMIT 1
");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// 6. If we found exactly one row, pull it out
if ($stmt->num_rows === 1) {
    $stmt->bind_result($storedPass);
    $stmt->fetch();

    // 7. Log the retrieved value for debugging
    //    (Check your PHP error log to see EXACTLY what’s in the DB)
    error_log("login.php: Stored Pass for [$username] = {$storedPass}");

    // 8. Detect if it’s a bcrypt hash (starts with $2y$, $2a$ or $2b$)
    $isBcrypt = preg_match('/^\$2[ayb]\$[0-9]{2}\$/', $storedPass) === 1;

    // 9. Verify accordingly
    if (
        ($isBcrypt && password_verify($password, $storedPass)) || 
        (!$isBcrypt && $password === $storedPass)
    ) {
        // ✅ Success: only registered users get here
        $_SESSION['login']    = true;
        $_SESSION['UserName'] = $username;
        header("Location: index.php");
        exit();
    }
}

// 10. If we get here, either no such user or bad password
echo "<script>
        alert('Invalid username or password.');
        window.location.href = 'login.html';
      </script>";
exit();
