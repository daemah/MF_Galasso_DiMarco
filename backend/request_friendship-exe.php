<?php 
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$utente_richidente = $_SESSION["email"];
$utente_ricevente = $_GET["utente"];

$ris = requestFriendship($cid, $utente_richidente, $utente_ricevente);
print_r($ris);

if ($ris["status"]=='ok')
    {
    $_SESSION["request"] = true;
    header("location: ../frontend/profile.php?utente=$utente_ricevente&status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
    header("location: ../frontend/profile.php?utente=$utente_ricevente&status=ko&msg=". urlencode($ris["msg"]));
    }

?>