<?php
define("FILENAME", "file.txt");
date_default_timezone_set("Asia/Novosibirsk");
$date = date('H:i  d.m.y');

$str = '<div class="brd"><sup>'.$date.'</sup><p><font size="7" font face="'.$_POST["style"].'">'.$_POST["ch"]."</font></p>\t".$_POST["str"]."</div><br>\n";
@ $file = fopen(FILENAME,"a") or die("Невозможно открыть файл!");
flock($file, 2);
fwrite($file, $str);
flock($file, 3);
fclose($file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
   .brd {
    border: 1px double black; /* Параметры границы */
    background: #FFFFFF; /* Цвет фона */
    padding: 10px; /* Поля вокруг текста */
   }</style>
    <title>Форум</title>
</head>
<body BGCOLOR="#FFFFFF" TEXT="#000000" >
<?php echo file_get_contents('file.txt') ?>
<a href="http://217.71.139.74/~user220">
<input type="button" value="Назад" />
</a>
</body>
</html>
