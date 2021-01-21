<?php
session_start();
$email = $_POST['email'];
$password = md5($_POST['password'] . "zlf2hu3i6fzsl41h6lsele");

$user = "v78104_t-sut_use";
$pass= "12345t-sut#-";
$bd = "v78104_t-sut";

$connect = mysqli_connect("localhost", "$user", "$pass", "$bd");
if (!$connect) {
    $_SESSION['error'] = "Ошибка подключения в login";
    header("Location: system-err.php");
    exit();
}
mysqli_set_charset($connect, "utf8mb4");
$sql = "SELECT * FROM users WHERE login=? AND password=?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
if (!$res) {
    $_SESSION['error'] = "Ошибка при запросе в login";
    header("Location: system-err.php");
    exit();
}
$result = mysqli_fetch_assoc($res);
if (count($result) != 0) {
    $_SESSION['user_name'] = $result['name'];
    $_SESSION['user_login'] = $result['login'];
    $_SESSION['user_status'] = $result['status'];
    $sql = "SELECT SUM(points) FROM points WHERE name=?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 's', $result['name']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        $_SESSION['error'] = "Ошибка при запросе в login-2";
        header("Location: system-err.php");
        exit();
    }
    $result = mysqli_fetch_assoc($result);
    $_SESSION['user_points'] = $result['SUM(points)'];
    if (empty($_SESSION['user_points'])) {
        $_SESSION['user_points'] = "0";
    }
    header("Location: ../index.php");
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
    exit();
} else {
    $_SESSION['acess_denied'] = "acess_denied";
    header("Location: ../authorization.php");
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
    exit();
}
mysqli_stmt_close($stmt);
mysqli_close($connect);
?>