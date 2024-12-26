<?php
session_start();
unset($_SESSION['loggedIn']);
unset($_SESSION['id']);
unset($_SESSION['name']);

header("Location: /inventory/login.php");
exit;
?>
