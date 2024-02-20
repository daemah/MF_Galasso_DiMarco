<?php # ciao come stai sto bene grazie
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$email = $_SESSION["email"];
print_r($email);
$utente = $_GET["utente"];
$codice_commento = $_GET["codice_commento"];
$codice_foto = $_GET["codice_foto"];

$ris = referFoto($cid, $email, $utente, $codice_commento, $codice_foto);
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