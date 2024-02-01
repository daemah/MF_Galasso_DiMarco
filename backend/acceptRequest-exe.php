<?php # ciao come stai
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$utente_ricevente = $_SESSION["email"];
$utente_richiedente = $_GET["utente"];

$ris = acceptRequest($cid, $utente_ricevente, $utente_richiedente);
print_r($ris);

if ($ris["status"]=='ok')
    {
    header("location: ../frontend/notifications.php?status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
        header("location: ../frontend/notifications.php?status=ko&msg=". urlencode($ris["msg"]));
    }

?>