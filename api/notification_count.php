<?php

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *\r\n");
include ('../common/connection.php');
session_start();
$email = $_SESSION["email"];


$link = mysqli_connect($hostname, $username, $password) or die("failed to connect to server !!");
mysqli_select_db($link, $db);

//Altrimenti restituisce in output le warning
error_reporting(E_ERROR | E_NOTICE);


if(!$link->set_charset("utf8"))
{
    exit();
}

$risultato= array("msg"=>"","status"=>"ok");
    

$notifiche = array();	
   $sql = "SELECT utente_richiedente FROM chiede_amicizia where utente_ricevente = '$email'";
   $res = $cid->query($sql);
   	if ($res==null)
	{
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
		echo json_encode($risultato);
	}
	while ($row = $res->fetch_assoc()){
		$notifiche[] = $row["utente_richiedente"];
	}
    $risultato["contenuto"]=count($notifiche);
    echo json_encode($risultato);

?>