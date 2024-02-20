<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$commento = $_POST["commento"];
    $email = $_SESSION["email"];
    $codice = generateCode();
    $utente = $_GET["utente"];
    $codice_testo = getCodiceTesto($cid, $utente)[0];
    

	$ris = insertCommentTesto($cid, $email, $codice, $commento, $codice_testo, $utente);

	if ($ris["status"]=='ok')
	{
		header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
	}

?>