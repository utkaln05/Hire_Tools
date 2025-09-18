<?php
      session_start();
      // Guard route: allow only authenticated users
      if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: login.html");
        exit;
      }
?>