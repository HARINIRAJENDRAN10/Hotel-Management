<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #895abbff, #2575fc);
        text-align: center;
        padding: 60px;
        color: #fff;
    }
    h2 {
        margin-bottom: 50px;
        font-size: 36px;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.3);
    }
    .btn {
        display: inline-block;
        margin: 15px;
        padding: 18px 35px;
        background: #28a745;
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        font-size: 20px;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transition: 0.3s;
    }
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    .cancel-btn {
        background: #dc3545;
    }
    .cancel-btn:hover {
        background: #b02a37;
    }
    .home-btn {
        background: #ffc107;
        color: #333;
    }
    .home-btn:hover {
        background: #e0a800;
        color: #fff;
    }
  </style>
</head>
<body>
  <h2>Welcome to Admin Panel</h2>
  <a href="confirmed_bookings.php" class="btn">Confirmed Bookings</a>
  <a href="cancelled_bookings.php" class="btn cancel-btn">Cancelled Bookings</a>
  <br><br>
  <a href="home.php" class="btn home-btn">⬅ Back to Home</a>
</body>
</html>
