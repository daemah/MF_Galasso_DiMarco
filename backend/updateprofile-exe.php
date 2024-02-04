<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$email = $_SESSION["email"];
$nickname = $_POST["nickname"];
$name = $_POST["name"];
$lname = $_POST["lname"];
$sex = $_POST["sex"];
$dateb = $_POST["dateb"];

$ris = updateProfile($cid, $email, $nickname, $name, $lname, $sex, $dateb);
    
    if ($ris["status"]=='ok')
    {
    header("location: ../frontend/profile.php?utente=$email&status=ok&msg=" . urlencode($ris["msg"]));
    }
    else
    {	
    header('location: ../frontend/updateprofile.php?status=ko&msg='. urlencode($ris["msg"]));
    }





    
    
?>