<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form values
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $checkin = $_POST['checkin'] ?? '';
    $days = $_POST['noofdays'] ?? '';
    $roomtype = $_POST['roomtype'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $rooms=$_POST['rooms'] ?? '';
    $date = date("d-m-Y");

    // ✅ Database connection
    $conn = new mysqli("localhost", "root", "1234", "haripro");
    if ($conn->connect_error) {
        die("❌ Database connection failed: " . $conn->connect_error);
    }

    // ✅ Check room availability
    $check = $conn->prepare("SELECT available_rooms FROM rooms WHERE room_type = ?");
    $check->bind_param("s", $roomtype);
    $check->execute();
    $res = $check->get_result();
    $row = $res->fetch_assoc();
    $check->close();

    if (!$row || $row['available_rooms'] <= 0) {
        echo "<script>alert('❌ No $roomtype rooms available. Please choose another type.'); 
              window.location='checkin.php';</script>";
        exit;
    }

    // ✅ Insert booking into DB
    $sql = "INSERT INTO project (name, email, checkin, noofdays, roomtype, amount,no_of_rooms)
            VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisii", $name, $email, $checkin, $days, $roomtype, $amount,$_POST['rooms']);

    if ($stmt->execute()) {
        $bill_id = $conn->insert_id;

        // ✅ Reduce availability
        $update = $conn->prepare("UPDATE rooms SET available_rooms = available_rooms - ? 
                                  WHERE room_type = ? AND available_rooms > 0");
        $update->bind_param("is",$rooms, $roomtype);
        $update->execute();
        $update->close();

    } else {
        echo "<p style='color:red;'>❌ Error inserting into database: " . $stmt->error . "</p>";
        exit;
    }
        // ✅ Insert into bookings history (for "My Bookings")
    // session_start(); // ensure session is started at top of file
    // if (isset($_SESSION['user_id'])) {
    //     $user_id = $_SESSION['user_id'];

    //     $stmt2 = $conn->prepare("INSERT INTO bookings (user_id, name, email, roomtype, noofdays, amount, checkin, status) 
    //                              VALUES (?, ?, ?, ?, ?, ?, ?, 'booked')");
    //     $stmt2->bind_param("isssids", $user_id, $name, $email, $roomtype, $days, $amount, $checkin);
    //     $stmt2->execute();
    //     $stmt2->close();
    // }


    $stmt->close();
    $conn->close();

    // ✅ Bill HTML for Email
    $bill = "
    <h2>🌟 HOTEL AMIL</h2>
    <strong>Bill ID:</strong> $bill_id<br>
    <strong>Date:</strong> $date<br><br>
    <strong>Guest Name:</strong> $name<br>
    <strong>Email:</strong> $email<br><br>
    <table border='1' cellpadding='10' cellspacing='0'>
        <tr><th>Detail</th><th>Information</th></tr>
        <tr><td>Date of Birth</td><td>$dob</td></tr>
        <tr><td>Check-in</td><td>$checkin</td></tr>
        <tr><td>Room Type</td><td>$roomtype</td></tr>
        <tr><td>Days Staying</td><td>$days</td></tr>
        <tr><td><strong>Total Amount</strong></td><td><strong>₹$amount</strong></td></tr>
    </table>
    <p>Thank you for choosing HOTEL AMIL!</p>
    ";

    // ✅ Send Email Invoice
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '71762305020@cit.edu.in'; // ✅ change to your mail
        $mail->Password = 'tcuc uury eben uesg';    // ✅ app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('71762305020@cit.edu.in', 'Hotel Amil');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Hotel Amil Booking Invoice';
        $mail->Body    = $bill;
        $mail->send();
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Email not sent. Mailer Error: {$mail->ErrorInfo}</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Invoice</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; padding: 30px; }
        .invoice-box { max-width: 800px; margin: auto; background: white; padding: 30px; border: 1px solid #eee; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.15); line-height: 24px; color: #555; }
        .invoice-box h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .top-section { display: flex; justify-content: space-between; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        .total-row td { font-weight: bold; font-size: 16px; }
        .download-btn { margin-top: 20px; display: block; width: 100%; padding: 12px; background-color: darkblue; color: white; border: none; border-radius: 6px; text-align: center; font-size: 16px; font-weight: bold; cursor: pointer; }
        .footer-note { margin-top: 30px; font-size: 12px; text-align: center; color: gray; }
    </style>
</head>
<body>

<div class="invoice-box" id="bill-content">
    <h2>🌟 HOTEL AMIL</h2>
    <div class="top-section">
        <div>
            <strong>Bill ID:</strong> <?= $bill_id ?><br>
            <strong>Date:</strong> <?= $date ?>
        </div>
        <div>
            <strong>Guest Name:</strong> <?= $name ?><br>
        
            <strong>Email:</strong> <?= $email ?>
        </div>
    </div>

    <table>
        <tr><th>Details</th><th>Information</th></tr>
        <tr><td>Date of Birth</td><td><?= $dob ?></td></tr>
        <tr><td>Check-in</td><td><?= $checkin ?></td></tr>
        <tr><td>Room Type</td><td><?= $roomtype ?></td></tr>
        <tr><td>Days Staying</td><td><?= $days ?></td></tr>
        <tr class="total-row"><td>Total Amount</td><td>₹<?= $amount ?></td></tr>
    </table>

    <div class="footer-note">
        Thank you for choosing HOTEL AMIL!!Room booked successfully.
    </div>
</div>

<button class="download-btn" onclick="downloadBill()">Download Bill (PDF)</button>

<script>
    function downloadBill() {
        const content = document.getElementById("bill-content").innerHTML;
        const WinPrint = window.open('', '', 'width=800,height=650');
        WinPrint.document.write('<html><head><title>Invoice</title>');
        WinPrint.document.write('<style>body{font-family:Arial;} table{width:100%; border-collapse:collapse;} td, th{border:1px solid #000; padding:10px;}</style>');
        WinPrint.document.write('</head><body>');
        WinPrint.document.write(content);
        WinPrint.document.write('</body></html>');
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>

</body>
</html>
