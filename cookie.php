<?php
$name = $_POST['name'];
$checkbox1 = $_POST['checkbox1'];
$checkbox2 = $_POST['checkbox2'];
$checkbox3 = $_POST['checkbox3'];
$checkbox4 = $_POST['checkbox4'];

SetCookie("user",$name,time()+60,"/~user220/");
SetCookie("date",date("d.m.y"),time()+60,"/~user220/");
SetCookie("error1",$checkbox1,time()+60,"/~user220/");
SetCookie("error2",$checkbox2,time()+60,"/~user220/");
SetCookie("error3",$checkbox3,time()+60,"/~user220/");
SetCookie("error4",$checkbox4,time()+60,"/~user220/");

Header("Location: index.php");
?>
