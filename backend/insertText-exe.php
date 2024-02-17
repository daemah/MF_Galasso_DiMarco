<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$email = $_SESSION["email"];
print_r($email);
$testo = $_POST["testo"];
print_r($testo);
$codice_testo = generateCode();
print_r($codice_testo);

$ris = insertText($cid, $codice_testo, $email, $testo);
    
    if ($ris["status"]=='ok')
    {
    header("location: ../frontend/profile.php?utente=$email&status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
    header('location: ../frontend/aggiungiTesto.php?status=ko&msg='. urlencode($ris["msg"]));
    }   
    
?>