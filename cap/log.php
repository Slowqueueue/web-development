<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Записи:</title>
</head>
<body BGCOLOR="#FFFFFF" TEXT="000000">
    <h1>Журнал записей</h1>
    <?php
    // Читаем содержимое файла с уведомлениями
    $fileContent = file_get_contents('logs.txt');
    echo "<pre>$fileContent</pre>";
    ?>
<a href="http://217.71.139.74/~user220/cap/cap.php">
<input type="button" value="Назад" />
</a>

</body>
</html>
