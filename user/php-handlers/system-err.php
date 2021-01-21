<?php
session_start();
if (empty($_SESSION['error'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error | Телестудия СЮТ</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
<main class="error-window">
    <img class="error-window__logo" src="../../img/logo.svg" width="20%" alt="logo">
    <h1 class="error-window__title">Возникла непредвиденная ошибка</h1>
    <p class="error-window__description">Администратор сайта уже уведомлён о Вашей проблеме</p>
    <h2 class="error-window__error-message">Сообщение системы: <span class="error-window__error"><?php echo $_SESSION['error']; ?></span></h2>
</main>
</body>
</html>
<?php 
if (empty($_SESSION['user_name'])) {
    $user = $_SERVER['REMOTE_ADDR'];
} else {
    $user = $_SESSION['user_name'];
} 
mail("Telestudiasut@gmail.com", "error_t-sut.ru", "У пользователя " . $user . " произошла ошибка:\n" . $_SESSION['error'] ."");
?>