<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$email = $_POST["email"];
$pwd = $_POST["pass"];
$nickname = $_POST["nickname"];

$ris = signIn($cid,$email,$pwd, $nickname);
if ($ris["status"]=='ko')
{
	session_destroy();
	header('location: ../frontend/signin.php?status=ko&msg='. urlencode($ris["msg"]));
}else{
	$_SESSION["utente"]=$login;
	$_SESSION["logged"]=true;
	$_SESSION["email"] = $email;
	header('location: ../frontend/login.php?status=ok&msg='. urlencode($ris["msg"]));
}
/*
$ris1=leggiUtente($cid);

if ($ris1["status"]=='ko')
{
	header('location: ../index.php?status=ko&msg='. urlencode($ris1["msg"]));

}else{
	$ris2= signIn($cid,$email,$pwd);
	
	if ($ris2["status"]=='ok')
	{
		header("location: ../index.php?status=ok&msg=" . urlencode($ris2["msg"]));
	}
	else
	{	header('location: ../index.php?status=ko&msg='.  urlencode($ris1["msg"].$ris2["msg"]));}
}   
*/	
?>


