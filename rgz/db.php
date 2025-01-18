<?php
$online=True;
?>
<?php
session_start();
$username = $_SESSION['userlogin'];
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {

$SQL_log_kicked="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Kicked, Session has expired',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_kicked);
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['userlogin']))
header('Location: http://217.71.139.74/~user220/rgz/bdvhod.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>База данных</title>
<style>
   pcustom {
    border-width: 3px;
    position: relative;
    text-align: center;
      border-style: double;
      display: table;
    border-color: #808080;
    padding: 10px;
   }

</style>
</head>
<body BGCOLOR="#CCCCFF" TEXT="#0000FF" LEFTMARGIN="3" LINK="#000000" VLINK="#000000">
<center>
<h1>База данных Игра (Капитаны команд)</h1>
<?php
if(array_key_exists('exitbutton', $_POST)) {
$SQL_log_exit="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Log out',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_exit);
$online=False;
unset($_SESSION['userlogin']);
header ('Location: http://217.71.139.74/~user220/rgz/bdvhod.php');
}
?>
<pcustom>
<form name="test" method="post" action="db.php">
<label for="poisk">Выберите адрес капитана для поиска:<br></label>
<select name="poisk" id="poisk">
  <option value="">--Не выбрано--</option>
  <option value="Zabalueva">Zabalueva</option>
  <option value="Lenina">Lenina</option>
  <option value="Ostrovskogo">Ostrovskogo</option>
  <option value="Galickogo">Galickogo</option>
</select>
<p><input type="submit" value="Искать"/>
<a href="http://217.71.139.74/~user220/rgz/db.php">
<input type="button" value="Просмотреть всю таблицу"/></a>
<input type="submit" name="exitbutton" class="button"  value="Выйти"/>
</p>
<a href="http://217.71.139.74/~user220/rgz/log.php">
<input type="button" value="Журнал"/></a>
</form>
</pcustom>
<br>

<pcustom>
<p>Введите данные для добавления/изменения</p>
<form name="test" method="post" action="db.php">
<label><input type="radio" name="choice" value="Добавить запись" checked/>Добавить запись</label><br>
<label><input type="radio" name="choice" value="Изменить запись"/>Изменить запись №</label>
<input type="text" id="addid" name="addid" size="1"/>
<br>
<br>
Фамилия капитана<center> <input type="text" id="addname" name="addname" size="40"/> </center>
<br>
Название команды<center> <input type="text" id="addteam" name="addteam" size="40"/> </center>
<br>
<label for="addaddress">Выберите адрес:<br></label>
<select name="addaddress" id="addaddress">
  <option value="">--Не выбрано--</option>
  <option value="Zabalueva">Zabalueva</option>
  <option value="Lenina">Lenina</option>
  <option value="Ostrovskogo">Ostrovskogo</option>
  <option value="Galickogo">Galickogo</option>
</select>
<p><input type="submit" value="Отправить">
<input type="reset" value="Очистить"></p>
</form>
</pcustom>
<br>
<?php
$poisk1=$_POST['poisk'];
$add1=$_POST['addid'];
$add2=$_POST['addname'];
$add3=$_POST['addteam'];
$choice1=$_POST['choice'];
switch ($_POST['addaddress']) {
case "Zabalueva":
    $add4=1;
    break;
case "Lenina":
    $add4=2;
    break;
case "Ostrovskogo":
    $add4=3;
    break;
case "Galickogo":
    $add4=4;
    break;
default:
    break;
}
$SQL="SELECT captains.id,name,team,address from captains INNER JOIN cap_address ON captains.address_id=cap_address.id";
if($_POST['poisk']) {$SQL.=" WHERE address='$poisk1'";}
$SQL.=" ORDER BY captains.id";
if($_POST['addname'] && $_POST['addteam'] && $_POST['addaddress'] && $choice1=="Добавить запись") {$SQL="INSERT INTO captains(name,team,address_id) VALUES('$add2','$add3',$add4)";

$SQL_request_incr="SELECT MAX(id) FROM captains;";
$SQL_request_incr="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'user220' AND   TABLE_NAME   = 'captains';";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_request_incr);
$row = mysqli_fetch_assoc($result);
$max = $row["AUTO_INCREMENT"];
$SQL_log_insert="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Insert',$max);";
$result=mysqli_query($mysqli, $SQL_log_insert);
header ('Location: http://217.71.139.74/~user220/rgz/db.php');
}

if($_POST['addid'] && $choice1=="Изменить запись") {
    $SQL="UPDATE captains SET id=$add1 ";
    if($_POST['addname']) {$SQL.=",name='$add2' ";}
    if($_POST['addteam']) {$SQL.=",team='$add3' ";}
    if($_POST['addaddress']) {$SQL.=",address_id=$add4 ";}
    $SQL.="WHERE id=$add1";
    if ((isset($_POST['addname'])==True) || (isset($_POST['addteam'])==True) || (isset($_POST['addaddress'])==True)) {
    $SQL_request_update="SELECT * FROM `captains` WHERE `id` = '$add1';";
    $mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_request_update);
$row = mysqli_fetch_assoc($result);
$legacy_name=$row["name"];
$legacy_team=$row["team"];
switch($row["address_id"]) {
case 1:
$legacy_addr="Zabalueva";
break;
case 2:
$legacy_addr="Lenina";
break;
case 3:
$legacy_addr="Ostrovskogo";
break;
case 4:
$legacy_addr="Galickogo";
break;
default:
break;
}
    $SQL_log_update="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Update(legacy:$legacy_name,$legacy_team,$legacy_addr)',$add1);";
$result=mysqli_query($mysqli, $SQL_log_update);
header ('Location: http://217.71.139.74/~user220/rgz/db.php');
}
}
//echo $SQL;
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL);
$nf=mysqli_field_count($mysqli);
echo "<table border=1>";
$fields=mysqli_fetch_fields($result);
  foreach ($fields as $value)
      {
              echo "<th>".$value->name."<br> ";
    }
    echo "<th>"."delete"."<br> ";
while ($row=mysqli_fetch_row($result))
{
    echo "<tr>";
    for ($i=0; $i<$nf; $i++)
    {
        echo "<td>".$row[$i]."</td>"; //<td>".$row[1]."</td>";
    }
        echo "<td>"."<a href=delete.php?id=$row[0]>delete</a>"."</td>";
    echo "</tr>";
}
echo "</table>";
$nr=mysqli_num_rows($result);
//$nf=mysqli_num_fields($result);
echo "Найдено записей: ";
echo $nr;
?>
</body>
</html>