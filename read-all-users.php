<?php
$msg = "";
#Вывод всех пользователей
if ($result = $mysqli->query("SELECT * FROM persons")) {
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<caption>Список пользователей</caption>";
		echo "<tr>";
		echo "<th>Имя</th>";
		echo "<th>Фамилия</th>";
		echo "<th>Email</th>";
		echo "<th>Аватар</th>";
		echo "</tr>";
		while ($row = $result->fetch_array())
		{
			echo "<tr>";
			echo "<td>" . $row['first_name'] . "</td>";
			echo "<td>" . $row['last_name'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			if ($row['avatar'] != null)
			{
				$avatar = $row['avatar'];
				echo "<td>" . "<img style='width: 50px; height: 50px' src='$avatar' alt=''>". "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	} else {
		$msg .= "Пользователей ещё нет.";
	}
	$result->close();
} else {
	$msg .= "Ошибка: " . mysqli_error(($mysqli)) . "\n";
}
if ($msg != '') {
	echo $msg;
}

