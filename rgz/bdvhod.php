<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {

$username = $_SESSION['userlogin'];
$SQL_log_kicked="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Kicked, Session has expired',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_kicked);
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['userlogin']))
header('Location: http://217.71.139.74/~user220/rgz/db.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Авторизация в базу данных</title>
</head>
<body BGCOLOR="#CCCCFF" TEXT="#0000FF" LEFTMARGIN="3" LINK="#000000" VLINK="#000000" align = center>

<?php
if(array_key_exists('guestbutton', $_POST)) {
$SQL_log_guest="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'guest','Log in',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_guest);	

$SQL_request_count="SELECT * FROM hist WHERE login = 'guest';";
$result=mysqli_query($mysqli, $SQL_request_count);
$row=mysqli_fetch_assoc($result);
$g_count=$row["count"];
$g_count=$g_count + 1;
$SQL_update_count="UPDATE hist SET count=$g_count WHERE login = 'guest';";
$result=mysqli_query($mysqli, $SQL_update_count);
header ('Location: http://217.71.139.74/~user220/rgz/dbguest.php');
}
?>

<form name="test" method="post" action="bdvhod.php">
<p>Пожалуйста, авторизуйтесь<p>
<input type="text" id="login" name="login" size="20" placeholder = "Логин">
<br>
<input type="password" id="password" name="password" size="20" placeholder = "Пароль">
<br>

<?php
$login1=$_POST['login'];
$password1=$_POST['password'];
if(($login1=="admin" && $password1=="9999") || ($login1=="operator" && $password1=="1234")) {
$_SESSION['userlogin'] = $login1;

$SQL_log_author="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$login1','Log in',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_author);

$SQL_request_auth="SELECT * FROM hist WHERE login = '$login1';";
$result=mysqli_query($mysqli, $SQL_request_auth);
$row=mysqli_fetch_assoc($result);
$auth_count=$row["count"];
$auth_count=$auth_count + 1;
$SQL_update_auth="UPDATE hist SET count=$auth_count WHERE login = '$login1';";
$result=mysqli_query($mysqli, $SQL_update_auth);

header('Location: http://217.71.139.74/~user220/rgz/db.php');
}
if($login1!="" || $password1!="") echo "Неверный логин или пароль";
?>

<p><input type="submit" value="Отправить">
<input type="reset" value="Очистить">
<br><br>
<input type="submit" name="guestbutton" class="button"  value="Я гость"/>
<a href="http://217.71.139.74/~user220/">
<input type="button" value="Назад"/></a>
</form>
</body>
</html>
