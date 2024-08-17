<?php
// Start session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the library.php page
header("Location: library.php");
exit();
?>
