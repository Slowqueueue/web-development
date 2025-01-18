<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['userlogin']))
header('Location: http://217.71.139.74/~user220/db.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Авторизация в базу данных</title>
</head>
<body BGCOLOR="#CCCCFF" TEXT="#0000FF" LEFTMARGIN="3" LINK="#000000" VLINK="#000000" align = center>

<form name="test" method="post" action="bdvhod.php">
<p>Пожалуйста, авторизуйтесь<p>
<input type="text" id="login" name="login" size="20" placeholder = "Логин">
<br>
<input type="password" id="password" name="password" size="20" placeholder = "Пароль">
<br>

<?php
$login1=$_POST['login'];
$password1=$_POST['password'];
if($login1=="login" && $password1=="9999") {
$_SESSION['userlogin'] = $login1;
header('Location: http://217.71.139.74/~user220/db.php');
}
if($login1!="" || $password1!="") echo "Неверный логин или пароль";
?>

<p><input type="submit" value="Отправить">
<input type="reset" value="Очистить">
</form>
<a href="http://217.71.139.74/~user220/dbguest.php">
<input type="button" value="Я гость"/></a>
<a href="http://217.71.139.74/~user220/">
<input type="button" value="Назад"/></a>
</body>
</html>
