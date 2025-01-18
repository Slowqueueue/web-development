<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

    if (isset($_COOKIE['user'])) {
	if ($_COOKIE['user'] == 'SUS') {
	echo "AMOGUS DING DING DING DING DING DING DING TODODO TODODO";
	$myAudioFile = "amogus.wav";
	echo '<audio autoplay="true" style="display:none;">
		<source src="'.$myAudioFile.'" type="audio/wav">
	    </audio>';
	}
	else { echo "Здравствуй, ".$_COOKIE['user']."!";}
		echo "<br/> В прошлый раз заявляли об ошибке: ".$_COOKIE['date'];
		if (isset($_COOKIE['error1']) || isset($_COOKIE['error2']) || isset($_COOKIE['error3']) || isset($_COOKIE['error4'])){
		echo "<br/> Последние заявленные ошибки: ".$_COOKIE['error1']." ".$_COOKIE['error2']." ".$_COOKIE['error3']." ".$_COOKIE['error4'];
		} else {echo "<br/> Ошибка не была выбрана";}
	}
	else { echo "Здравствуйте, первый раз здесь?";}
?>
<form Action = "cookie.php" METHOD=POST>
	Введите имя:
	<input type = "text" name = "name"><br/>
	<br/> Выберите ошибку: <br/>
	<input type = "checkbox" name = "checkbox1" value = "Замечание">Замечание <br/>
	<input type = "checkbox" name = "checkbox2" value = "Предупреждение">Предупреждение <br/>
	<input type = "checkbox" name = "checkbox3" value = "Ошибка">Ошибка <br/>
	<input type = "checkbox" name = "checkbox4" value = "Фатальная ошибка">Фатальная ошибка <br/>
	<br/>
	<Input type = "submit"  value = "Подтвердить">
	<input type="reset" value="Сброс">
	<a href="http://217.71.139.74/~user220/">
	<input type="button" value="Назад" />
	</a>
</form>