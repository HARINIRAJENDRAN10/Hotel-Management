<?php
$name = $_POST["name"] ?? '';
$email = $_POST["email"] ?? '';
$checkin = $_POST["checkin"] ?? '';
$noofdays = $_POST["noofdays"] ?? 0;
$roomtype = $_POST["roomtype"] ?? '';
$amount = $_POST["amount"] ?? 0;


$connect = mysqli_connect('localhost', 'root', '1234', 'haripro');

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($connect, $name);
$email = mysqli_real_escape_string($connect, $email);
$checkin = mysqli_real_escape_string($connect, $checkin);
$roomtype = mysqli_real_escape_string($connect, $roomtype);

$noofdays = (int)$noofdays;
$amount = (float)$amount;

$query = "INSERT INTO project (name, email, checkin, noofdays, roomtype, amount)
          VALUES ('$name', '$email', '$checkin', '$noofdays', '$roomtype', '$amount')";

if (mysqli_query($connect, $query)) {
    include("checkin.php");
} else {
    echo "Failed to insert data: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
