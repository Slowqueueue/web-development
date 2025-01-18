<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['userlogin'])) header('Location: http://217.71.139.74/~user220/rgz/bdvhod.php');
else{
$username=$_SESSION['userlogin'];
$id = $_GET['id'];

$SQL_request_delete="SELECT * FROM `captains` WHERE `id` = $id;";
    $mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_request_delete);
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
$SQL_log_delete="INSERT INTO log(time,user,operation,id_used) VALUES(NOW(),'$username','Delete(legacy:$legacy_name,$legacy_team,$legacy_addr)',$id);";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL_log_delete);


$SQL="DELETE FROM captains WHERE captains.id=$id";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL);


header ('Location: http://217.71.139.74/~user220/rgz/db.php');
}
?>
