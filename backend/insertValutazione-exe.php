<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$codice_commento = $_GET["codiceCommento"];
    $email = $_SESSION["email"];
    $gradimento = $_GET["valutazione"];
    $utente = $_GET["utente"];

	$ris = insertIndGradimento($cid, $codice_commento, $email, $gradimento, $utente);
	
	
	if ($ris["status"]=='ok')
	{
		$ris1 = updateRispettabilità($cid, $utente);
		header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
	}
	
?>