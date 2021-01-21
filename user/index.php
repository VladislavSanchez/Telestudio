<?php
session_start();

if (empty($_SESSION['user_name'])) {
    header("Location: authorization.php");
    exit();
} elseif ($_SESSION['user_name'] != "Владислав Казаков") {
   $_SESSION['error'] = "Технические работы";
   header("Location: php-handlers/system-err.php");
   exit();
}

$user = "v78104_t-sut_use";
$pass= "12345t-sut#-";
$bd = "v78104_t-sut";

$connect = mysqli_connect("localhost" ,"$user", "$pass", "$bd");
if (!$connect) {
    $_SESSION['error'] = "Ошибка подключения в index";
    header("Location: php-handlers/system-err.php");
    exit();
}
mysqli_set_charset($connect, "utf8mb4");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Рейтинг | Телестудия СЮТ</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<header>
		<nav>
			<ul class="menu">
				<li class="menu__item">
					<img class="menu__logo" src="../img/logo.svg" width="20%" alt="logo">
				</li>
				<li class="menu__item">
					<a class="menu__title">Рейтинг</a>
				</li>
				<li class="menu__item">
					<div class="menu__user">
					<p class="menu__user-name menu__user-name-marker--close"><?php echo $_SESSION['user_name']; ?></p>
					   <ul class="menu__about-user-progress">
						   <li class="menu__about-user-item"><h2><?php echo $_SESSION['user_name']; ?></h2></li>
						   <li class="menu__about-user-item"><p>Статус: <?php echo $_SESSION['user_status']; ?></p></li>
                           <li class="menu__about-user-item"><p>Всего баллов: <?php echo $_SESSION['user_points']; ?></p></li>
						   <li class="menu__about-user-item">
							   <a  class="menu__about-user-link" href="php-handlers/logout.php">Выход</a>
							   <button class="menu__button">Закрыть</button>
						   </li>
					   </ul>
				   </div>
				</li>
			</ul>
		</nav>
	</header>
    <main>
		<section>
			<table class="rating">
                <?php
                $date = date('m-y');
                $sql = "SELECT name, month, points FROM points WHERE month=? ORDER BY points DESC";
                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, 's', $date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_close($connect);
                if (!$result) {
                    $_SESSION['error'] = "Ошибка при запросе в index";
                    header("Location: php-handlers/system-err.php");
                    exit();
                }
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $width = $row['points'] / 100;
                    echo '<tr class="rating__item">
					          <td class="rating__name">' . $row["name"] . '</td>
				           	  <td class="rating__scale-conteiner"><p class="rating__scale" style="width: ' . $width . '%">' . $row["points"] . '</p></td>
				          </tr>';
				          $check = 1;
                }
		       echo	"</table>";
		       if (empty($check)) {
		           echo '<h2 class="nodata">Ууупс! Нет данных</h2>';
		       }
	    ?>
		</section>
	</main>
	<?php
	if (!empty($check)) {
	    echo
	    '<footer class="footer">
		    <ul class="footer__list">
		        <li class="footer__list-item"><a class="footer__link" href="https://vk.com/vlad12345g" target="_blanck">Разработчик</a></li>
		        <li class="footer__list-item"><a class="footer__link" href="mailto:telestudiasut@gmail.com">Сообщить об ошибке</a></li>
		        <li class="footer__list-item"><a class="footer__link"><s>Будущие обновления</s></a></li>
		    </ul>
    	</footer>'
    	;} 
    	?>
<script src="../js/aboutUser.js"></script>
</body>
</html>