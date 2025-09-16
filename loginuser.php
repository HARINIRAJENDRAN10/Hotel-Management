<?php
session_start();
$conn = new mysqli("localhost", "root", "1234", "haripro");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['passwords']) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login successful'); window.location='checkin.php';</script>";
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
    body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: url('hotel_view.jpg') no-repeat center center fixed;
    background-size: cover;
    z-index: -1;
    animation: bgmove 20s linear infinite;
    opacity: 0.2;
}
body { font-family: Arial; background:#f4f4f9; text-align:center; }
form { background:white; width:300px; margin:100px auto; padding:20px; border-radius:10px; box-shadow:0px 0px 10px #ccc; }
input { width:90%; padding:8px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
button { background:#007bff; color:white; border:none; padding:10px; width:95%; border-radius:5px; cursor:pointer; }
button:hover { background:#0056b3; }
</style>
</head>
<body>
<h2>User Login</h2>
<form method="post">
    <input type="text" name="username" placeholder="Enter Username" required><br>
    <input type="password" name="password" placeholder="Enter Password" required><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
