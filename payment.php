<?php
session_start();

// If booking details are posted from checkin.php, save them in session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['booking'] = $_POST;
}

// If session booking is not set, redirect back to checkin page
if (!isset($_SESSION['booking'])) {
    header("Location: checkin.php");
    exit();
}

$booking = $_SESSION['booking'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f9; text-align:center; }
        .box { background:white; width:350px; margin:100px auto; padding:25px; 
               border-radius:10px; box-shadow:0px 0px 12px rgba(0,0,0,0.2); }
        h2 { margin-bottom: 20px; color: #333; }
        p { font-size: 16px; margin-bottom: 15px; }
        button { background:#007bff; color:white; border:none; padding:12px; width:95%; 
                 border-radius:6px; cursor:pointer; font-size:16px; font-weight:bold; }
        button:hover { background:#0056b3; }
    </style>
</head>
<body>
    <div class="box">
        <h2>💳 Secure Payment Gateway</h2>
        <p><b>Total Amount:</b> ₹<?= htmlspecialchars($booking['amount']) ?></p>
        <form action="bill.php" method="post">
            <?php foreach ($booking as $key => $value): ?>
                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
            <?php endforeach; ?>
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>
