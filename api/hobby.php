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
    

$hobbys = array();	
   $sql = "SELECT nome FROM ha_hobby where email = '$email'";
   $res = $cid->query($sql);
   	if ($res==null)
	{
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
		echo json_encode($risultato);
	}
	while ($row = $res->fetch_assoc()){
		$hobbys[] = $row["nome"];
	}
    $risultato["contenuto"]=$hobbys;
    

$utenti_hobbys_comuni = array();
foreach($hobbys as $hobby){
    $sql = "SELECT email FROM ha_hobby where nome = '$hobby'";
    $res = $cid->query($sql);
        if ($res==null)
        {
            $risultato["status"]="ko";
            $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
            echo json_encode($risultato);
        }
        while ($row = $res->fetch_assoc()){
            $utenti_hobbys_comuni[] = $row["email"];
        }
}
$risultato["contenuto"]=array_unique($utenti_hobbys_comuni); 



$nickname_hobbys_comuni = array();
foreach($utenti_hobbys_comuni as $utente_hobbys_comuni){
    $sql = "SELECT nickname FROM utente where email = '$utente_hobbys_comuni'";
    $res = $cid->query($sql);
        if ($res==null)
        {
            $risultato["status"]="ko";
            $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
            echo json_encode($risultato);
        }
        while ($row = $res->fetch_assoc()){
            $nickname_hobbys_comuni[] = $row["nickname"];
        }
}
$risultato["contenuto"]=array_unique($nickname_hobbys_comuni);
echo json_encode(array_unique($risultato)); 

?>