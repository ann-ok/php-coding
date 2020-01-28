<html>
	<head>
		<title>PHP это не легко</title>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<form action="" enctype="multipart/form-data" method="post">
			<fieldset>
				<article>Введите информацию:</article>
				<p>
					<label for="firstName">Имя:</label>
					<input required type="text" name="first_name" value="<?=$first_name?>">
				</p>
				<p>
					<label for="lastName">Фамилия:</label>
					<input required type="text" name="last_name" value="<?=$last_name?>">
				</p>
				<p>
					<label for="emailAddress">Email:</label>
					<input required type="email" name="email" value="<?=$email?>">
				</p>
				<p>
					<label for="password">Пароль:</label>
					<input required type="password" name="password">
				</p>
				<p>
					<label for="avatar">Аватар:</label>
					<p><input type="file" name="avatar"></p>
				</p>
				<div class="g-recaptcha" data-sitekey="6LefubYUAAAAAE92YdQW-ibPz7rfoK0edcJPPKHT"></div>
				<input type="submit" name="submit" value="Отправить">
			</fieldset>
		</form>
	</body>
</html>

<?php
#Подключение к БД
$mysqli = new mysqli("learning.localhost", "root", "", "test");
if ($mysqli->connect_errno) {
	echo  "Не удалось подключиться: %s\n".$mysqli->connect_error;
	exit(); //что это делает?
}
$mysqli->set_charset("utf8"); //Почему без этого не работает?

if(!isset($_POST['submit'])){
	$first_name = '';
	$last_name = '';
	$email = '';
}
else {
	include "save-user.php";
}

include "read-all-users.php";

$mysqli->close();
?>

