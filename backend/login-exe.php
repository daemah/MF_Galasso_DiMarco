<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$email = $_POST["email"];
	$pwd = $_POST["pass"];

	$ris = isUser($cid,$email,$pwd);

	if ($ris["status"]=='ko')
	{
		session_destroy();
		header('location: ../frontend/login.php?status=ko&msg='. urlencode($ris["msg"]));
	}
	else
	{
		$_SESSION["utente"]=$login;
		$_SESSION["logged"]=true;
		$_SESSION["email"] = $email;
		header("location: ../frontend/post.php?status=ok&msg=". urlencode($ris["msg"]));	
	}

?>