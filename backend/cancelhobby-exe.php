<?php # ciao come stai sto bene grazie
session_start(); 
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$hobby = $_GET["nome"];
$email = $_SESSION["email"];




$ris = cancelHobby($cid, $hobby, $email);


if ($ris["status"]=='ok')
    {
    header("location: ../frontend/search.php?status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
        header("location: ../frontend/search.php?status=ko&msg=". urlencode($ris["msg"]));
    }
    
?>