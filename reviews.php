<?php
include('header.html');
$conn = new mysqli("localhost", "root", "1234", "haripro");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? 'Anonymous';
    $rating = $_POST['rating'] ?? 5;
    $comment = $_POST['comment'] ?? '';

    $stmt = $conn->prepare("INSERT INTO feedback (name, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $rating, $comment);
    $stmt->execute();
}
?>

<div class="section-container reviews">
  <h2 class="section-title">Guest Feedback</h2>

  <!-- Rating Form -->
  <form method="POST" style="text-align:center;margin-bottom:30px;">
    <label for="rating">Rate your stay:</label><br>
    
    <select name="rating" style="font-size: 1.5rem; padding: 5px;">
      <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
      <option value="4">⭐️⭐️⭐️⭐️</option>
      <option value="3">⭐️⭐️⭐️</option>
      <option value="2">⭐️⭐️</option>
      <option value="1">⭐️</option>
    </select><br>

    <input type="text" name="name" placeholder="Your name" style="margin-top:10px;padding:10px;border-radius:8px;" required><br>
    
    <textarea name="comment" rows="4" cols="50" placeholder="Share your experience..." style="margin-top:15px;padding:10px;border-radius:8px;" required></textarea><br>

    <button style="margin-top:15px;padding:10px 20px;border:none;background:#6200ea;color:#fff;border-radius:6px;">Submit</button>
  </form>

  <!-- Past Reviews -->
  <div class="review-list" style="max-width:800px;margin:auto;">
    <?php
    $res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
    while ($row = $res->fetch_assoc()) {
        echo '<div class="review-item" style="background:#f8f8f8;padding:15px;margin-bottom:20px;border-radius:10px;">';
        echo '<p>' . str_repeat("⭐️", $row['rating']) . '</p>';
        echo '<p>"' . htmlspecialchars($row['comment']) . '"</p>';
        echo '<small>- ' . htmlspecialchars($row['name']) . '</small>';
        echo '</div>';
    }
    ?>
  </div>
</div>

<?php include('footer.html'); ?>
