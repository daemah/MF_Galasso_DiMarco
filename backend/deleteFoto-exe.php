<?php
session_start();
include_once "../common/connection.php";
include_once "../common/funzioni.php";

$codice_foto = $_GET["codice"];
echo $codice_foto;
$email = $_SESSION["email"];
echo $email;

$ris = deleteFoto($cid, $codice_foto, $email);
print_r($ris);

if ($ris["status"]=='ok')
{
    header("location: ../frontend/post.php?status=ok&msg=" . urlencode($ris["msg"]));
}
else
{
    header("location: ../frontend/post.php?status=ko&msg=". urlencode($ris["msg"]));	
}

?>