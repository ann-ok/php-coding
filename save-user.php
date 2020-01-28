<?php
$msg = '';
#Сохранение значений, если данные не запишутся в базу
$first_name = htmlspecialchars($_REQUEST['first_name']);
$last_name = htmlspecialchars($_REQUEST['last_name']);
$email = htmlspecialchars($_REQUEST['email']);
#Сохранение пользователя
$save = false;
$response = $_POST['g-recaptcha-response'];
if (!isset($response) || $response == '') {
	$msg .= "Заполните капчу\n";
} else {
	#Проверка капчи
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$secret = '6LefubYUAAAAAChQFatC1X4ieNyehF-PCCanehhR';
	$query = $url . '?secret=' . $secret . '&response='
		. $_POST['g-recaptcha-response'] . '&remmotip=' . $_SERVER['REMOTE_ADDR'];
	$data = json_decode(file_get_contents($query));
	if ($data->success != true) {
		$msg .= "Капча введена неверно";
	} else {
		$save = true;
	}
}
if ($_POST['password'] != 'test') {
	$msg .= "Введен неправильный пароль\n";
} elseif ($save) {
	#Работа с файлом
	$filePath = $_FILES['avatar']['tmp_name'];
	$fi = finfo_open(FILEINFO_MIME_TYPE); #Создадим ресурс FileInfo
	$mime = (string) finfo_file($fi, $filePath); #Получим MIME-тип
	if (strpos($mime, 'image') === false) {
		die('Можно загружать только изображения.');
	}
	$avatar = null;
	$uploaddir = 'uploads/';
	$uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
	if (move_uploaded_file($filePath, $uploadfile)) {
		$msg .= "Файл корректен и был успешно загружен.\n";
		$avatar = $uploadfile;
	} else {
		$msg .= "Файл не загружен. Ошибка: \n" . $_FILES['avatar']['error'];
	}
	#Запись в БД
	#real_escape_string экранирует строку
	$first_name = $mysqli->real_escape_string($_POST['first_name']);
	$last_name = $mysqli->real_escape_string($_POST['last_name']);
	$email = $mysqli->real_escape_string($_POST['email']);
	if ($mysqli->query("INSERT INTO persons (first_name, last_name, email, avatar) 
			VALUES ('$first_name', '$last_name', '$email', '$avatar')") === true) {
		$msg .= "Запись добавлена успешно\n";
	} else {
		$msg .= "Ошибка: " . mysqli_error(($mysqli)) . "\n";
	}
}
if ($msg != '') {
	echo $msg;
}