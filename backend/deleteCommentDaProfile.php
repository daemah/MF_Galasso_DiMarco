<?php
//session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$codice = $_GET["codice"];
    print_r($codice);
    $utente=$_GET["utente"];
	$ris = deleteCommento($cid, $codice);
    print_r($ris);

	if ($ris["status"]=='ok')
	{
		header("location: ../frontend/profile.php?utente=$utente&status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/profile.php?utente=$utente&status=ko&msg=". urlencode($ris["msg"]));	
	}

?>