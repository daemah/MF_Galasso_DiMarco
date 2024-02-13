<?php
/* Funzioni relative alla gestione degli utenti */

function generateCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < 10; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}

function isUser($cid,$email,$pwd)
{
	$risultato= array("msg"=>"","status"=>"ok");

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

   /* inserire controlli dell'input */
   $sql = "SELECT * FROM utente WHERE email = '$email' AND password = '$pwd'";
   
   $res = $cid->query($sql);
   
   	if ($res==null) 
	{
	        $msg = "Si sono verificati i seguenti errori:<br/>" 
     		. $cid->error;
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;			
	}elseif($res->num_rows==0 || $res->num_rows>1)
	{		
			$msg = "Email o password sbagliate";
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;		
	}elseif($res->num_rows==1)
	{
	    $msg = "Login effettuato con successo";
		$risultato["status"]="ok";
		$risultato["msg"]=$msg;		
	}
    return $risultato;
}
############ GET FUNCTIONS #################
function getNome($cid,$email)
{
	$sql = "SELECT nome from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$nome = $row["nome"];
	return $nome;
}
function getCognome($cid,$email)
{
	$sql = "SELECT cognome from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$cognome = $row["cognome"];
	return $cognome;
}
function getSesso($cid,$email)
{
	$sql = "SELECT sesso from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$sesso = $row["sesso"];
	return $sesso;
}
function getDataNascita($cid,$email)
{
	$sql = "SELECT data_nascita from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$data_nascita = $row["data_nascita"];
	return $data_nascita;
}

function getRegioneNascita($cid,$email)
{
	$sql = "SELECT regione_nascita from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$regione_nascita = $row["regione_nascita"];
	return $regione_nascita;
}

function getHobby($cid)
{
	$hobby = array();
	$sql = "SELECT nome from hobby";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$hobby[] = $row["nome"];
	}
	return $hobby;
}

function getIndGradimento($cid, $codice)
{
	$gradimenti_commento = array();
	$sql = "SELECT gradimento FROM valuta WHERE codice_commento = '$codice';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$gradimenti_commento[] = $row["gradimento"];
	}
	return $gradimenti_commento;
}

function getCittaNascita($cid,$email)
{
	$sql = "SELECT citta_nascita from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$cittab = $row["citta_nascita"];
	return $cittab;
}
function getStatoNascita($cid,$email)
{
	$sql = "SELECT stato_nascita from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$stato_nascita = $row["stato_nascita"];
	return $stato_nascita;
}
function getRegioneResidenza($cid,$email)
{
	$sql = "SELECT regione_residenza from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$regione_residenza = $row["regione_residenza"];
	return $regione_residenza;
}
function getCittaResidenza($cid,$email)
{
	$sql = "SELECT citta_residenza from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$citta_residenza = $row["citta_residenza"];
	return $citta_residenza;
}
function getStatoResidenza($cid,$email)
{
	$sql = "SELECT stato_residenza from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$stato_residenza = $row["stato_residenza"];
	return $stato_residenza;
}
function getNickname($cid,$email)
{
	$sql = "SELECT nickname from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$nickname = $row["nickname"];
	return $nickname;
}
function getFoto($cid,$codice)
{	
	$sql = "SELECT posizione from foto where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$foto = $row["posizione"];
	return $foto;
}
function getTesto($cid,$codice)
{
	$sql = "SELECT testo from testo where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$testo = $row["testo"];
	return $testo;
}

function getCodiceFoto($cid, $email)
{
	$codici_foto = array();
	$sql = "SELECT codice from foto where email = '$email';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$codici_foto[] = $row["codice"];
	}
	return $codici_foto;
}

function getCodiceTesto($cid, $email)
{
	$codici_testo = array();
	$sql = "SELECT codice from testo where email = '$email';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$codici_testo[] = $row["codice"];
	}
	return $codici_testo;
}

function getCodiceCommentoFoto($cid, $codice_foto)
{
	$codici_commento_foto = array();
	$sql = "SELECT codice from commenti where codice_foto = '$codice_foto';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$codici_commento_foto[] = $row["codice"];
	}
	return $codici_commento_foto;
}

function getCodiceCommentoTesto($cid, $codice_testo)
{
	$codici_commento_testo = array();
	$sql = "SELECT codice from commenti where codice_testo = '$codice_testo';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$codici_commento_testo[] = $row["codice"];
	}
	return $codici_commento_testo;
}

function getCommento($cid, $codice)
{
	$commenti_foto = array();
	$sql = "SELECT testo from commenti where codice = '$codice';";
	$res = $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$commenti_foto[] = $row["testo"];
	}
	return $commenti_foto;
}

function getCommentatore($cid, $codice)
{
	$sql = "SELECT email from commenti where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$email_commentatore = $row["email"];
	return $email_commentatore;
}

function getTimeCommento($cid, $codice)
{
	$sql = "SELECT timestamp from commenti where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$timestamp_commento = $row["timestamp"];
	return $timestamp_commento;
}

function getDescrizioneFoto($cid, $codice)
{
	$sql = "SELECT descrizione from foto where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$descrizione = $row["descrizione"]; 	
	return $descrizione;
}

function getCitta($cid, $codice)
{
	$sql = "SELECT nome_citta from foto where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$citta = $row["nome_citta"]; 	
	return $citta;
}

function getStato($cid, $codice)
{
	$sql = "SELECT stato from foto where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$stato = $row["stato"]; 	
	return $stato;
}

function getTimeFoto($cid, $codice)
{
	$sql = "SELECT timestamp from foto where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$time = $row["timestamp"]; 	
	return $time;
}

function getTimeTesto($cid, $codice)
{
	$sql = "SELECT timestamp from testo where codice = '$codice';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$time = $row["timestamp"]; 	
	return $time;
}

function getFollowers($cid, $email)
{
	$followers = array();
	$sql = "SELECT utente_richiedente from chiede_amicizia where utente_ricevente = '$email' and data_accettazione is not null;";
	$res= $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$followers[] = $row["utente_richiedente"];
	}
	return $followers;
}

function getFollowing($cid, $email)
{
	$following = array();
	$sql = "SELECT utente_ricevente from chiede_amicizia where utente_richiedente = '$email' and data_accettazione is not null;";
	$res= $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$following[] = $row["utente_ricevente"];
	}
	return $following;
}

function getFotoProfilo($cid, $email)
{
	$sql = "SELECT foto_profilo from utente where email = '$email';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();
	$foto_profilo = $row["foto_profilo"]; 
	$sql = "SELECT posizione from foto where codice = '$foto_profilo';";
	$res = $cid->query($sql);
	$row = $res->fetch_assoc();

	if($row != NULL){
		return $posizione_foto_profilo = $row["posizione"]; 
	}
	$defaul_path = "\"../images/profilo.jpeg\"";
	return $defaul_path;
}

function getDataAccettazione($cid, $utente, $email)
{
	$sql = "SELECT data_accettazione FROM chiede_amicizia WHERE utente_ricevente = '$utente' and utente_richiedente = '$email';";
    $res=$cid->query($sql);
    $row = $res->fetch_assoc();
	
    if($row != NULL){
		$data_accettazione = $row["data_accettazione"];
		return $data_accettazione;
    } else {
	return 0;}
}				

function getDataRichiesta($cid, $utente, $email)
{
	$sql = "SELECT data_richiesta FROM chiede_amicizia WHERE utente_ricevente = '$utente' and utente_richiedente = '$email';";
    $res=$cid->query($sql);
    $row = $res->fetch_assoc();
	
    if($row != NULL){
		$data_richiesta = $row["data_richiesta"];
        return $data_richiesta;
    } else{
	return 0;}
	
}

function getRispettabilità($cid, $email)
{
	$sql = "SELECT rispettabilità FROM utente WHERE email = '$email';";
    $res=$cid->query($sql);
    $row = $res->fetch_assoc();
	$rispettabilità = $row["rispettabilità"]; 	
	return $rispettabilità;
}

function getValutazione($cid, $email, $codice_commento)
{
	$sql = "SELECT gradimento FROM valuta WHERE codice_commento = '$codice_commento' and email_valutatore = '$email';";
    $res=$cid->query($sql);
    $row = $res->fetch_assoc();
	if($row != NULL){
		$valutazione = $row["gradimento"];
        return $valutazione;
    } else{
	return 0;}
}

####### FUNZIONI UPDATE ##########
function updateCampo($var,$dbvar,$email)
{
	if (empty($var)) {
		$sql = "UPDATE utente set $dbvar = NULL where email = '$email';";
	}else{
		$sql = "UPDATE utente set $dbvar = '$var' where email = '$email';";
	}
	return $sql;
}

function controllaCampo($cid,$sql)
{
	$res = $cid->query($sql);
		
		if ($res==1)
		{
			$risultato["status"]="ok";
	   		$risultato["msg"]="Hai aggiornato i dati con successo";
		}else {
			$risultato["status"]="ko";
			$risultato["msg"]="L'aggiornamento è fallito" . $sql . $cid->error;
		}
	return $risultato;
}

function createLocation($country, $region, $city, $email)
{
	$sql = "INSERT INTO `città` (`regione`, `nome`, `stato`, `provincia`) VALUES ('$region', '$city', '$country', NULL);";
	return $sql;
}

function updateLuogo($region,$city,$country, $whichone ,$email) 
{
	if ($whichone === 'residenza')
	{
		$regioneDb = 'regione_residenza';
		$statoDb = 'stato_residenza';
		$cittaDb = 'citta_residenza';
	}else{

		$regioneDb = 'regione_nascita';
		$statoDb = 'stato_nascita';
		$cittaDb = 'citta_nascita';
	}

	if (empty($region) or empty($city) or empty($country)) {
		$sql = "UPDATE `utente` set `$regioneDb` = NULL , `$cittaDb` = NULL , `$statoDb` = NULL where `utente`.`email` = '$email';";
	}else{
		$sql = "UPDATE `utente` set `$regioneDb`= '$region' , `$cittaDb` = '$city' , `$statoDb` = '$country' where `utente`.`email` = '$email';";
	}
	return $sql;


}
/*
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
*/
function updateProfile($cid,$email,$nickname,$name,$lname,$sex,$dateb, $countryRes , $regionRes, $cityRes,$countryBir , $regionBir, $cityBir )

{
	$risultato = array("status"=>"ok","msg"=>"");
	$errore = false;
	#ERRORE CONNESSIONE 
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}

	# ERRORI CARATTERI SPECIALI
	if( preg_match( '/[!@#$%^&*()\-_=+{};:,<.>]+/', $name ) ) {
		$errore = true;
		$msg .= "Il nome non può contenere alcun carattere speciale</br>";
	}
	elseif( preg_match( '/[!@#$%^&*()\-_=+{};:,<.>]+/', $lname ) ) {
		$errore = true;
		$msg .= "Il cognome non può contenere alcun carattere speciale</br>";
	}

	if (!$errore){

		$risposte = array();
		$sql = updateCampo($nickname,'nickname',$email);
		$ris_nickname= controllaCampo($cid,$sql);
		array_push($risposte,$ris_nickname);

		$sql = updateCampo($name,'nome',$email);
		$ris_name= controllaCampo($cid,$sql);
		array_push($risposte,$ris_name);

		$sql = updateCampo($lname,'cognome',$email);
		$ris_lname= controllaCampo($cid,$sql);
		array_push($risposte,$ris_lname);

		$sql = updateCampo($sex,'sesso',$email);
		$ris_sex= controllaCampo($cid,$sql);
		array_push($risposte,$ris_sex);

		$sql = updateCampo($dateb,'data_nascita',$email);
		$ris_dateb= controllaCampo($cid,$sql);
		array_push($risposte,$ris_dateb);

		if (!(empty($countryRes) or empty($regionRes) or empty($cityRes))) {
			if ($countryRes != getStatoResidenza($cid,$email) || $regionRes != getRegioneResidenza($cid, $email) || $cityRes != getCittaResidenza($cid,$email)){
			$sql = createLocation($countryRes,$regionRes, $cityRes,$email);
			$ris_res= controllaCampo($cid,$sql);
			array_push($risposte,$ris_res);
			}
		}

		$sql = updateLuogo($regionRes,$cityRes,$countryRes , 'residenza',$email);
		$ris_res= controllaCampo($cid,$sql);
		array_push($risposte,$ris_res);


		if (!(empty($countryBir) or empty($regionBir) or empty($cityBir))) {
			if ($countryBir != getStatoNascita($cid,$email) || $regionBir != getRegioneNascita($cid, $email) || $cityBir != getCittaNascita($cid,$email)){
			$sql = createLocation($countryBir,$regionBir, $cityBir,$email);
			$ris_bir= controllaCampo($cid,$sql);
			array_push($risposte,$ris_bir);
			}
	
		}
		
		$sql = createLocation($countryBir,$regionBir, $cityBir,$email);
		$ris_bir= controllaCampo($cid,$sql);
		array_push($risposte,$ris_bir);

		$sql = updateLuogo($regionBir,$cityBir,$countryBir , 'nascita',$email);
		$ris_bir= controllaCampo($cid,$sql);
		array_push($risposte,$ris_bir);
		
		foreach ($risposte as $ris){
			if ($ris["status"]=="ko"){
				$risultato["status"]="ko";
				$risultato["msg"] = $ris["msg"];
			}else {
				$risultato["status"]="ok";
				$risultato["msg"] = $ris["msg"];
			}
		}
	

	}else{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}
	return $risultato;
	
}

function getUtenti($cid)
{
	$utenti = array();
	$sql= "SELECT email FROM utente;";
	$res= $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$utenti[] = $row["email"];
	}
	return $utenti;
}

function requestFriendship($cid, $utente_richiedente, $utente_ricevente)
{
	$risultato = array("status"=>"ko","msg"=>"");
	$errore = false;
	#ERRORE CONNESSIONE 
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}

	$sql = "INSERT INTO chiede_amicizia(utente_richiedente, utente_ricevente, data_richiesta) VALUES('$utente_richiedente','$utente_ricevente', CURRENT_TIMESTAMP);";
	$res=$cid->query($sql);
		if ($res==1)
		{
			$risultato["status"]="ok";
	    	$risultato["msg"]="Hai inviato la richiesta";
		}else{
			$risultato["msg"]="La richiesta è fallita". $sql . $cid->error;
		}

		return $risultato;

}

function leggiRichieste($cid, $email)
{
	$richieste = array();
	$sql = "SELECT utente_richiedente from chiede_amicizia where utente_ricevente = '$email';";
	$res= $cid->query($sql);
	while ($row = $res->fetch_assoc()){
		$richieste[] = $row["utente_richiedente"];
	}
	return $richieste;
}

########### FUNZIONI INSERISCI ############
function leggiUtente($cid)
{
	$utente = array();
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}
	$sql= "SELECT email, password FROM utente;";
	$res=$cid->query($sql);
	if ($res==null)
	{
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
		return $risultato;
	}
	while($row=$res->fetch_row())
	{
			$utente[$row[0]]=$row[1];
	}
	$risultato["contenuto"]=$utente;
	return $risultato;

}

function signIn($cid,$email,$pwd, $nickname)
{
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	$msg="";
	$errore=false;
	
	$email = trim($email);
	$pwd= trim($pwd);
	$md5pwd = md5($pwd);

	if (empty($email) || empty($pwd))
	{
		$errore = true;
		$msg = "Uno dei parametri non &egrave; specificato</br>";
	}

	elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false )
	{
		$errore = true;
		$msg .= "L'email inserita non rispetta il formato</br>";
	}
	
	elseif( strlen( $pwd ) < 8 ) {
		$errore = true;
		$msg .= "La password inserita è composta da meno di 8 caratteri</br>";
	}    
		
	elseif( !preg_match( '/[a-z0-9]+/i', $pwd ) ) {
		$errore = true;
		$msg .= "La password inserita deve contenere almeno un numero</br>";
	}

	elseif( !preg_match( '/[?!@#$%^&*()\-_=+{};:,<.>]+/', $pwd ) ) {
		$errore = true;
		$msg .= "La password inserita deve contenere almeno un carattere speciale</br>";
	}

	$res=leggiUtente($cid);

	if ($res["status"]=='ko')
	{
		$errore = true;
		$msg .= "Problemi nella lettura dal database</br>";
	} else
	{	
		$utente=$res["contenuto"];
		
		if (isset($utente[$email])) 
		{
			$errore = true;
			$msg .= "L'utente con email $email &egrave; gi&agrave; registrato</br>";
		}
	}

	if (!$errore)
	{
		
		$sql= "INSERT INTO utente(email,password, nickname) VALUES('$email','$md5pwd', '$nickname');";
		$res=$cid->query($sql);
		if ($res==1)
		{
	    	$risultato["msg"]="Ti sei registrato con successo, ora effetua il login";
		}else
		{
			$risultato["status"]="ko";
			$risultato["msg"]="La registrazione è fallita". $sql . $cid->error;
		}		
	}
	else
	{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}	
	return $risultato;
}

function acceptRequest($cid, $utente_ricevente, $utente_richiedente)
{
	$risultato = array("status"=>"ko","msg"=>"");
	$errore = false;
	#ERRORE CONNESSIONE 
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}
	
	$sql = "UPDATE chiede_amicizia SET data_accettazione = CURRENT_TIMESTAMP where utente_ricevente = '$utente_ricevente' and utente_richiedente = '$utente_richiedente';";
	$res=$cid->query($sql);
		if ($res==1)
		{
			$risultato["status"]="ok";
	    	$risultato["msg"]="Hai accettato la richiesta";
		}else{
			$risultato["msg"]="L'accettazione è fallita". $sql . $cid->error;
		}

		return $risultato;
}

function eliminateRequest($cid, $utente_ricevente, $utente_richiedente)
{
	$risultato = array("status"=>"ko","msg"=>"");
	$errore = false;
	#ERRORE CONNESSIONE 
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}
	print_r($utente_ricevente);
	print_r($utente_richiedente);
	$sql = "DELETE from chiede_amicizia where utente_ricevente = '$utente_ricevente' and utente_richiedente = '$utente_richiedente';";
	$res=$cid->query($sql);
		if ($res==1)
		{
			$risultato["status"]="ok";
	    	$risultato["msg"]="Hai ritirato la richiesta di amicizia";
		}else{
			$risultato["msg"]="L'eliminazione della richiesta è fallita". $sql . $cid->error;
		}

		return $risultato;
}

function deleteCommento($cid, $codice)
{
	$risultato = array("status"=>"ko","msg"=>"");
	$errore = false;

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}

	$sql = "DELETE from commenti where codice = '$codice';";
	$res=$cid->query($sql);
		if ($res==1)
		{
			$risultato["status"]="ok";
	    	$risultato["msg"]="Hai eliminato il commento";
		}else{
			$risultato["msg"]="L'eliminazione del commento è fallita". $sql . $cid->error;
		}

	return $risultato;
}

function unfollow($cid, $utente_ricevente, $utente_richiedente)
{
	$risultato = array("status"=>"ko","msg"=>"");
	$errore = false;
	#ERRORE CONNESSIONE 
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}
	if ($cid->connect_error) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	}
	
	$sql = "DELETE from chiede_amicizia where utente_ricevente = '$utente_richiedente' and utente_richiedente = '$utente_ricevente';";
	$res=$cid->query($sql);
		if ($res==1)
		{
			$risultato["status"]="ok";
	    	$risultato["msg"]="Hai ritirato la richiesta";
		}else{
			$risultato["msg"]="Il ritiro della richiesta è fallita". $sql . $cid->error;
		}

		return $risultato;
}

function insertCommentFoto($cid, $email, $codice, $commento, $codice_foto, $email_foto)
{
	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	print_r($risultato);
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	$msg="";
	$errore=false;

	if ($res["status"]=='ko')
	{
		$errore = true;
		$msg .= "Problemi nella lettura dal database</br>";
	}
	

	if (!$errore)
	{
		$sql= "INSERT INTO commenti(codice, email, testo, timestamp, progressivo, codice_foto, email_foto) VALUES('$codice', '$email','$commento',CURRENT_TIMESTAMP, 1, '$codice_foto', '$email_foto');";
		$res=$cid->query($sql);
		if ($res==1)
		{
	    	$risultato["msg"]="Hai inviato correttamente il commento";
			print_r($res);
		}else
		{
			$risultato["status"]="ko";
			$risultato["msg"]="l'inserimento del commento non è andata a buon fine". $sql . $cid->error;
		}		
	}
	else
	{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}	
	return $risultato;
	
}

function insertCommentTesto($cid, $email, $codice, $commento, $codice_testo, $email_testo)
{
	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	print_r($risultato);
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	$msg="";
	$errore=false;

	if ($res["status"]=='ko')
	{
		$errore = true;
		$msg .= "Problemi nella lettura dal database</br>";
	}
	

	if (!$errore)
	{
		$sql= "INSERT INTO commenti(codice, email, testo, timestamp, progressivo, codice_testo, email_testo) VALUES('$codice', '$email','$commento',CURRENT_TIMESTAMP, 1, '$codice_testo', '$email_testo');";
		$res=$cid->query($sql);
		if ($res==1)
		{
	    	$risultato["msg"]="Hai inviato correttamente il commento";
		}else
		{
			$risultato["status"]="ko";
			$risultato["msg"]="l'inserimento del commento non è andata a buon fine". $sql . $cid->error;
		}		
	}
	else
	{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}	
	return $risultato;
	
}

function insertIndGradimento($cid, $codice_commento, $email_valutatore, $gradimento, $email_valutato)
{
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	print_r($risultato);
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	$msg="";
	$errore=false;

	if ($res["status"]=='ko')
	{
		$errore = true;
		$msg .= "Problemi nella lettura dal database</br>";
	}
	

	if (!$errore)
	{
	$sql = "INSERT INTO valuta(codice_commento, email_commento, gradimento, email_valutatore, timestamp) VALUES('$codice_commento', '$email_valutato', '$gradimento', '$email_valutatore', CURRENT_TIMESTAMP);";
	$res=$cid->query($sql);
	if ($res==1)
	{
		$risultato["msg"]="Hai valutato correttamente il commento";
	}else
	{
		$risultato["status"]="ko";
		$risultato["msg"]="L'inserimento della valutazione del commento non è andata a buon fine --> Hai già valutato questo commento";
	}		
	}
	else
	{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}	
	return $risultato;

}

function deleteIndGradimento($cid, $codice_commento, $email_valutatore, $email_valutato)
{
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	print_r($risultato);
	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	$msg="";
	$errore=false;

	if ($res["status"]=='ko')
	{
		$errore = true;
		$msg .= "Problemi nella lettura dal database</br>";
	}
	

	if (!$errore)
	{
	$sql = "DELETE FROM valuta WHERE codice_commento = '$codice_commento' and email_commento = '$email_valutato' and email_valutatore = '$email_valutatore';";
	$res=$cid->query($sql);
	if ($res==1)
	{
		$risultato["msg"]="Hai eliminato correttamente la valutazione del commento";
	}else
	{
		$risultato["status"]="ko";
		$risultato["msg"]="L'eliminazione della valutazione del commento non è andata a buon fine";
	}		
	}
	else
	{
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
	}	
	return $risultato;

}

?>