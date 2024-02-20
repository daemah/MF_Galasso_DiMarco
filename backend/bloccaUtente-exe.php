<?php
//session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";
session_start();
$utente = $_GET["utente"];
$email = $_SESSION["email"];
$ris = bloccaUtente($cid, $utente);

$ris1 = chiHaBloccato($cid, $email, $utente);


if ($ris["status"]=='ok')
{
    header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
}
else
{
    header("location: ../frontend/post.php?status=ko&msg=" . urlencode($ris["msg"]));
}

?>