<?php
session_start();
if (!empty($_SESSION['user_name'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="google-site-verification" content="k04bnV8xsskKtuCyu8tpmw2XBFMQUgYNuBYbHY2VUcE" />
    <title>Авторизация | Телестудия СЮТ</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <main>
        <form class="authorization" action="php-handlers/login.php" method="post">
            <img class="authorization__logo" src="../img/logo.svg" width="30%" alt="logo">
            <div class="authorization__input-container">
                <label><input class="authorization__email-input<?php if(!empty($_SESSION['acess_denied'])) {echo " authorization__email-input--failed";}?>" name="email" type="email" maxlength="30" required placeholder="Эл. почта"></label>
                <label><input class="authorization__password-input<?php if(!empty($_SESSION['acess_denied'])) {echo " authorization__password-input--failed";}?>" name="password" type="password"  maxlength="20" required placeholder="Пароль"></label>
            </div>
            <input class="authorization__submit-input" type="submit" value="Вход">
        </form>
    </main>
</body>
</html>
<?php session_destroy(); ?>