<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bill_id = $_POST['bill_id'] ?? '';

    $conn = new mysqli("localhost", "root", "1234", "haripro");
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $bill_id = $conn->real_escape_string($bill_id);

    $checkQuery = "SELECT * FROM project WHERE bill_id='$bill_id' AND status='booked'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $conn->query("UPDATE project SET status='cancelled' WHERE bill_id='$bill_id'");
        // ✅ Increment available rooms back
         $roomtype = $row['roomtype'];
    $roomsBooked = $row['no_of_rooms']; // must exist in project table

    $update = $conn->prepare("UPDATE rooms SET available_rooms = available_rooms + ? WHERE room_type = ?");
    $update->bind_param("is", $roomsBooked, $roomtype);
    $update->execute();
    $update->close();

        $status = 'Cancelled';
        $message = "
        <h2>🌟 HOTEL AMIL</h2>
        <strong>Bill ID:</strong> {$row['bill_id']}<br>
        <strong>Status:</strong> $status<br>
        <strong>Date:</strong> " . date("d-m-Y") . "<br><br>
        <strong>Guest Name:</strong> {$row['name']}<br>
        <strong>Email:</strong> {$row['email']}<br><br>
        <table border='1' cellpadding='10' cellspacing='0'>
            <tr><th>Detail</th><th>Information</th></tr>
            <tr><td>Check-in Date</td><td>{$row['checkin']}</td></tr>
            <tr><td>Room Type</td><td>{$row['roomtype']}</td></tr>
            <tr><td>Days Staying</td><td>{$row['noofdays']}</td></tr>
            <tr><td>Total Amount</td><td>₹{$row['amount']}</td></tr>
        </table>
        <p>Your booking has been cancelled. Thank you!</p>
        ";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '71762305020@cit.edu.in';
            $mail->Password = 'tcuc uury eben uesg';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('71762305020@cit.edu.in', 'Hotel Amil');
            $mail->addAddress($row['email'], $row['name']);
            $mail->isHTML(true);
            $mail->Subject = 'Hotel Amil Booking Cancelled';
            $mail->Body    = $message;
            $mail->send();

            echo "<script>alert('Booking cancelled & email sent successfully.'); window.location.href='home.php';</script>";

        } catch (Exception $e) {
            echo "<script>alert('Error sending email: {$mail->ErrorInfo}'); window.location.href='home.php';</script>";
        }

    } else {
        echo "<script>alert('No booked booking found with this Bill ID.'); window.location.href='home.php';</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cancel Booking - Hotel Amil</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #ffecd2, #fcb69f);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    width: 400px;
    text-align: center;
}
h2 {
    color: #dc3545;
    margin-bottom: 30px;
    font-size: 28px;
}
input[type="text"] {
    width: 90%;
    padding: 12px;
    margin: 10px 0 20px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
}
button {
    background: #dc3545;
    color: white;
    padding: 14px 25px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background: #a71d2a;
}
.back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #007bff;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
}
.back-btn:hover {
    background: #0056b3;
}
</style>
</head>
<body>

<div class="container">
    <h2>Cancel Booking</h2>
    <form method="POST" action="">
        <input type="text" name="bill_id" placeholder="Enter Bill ID" required><br>
        <button type="submit">Cancel Booking</button>
    </form>
    <a href="home.php" class="back-btn">⬅ Back to Home</a>
</div>

</body>
</html>
