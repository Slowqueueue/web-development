<html><head><META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Журнал записей на экскурсии</title></head><body>
<h1>Журнал записей на экскурсии</h1>
<?php
$date=date('d.m.Y');
//формирование строки
$checkbox1 = $_POST['checkbox1'];
$checkbox2 = $_POST['checkbox2'];
$checkbox3 = $_POST['checkbox3'];

$string = $date."\t".$checkbox1." ".$checkbox2." ".$checkbox3."\t".$_POST["list"]."\n";
//открытие файла для записи строки
  $file = fopen("labfiles.txt", "a");
  if (!$file)
  {
    echo "Ошибка записи в файл";
    exit;
  }
  if (isset($checkbox1) || isset($checkbox2) || isset($checkbox3)) {
  fwrite($file, $string);
  fwrite($file, "<br/>");
  }
  fclose($file);
//Чтение с файла
  $file = fopen("labfiles.txt", "r");
  if (!$file)
  {
    echo "Ошибка чтения файла";
    exit;
  }
  while(!feof($file))
  {
  $string=fgets($file, 100);
  echo $string;
  }
  fclose($file);
?>
	<a href="http://217.71.139.74/~user220/files.html">
	<input type="button" value="Назад"/>
	</a>
