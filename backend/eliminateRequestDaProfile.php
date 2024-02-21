<?php # ciao come stai sto bene grazie
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$utente_ricevente = $_GET["utente"];
$utente_richiedente = $_SESSION["email"];

$ris = eliminateRequest($cid, $utente_ricevente, $utente_richiedente);
print_r($ris);

if ($ris["status"]=='ok')
    {
    header("location: ../frontend/profile.php?utente=$utente_ricevente&status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
    header("location: ../frontend/profile.php?utente=$utente_ricevente&status=ko&msg=". urlencode($ris["msg"]));
    }
    
?>