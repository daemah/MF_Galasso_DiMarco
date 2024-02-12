<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$codice_commento = $_GET["codiceCommento"];
    print_r($codice_commento);
    $email = $_SESSION["email"];
    print_r($email);
    $gradimento = $_GET["valutazione"];
    print_r($gradimento);
    $utente = $_GET["utente"];
    print_r($utente);

	$ris = insertIndGradimento($cid, $codice_commento, $email, $gradimento, $utente);
/*
	if ($ris["status"]=='ok')
	{
		header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
	}
*/
?>