<?php # ciao come stai sto bene grazie
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$utente_ricevente = $_GET["user"];
print_r($utente_ricevente);
$utente_richiedente = $_SESSION["email"];
print_r($utente_richiedente);
$utente_profilo = $_GET["utente"];
print_r($utente_profilo);
$page = $_GET["page"];
print_r($page);

$ris = eliminateRequest($cid, $utente_ricevente, $utente_richiedente);
print_r($ris);

if ($ris["status"]=='ok')
    {
    header("location: ../frontend/users.php?utente=$utente_profilo&page=$page&status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
    header("location: ../frontend/profile.php?utente=$utente_profilo&page=$page&status=ko&msg=". urlencode($ris["msg"]));
    }
 
?>