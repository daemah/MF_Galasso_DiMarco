<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$codice_testo = $_GET["codice"];
echo $codice_testo;
$email = $_SESSION["email"];
echo $email;

$ris = deleteTesto($cid, $codice_testo, $email);
print_r($ris);

if ($ris["status"]=='ok')
{
    header("location: ../frontend/profile.php?utente=$email&status=ok&msg=" . urlencode($ris["msg"]));
}
else
{
    header("location: ../frontend/profile.php?utente=$email&status=ko&msg=" . urlencode($ris["msg"]));
}

?>