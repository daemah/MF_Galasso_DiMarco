<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$commento = $_POST["commento"];
    print_r($commento);
    $email = $_SESSION["email"];
    print_r($email);
    $codice = generateCode();
    print_r($codice);
    $utente = $_GET["utente"];
    print_r($utente);
    $codice_testo = getCodiceTesto($cid, $utente)[0];
    print_r($codice_foto);
    

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