<?php
session_start();
session_unset();   // remove all session variables
session_destroy(); // destroy the session

// Redirect with message
echo "<script>alert('✅ You have been logged out successfully.'); 
      window.location='login.php';</script>";
exit;
?>
