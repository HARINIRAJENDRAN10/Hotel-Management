<?php
$conn = new mysqli("localhost", "root", "1234", "haripro");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, passwords) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! Please login.'); window.location='loginuser.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body { font-family: Arial; background:#f4f4f9; text-align:center; }
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
form { background:white; width:300px; margin:100px auto; padding:20px; border-radius:10px; box-shadow:0px 0px 10px #ccc; }
input { width:90%; padding:8px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
button { background:#28a745; color:white; border:none; padding:10px; width:95%; border-radius:5px; cursor:pointer; }
button:hover { background:#218838; }
</style>
</head>
<body>
<h2>User Registration</h2>
<form method="post">
    <input type="text" name="username" placeholder="Enter Username" required><br>
    <input type="email" name="email" placeholder="Enter Email" required><br>
    <input type="password" name="password" placeholder="Enter Password" required><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
