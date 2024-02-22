<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$msg = "";
$codice = $_SESSION["photoRecente"];
$email = $_SESSION["email"];
$desc = $_POST["desc"];
$country = $_POST["countrybir"];
$region = $_POST["regionbir"];
$city = $_POST["citybir"];


if ($codice == NULL){
        $msg .= "No photo selcted </br>";
        header('location: ../frontend/aggiungiFoto.php?status=ko&msg='. urlencode($msg)); 

    }else{
        $ris = makePost($cid,$email,$codice,$desc,$country,$region,$city);
        if ($ris == 1){
            $msg = "Post successes";
            header("location: ../frontend/profile.php?utente=$email&status=ok&msg=". urlencode($msg));
        }else{
            $msg = "Post failed";
            header("location: ../frontend/profile.php?$email&status=ko&msg=". urlencode($msg));
        }
        

}
  


?>