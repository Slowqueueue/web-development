<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript</title>
    <!-- Скрипт для предотвращения повторной отправки формы -->
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script defer src=myscript.js></script>
</head>

<body BGCOLOR="#FFFFFF" TEXT="#000000">

</head><body><center><h1  style="color:#000000;">Заполните следующую форму:</h1></center>
<center><font size="3"color="red"><div id = "error"></div></font></center>
<form method="post" id='form' action="data.php">

<p>Оставьте свой след в истории:</p>
<textarea name="str" id="str" rows="7" cols="50"></textarea>

<p>Выберите ваше тотемное животное:</p>
<div>  
<input type="radio" id="Choice1" name="ch" value="Олень">   
<label for="Choice1">Олень</label><br>
<input type="radio" id="Choice2" name="ch" value="Жаба">
<label for="Choice2">Жаба</label><br>
<input type="radio" id="Choice3" name="ch" value="Еж">
<label for="Choice3">Еж</label><br>
<input type="radio" id="Choice4" name="ch" value="Бобер">
<label for="Choice4">Бобер</label><br>
<input type="radio" id="Choice5" name="ch" value="Другое">
<label for="Choice5">Другое</label><br>
</div>  
<p>Выберите желаемый шрифт:</p>
  <div>   
    <p><input type="checkbox" name="style" value="Comic sans MS"> Comic sans MS</p>
    <p><input type="checkbox" name="style" value="Times New Roman"> Times New Roman</p>
    <p><input type="checkbox" name="style" value="Verdana"> Verdana  </p>
  </div>

<input type="submit" name="submit" value="Отправить" >  
<input type="reset" value="Очистить" >
<a href="http://217.71.139.74/~user220">
<input type="button" value="Назад" />
</a>

</form>
</body>
</html>
