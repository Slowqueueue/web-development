<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['userlogin'])) header('Location: http://217.71.139.74/~user220/rgz/bdvhod.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Журнал</title>
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
<?php
if(array_key_exists('clearbutton', $_POST)) {
$SQL_log_clear="TRUNCATE TABLE log;";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_clear);
}
if(array_key_exists('clearcountbutton', $_POST)) {
$SQL_count_clear="UPDATE hist SET count=0;";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_count_clear);
}
?>
<h1>Журнал базы данных Игра</h1>
<form name="test" method="post" action="log.php">
<p>
<a href="http://217.71.139.74/~user220/rgz/db.php">
<input type="button" value="Выйти"/></a>
<input type="submit" name="clearbutton" class="button"  value="Очистить журнал"/>
<input type="submit" name="clearcountbutton" class="button"  value="Очистить счетчик посещений"/>
</p>
</form>
<?php
$SQL="SELECT * FROM log;";
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
while ($row=mysqli_fetch_row($result))
{
    echo "<tr>";
    for ($i=0; $i<$nf; $i++)
    {
if ($row[$i] != 0)
        echo "<td>".$row[$i]."</td>"; //<td>".$row[1]."</td>";
    }
    echo "</tr>";
}
echo "</table>";
$nr=mysqli_num_rows($result);
//$nf=mysqli_num_fields($result);
echo "Найдено записей: ";
echo $nr;

echo "<br>";
echo "<br>";

$SQL_hist = "SELECT * FROM hist";
$result=mysqli_query($mysqli, $SQL_hist);
$nf=mysqli_field_count($mysqli);
$fields=mysqli_fetch_fields($result);
$index = 0;
while ($row=mysqli_fetch_row($result))
{
    $index = $index + 1;
    for ($i=0; $i<$nf; $i++)
    {
        if (($i == ($nf-1)) && $index == 1)
        $admin_count=$row[$i];
        if (($i == ($nf-1)) && $index == 2)
$operator_count=$row[$i];
if (($i == ($nf-1)) && $index == 3)
        $guest_count=$row[$i];
    }
}

 $arr = array (
  'Посещений админа:'=>$admin_count,
  'Посещений оператора:'=>$operator_count,
  'Посещений гостя'=>$guest_count
 );
 require_once('hist.php');
 $plot = new hist($arr);
 $plot->show();

?>

</body>
</html>
