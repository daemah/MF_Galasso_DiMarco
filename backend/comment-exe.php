<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$commento = $_POST["commento"];
    print_r($commento);
    $email = $_SESSION["email"];
    print_r($email);
    $codice = 'jkshfdkjsafh';
    print_r($codice);

	$ris = insertComment($cid, $email, $codice, $commento);

	if ($ris["status"]=='ok')
	{
		header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
	}

?>