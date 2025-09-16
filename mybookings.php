<?php
session_start();
$conn = new mysqli("localhost", "root", "1234", "haripro");

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to view your bookings'); window.location='loginuser.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM bookings WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Bookings</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #d4fc79, #96e6a1);
        margin: 0;
        padding: 0;
    }
    .container {
        width: 85%;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 25px;
        font-size: 28px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 10px;
    }
    th, td {
        padding: 14px 18px;
        text-align: center;
    }
    th {
        background: #2c3e50;
        color: #fff;
        font-size: 16px;
        letter-spacing: 0.5px;
    }
    tr {
        background: #f9f9f9;
        transition: all 0.3s ease;
    }
    tr:nth-child(even) {
        background: #f1f1f1;
    }
    tr:hover {
        background: #eafaf1;
        transform: scale(1.01);
    }
    td {
        font-size: 15px;
        color: #333;
    }
    .status-booked {
        color: #28a745;
        font-weight: bold;
    }
    .status-cancelled {
        color: #dc3545;
        font-weight: bold;
    }
    .status-pending {
        color: #ffc107;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="container">
    <h2>📖 My Booking History</h2>
    <table>
        <tr>
            <th>Booking ID</th>
            <th>Room Type</th>
            <th>Check-in</th>
            <th>Days</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Booked On</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['booking_id'] ?></td>
            <td><?= htmlspecialchars($row['roomtype']) ?></td>
            <td><?= htmlspecialchars($row['checkin']) ?></td>
            <td><?= $row['noofdays'] ?></td>
            <td>₹<?= number_format($row['amount'], 2) ?></td>
            <td class="status-<?= strtolower($row['status']) ?>">
                <?= ucfirst($row['status']) ?>
            </td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
