<?php
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <section class="header">
    <div class="nav-bar">
      <div class="left-side">
        <div class="logo">
          <img src="Images/logo3.png" alt="Hire Tools" title="Hire Tools">
        </div>
      </div>
      <div class="right-side">
        <ul id="nav-links">
          <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
          <li><a href="addrent.html"><i class="fa fa-bus" aria-hidden="true"></i>Add Rent Tool</a></li>
          <li><a href="contactUs.php" class="active"><i class="fa fa-fw fa-envelope"></i>Contact Us</a></li>
        </ul>
      </div>
      <a href="logout.php"><button id="login"><i class="fa fa-fw fa-user"></i>Logout</button></a>
    </div>
  </section>

  <main style="max-width: 800px; margin: 2rem auto; padding: 1rem;">
    <h1>Contact Us</h1>
    <p>If you have any questions, please drop us a message.</p>
    <form action="#" method="post" onsubmit="alert('Thanks! We\'ll get back to you soon.'); return false;">
      <label>Name</label>
      <input type="text" name="name" required style="width:100%;padding:.5rem;margin:.25rem 0 1rem;">
      <label>Email</label>
      <input type="email" name="email" required style="width:100%;padding:.5rem;margin:.25rem 0 1rem;">
      <label>Message</label>
      <textarea name="message" rows="5" required style="width:100%;padding:.5rem;margin:.25rem 0 1rem;"></textarea>
      <button type="submit" style="padding:.6rem 1rem;">Send</button>
    </form>
  </main>

  <section class="footer">
    <div class="left-side-footer">
      <p>&copy;2025 All Rights Reserved </p>
    </div>
    <div class="right-side-footer">
      <p>Web Design and Development by <a href="index.php">Elite Team</a></p>
    </div>
  </section>
</body>
</html>
