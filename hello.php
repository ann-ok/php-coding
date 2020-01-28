<div>
	<?php
	#strip_tags удаляет специальные символы
	#htmlspecialchars переведет специальные символы в юникод
	echo "Здравствуйте, ".htmlspecialchars($_POST['name']);?>
</div>
<div>
	<?php echo "Вам ".$_POST['age']." лет";?>
</div>
<div>
	<?= "Отлавливаем переменные на POST запросе";?>
</div>

