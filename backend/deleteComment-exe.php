<?php
//session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

	$codice = $_GET["commento"];
    print_r($codice);

	$ris = deleteCommento($cid, $codice);
    print_r($ris);

	if ($ris["status"]=='ok')
	{
		header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
	}
	else
	{
		header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
	}

?>