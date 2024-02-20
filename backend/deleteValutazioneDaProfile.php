<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$codice_commento = $_GET["codice"];
echo $codice_commento;
$email = $_SESSION["email"];
echo $email;
$utente = $_GET["utente"];
echo $utente;

$ris = deleteIndGradimento($cid, $codice_commento, $email, $utente);
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