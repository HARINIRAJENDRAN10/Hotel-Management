<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "1234", "haripro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM project WHERE status='cancelled'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cancelled Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            text-align: center;
        }
        h2 {
            margin-top: 30px;
            color: #dc3545;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #dc3545;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .back-btn {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Cancelled Bookings</h2>
    <a href="adminpanel.php" class="back-btn">⬅ Back to Admin Panel</a>

    <table>
        <tr>
            <th>Bill ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Check-In</th>
            <th>No. of Days</th>
            <th>Room Type</th>
            <th>Amount</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['bill_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['checkin'] ?></td>
                <td><?= $row['noofdays'] ?></td>
                <td><?= $row['roomtype'] ?></td>
                <td>₹<?= $row['amount'] ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No cancelled bookings found.</td></tr>
            <script>
                setTimeout(() => { window.location.href = 'adminpanel.php'; }, 3000);
            </script>
        <?php endif; ?>
    </table>
</body>
</html>
