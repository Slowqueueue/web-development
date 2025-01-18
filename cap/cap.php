<?php
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка правильности CAPTCHA
    if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha_keystring']) {
        // CAPTCHA введена правильно
        // Сохраняем данные из текстового поля
        date_default_timezone_set('Asia/Novosibirsk');
	$cap = $_SESSION['captcha_keystring'];
        $editorText = $_POST['editor'];
	$selectedDate = date("Y-m-d H:i:s");
	$text =  "$cap $selectedDate $editorText";
        $file = fopen("logs.txt", "a");
	flock($file, 2);
	 fwrite($file, $text . PHP_EOL);
	flock($file, 3);
        fclose($file);
	echo "<center>Запись добавлена!</center>";
    } elseif  (isset($_POST['captcha']) && $_POST['captcha'] != $_SESSION['captcha_keystring']){
        // CAPTCHA введена неправильно
        echo "<center>Код введен неверно!</center>";


    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Капча(Лаб3)</title>
    <script src="ckeditor/ckeditor.js"></script>
</head>
<body>
<center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" target="_self">
        <!-- Поле для ввода текста с CKEditor -->
        <textarea name="editor" id="editor"></textarea>
        <br>
        <!-- Отображение изображения CAPTCHA -->
        <p><img src="kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>"></p>
        <br>
        <!-- Поле для ввода CAPTCHA -->
        <label for="captcha">Введите код с картинки:</label>
        <input type="text" id="captcha" name="captcha">
        <br>
        <!-- Вывод сообщения об ошибке, если CAPTCHA введена неправильно -->
        <p style="color: red;"><?php echo $captchaMessage; ?></p>
        <!-- Кнопка отправки формы -->
        <p>
        <input type="submit" value="Отправить">
        <a href="log.php/">
        <input type="button" value="Журнал" /></a>
         <a href="http://217.71.139.74/~user220/">
        <input type="button" value="Назад" /></a>

        </p>
    </form>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</center>
</body>
</html>