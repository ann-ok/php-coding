<html>
    <head>
        <title>PHP это легко</title>
    </head>
    <body>
        <div>
            <?php
			$hello = "Привет";
			echo $hello;
			?>
        </div>
        <div>
            <?php
			$browserInfo = $_SERVER['HTTP_USER_AGENT'];
			echo "Твой браузер: ".$browserInfo;
			# strpos() ищет одну строку в другой
			if (strpos($browserInfo, 'MSIE') !== false)
			{
				echo "Бе";
			}
			elseif (strpos($browserInfo, 'Mozilla') !== false)
			{
				echo  " Вот это ты красавчик!";
			}
			else
			{
				echo "Ну такое";
			}
            ?>
        </div>
		<div>
			<?= "Возьму и выведу название сервера: ".$_SERVER['SERVER_NAME']; ?>
		</div>
		<div>
			<form action="hello.php" method="post">
				<p>Ваше имя: <input type="text" name="name" /></p>
				<p>Ваш возраст: <input type="number" name="age" /></p>
				<p><input type="submit" /></p>
			</form>
		</div>
		<?php
		$hello = "Var 1";
		$bye = $hello;
		$hello = "Var 2";
		echo $hello;
		echo $bye;
		?>
		<div>
			<a href="create-user.php">Тык для добавления пользователя</a>
		</div>
    </body>
</html>
