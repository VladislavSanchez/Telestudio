<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password'] . "zlf2hu3i6fzsl41h6lsele");
$status = "не задан";

$user = "v78104_t-sut_use";
$pass= "12345t-sut#-";
$bd = "v78104_t-sut";

$connect = mysqli_connect("localhost","$user", "$pass", "$bd");
if (!$connect) {
    $_SESSION['error'] = "Ошибка подключения в logout";
    header("Location: system-err.php");
    exit();
}
mysqli_set_charset($connect, "utf8mb4");
$sql = "INSERT INTO users (name, login, password, status) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $password, $status);
$res = mysqli_stmt_execute($stmt);
if (!$res) {
    $_SESSION['error'] = "Ошибка при запросе в logout";
    header("Location: system-err.php");
    exit();
} else {
    header("Location: ../admin/registration.html");
}
?>