<?php
//session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$utente = $_GET["utente"];

$ris = sbloccaUtente($cid, $utente);
print_r($ris);


if ($ris["status"]=='ok')
{
    header("location: ../frontend/profile.php?utente=$utente&status=ok&msg=" . urlencode($ris["msg"]));
}
else
{
    header("location: ../frontend/profile.php?utente=$utente&status=ko&msg=" . urlencode($ris["msg"]));
}

?>