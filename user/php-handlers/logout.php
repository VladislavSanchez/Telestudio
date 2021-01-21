<?php
session_start();
unset($_SESSION['user_name']);
unset($_SESSION['user_login']);
unset($_SESSION['user_status']);
unset($_SESSION['user_points']);
unset($_SESSION['acess_denied']);
unset($_SESSION['error']);
header("Location: ../authorization.php");
?>