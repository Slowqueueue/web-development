<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['userlogin'])) header('Location: http://217.71.139.74/~user220/bdvhod.php');
else{
$id = $_GET['id'];
$SQL="DELETE FROM captains WHERE captains.id=$id";
$mysqli = mysqli_connect('localhost', 'user220','gun_fedora_user_220','user220');
if (!$mysqli) { echo "Can't connect to database!"; exit;}
@$db=mysqli_select_db($mysqli, "user220");
if (!$db) { echo "Can't change database!"; exit;}
$result=mysqli_query($mysqli, $SQL);
header ('Location: http://217.71.139.74/~user220/db.php');
}
?>
