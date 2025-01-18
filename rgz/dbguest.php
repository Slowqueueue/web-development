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
<pcustom>
<?php
$online=True;
?>
<?php
if(array_key_exists('exitbutton', $_POST)) {
$SQL_log_exit="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'guest','Log out',0)";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_exit);
$online=False;
header ('Location: http://217.71.139.74/~user220/rgz/bdvhod.php');
}
?>
<form name="test" method="post" action="dbguest.php">
<label for="poisk">Выберите адрес капитана для поиска:<br></label>
<select name="poisk" id="poisk">
  <option value="">--Не выбрано--</option>
  <option value="Zabalueva">Zabalueva</option>
  <option value="Lenina">Lenina</option>
  <option value="Ostrovskogo">Ostrovskogo</option>
  <option value="Galickogo">Galickogo</option>
</select>
<p><input type="submit" value="Искать"/>
<a href="http://217.71.139.74/~user220/rgz/dbguest.php">
<input type="button" value="Просмотреть всю таблицу"/></a>
<input type="submit" name="exitbutton" class="button"  value="Выйти"/>
</p>
</form>
</pcustom>
<br>
<?php
$poisk1=$_POST['poisk'];
$SQL="SELECT captains.id,name,team,address from captains INNER JOIN cap_address ON captains.address_id=cap_address.id";
if($online == True){
if($_POST['poisk'] != "") {$SQL.=" WHERE address='$poisk1'";}
}
$SQL.=" ORDER BY captains.id;";
if($online == True){
if($_POST['poisk'] != "") {$SQL_log_search="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'guest','Search, $poisk1',0);";}
}
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
if($online == True){
if($_POST['poisk'] != "") {
$result=mysqli_query($mysqli, $SQL_log_search);
}
}

$result=mysqli_query($mysqli, $SQL);
$nf=mysqli_field_count($mysqli);
echo "<table border=1>";
$fields=mysqli_fetch_fields($result);
  foreach ($fields as $value)
      {
              echo "<th>".$value->name."<br> ";
    }
while ($row=mysqli_fetch_row($result))
{
    echo "<tr>";
    for ($i=0; $i<$nf; $i++)
    {
        echo "<td>".$row[$i]."</td>"; //<td>".$row[1]."</td>";
    }
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