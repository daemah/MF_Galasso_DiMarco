var setTimer;

function ajaxRequest()
{var request=false;
  try { request = new XMLHttpRequest()}catch(e1){
	try{request = new ActiveXObject("Msxml2.XMLHTTP")}catch(e2){
		try{ request = new ActiveXObject("Microsoft.XMLHTTP")
		}catch(e3){request = false}
	}
  }
  return request
}

function updateNotificationCount() {
    var xttp = new ajaxRequest();
	xttp.onreadystatechange  = function()
	{
	console.log(this.readyState + ' ' + this.status);
      if (this.readyState == 4 && this.status == 200)
	  {
			console.log(this.response);
			risposta = JSON.parse(this.response);
			console.log(risposta.status);

			if (risposta.status == "ok")		  
			{
			notifiche = risposta.contenuto;
			console.log(notifiche)
			document.getElementById("notificationCount").innerHTML=notifiche;	
			
			}
			else
			{
				alert(risposta.msg);
			}
				
		}		    
    };
	xttp.open("GET", "../api/notification_count.php", true);
	xttp.send();
}
//updateNotificationCount();
//setInterval(updateNotificationCount, 5000); // a timer


function ValutaCommento(codice_commento, utente_commentato) {
    //var messaggio;
	console.log(codice_commento);
    var valutazione = window.prompt("Inserisci una valutazione da -3 a +3:");
	//document.write("Valutazione: "+$codice_commento);
	console.log(valutazione);

    //messaggio = valutazione;
    //document.getElementById("visualizza").innerHTML = codiceCommento;
	if (valutazione != null){location.href='../backend/insertValutazione-exe.php?valutazione='+valutazione+'&codiceCommento='+codice_commento+'&utente='+utente_commentato;}
	
}


function logOutConfirm() {
    var conferma = window.confirm("Sicuro che vuoi sloggarti?");
	if (conferma){
		location.href='../backend/logout-exe.php';
	} 
}


function changeColorBlu1() {
	document.getElementById("ricerca1").style.backgroundColor = "lightblue";
	var xttp = new ajaxRequest();
	xttp.onreadystatechange  = function()
	{
	console.log(this.readyState + ' ' + this.status);
      if (this.readyState == 4 && this.status == 200)
	  {
			console.log(this.response);
			risposta = JSON.parse(this.response);
			console.log(risposta.status);

			if (risposta.status == "ok")		  
			{
			let x = document.getElementsByClassName('container');
			utenti = risposta.contenuto;
			console.log(utenti);
			for (j=0; j < utenti.length; j++)
		  	{
				utente = utenti[j]; 
				for (i = 0; i < x.length; i++) { 
					if (!x[i].innerHTML.toLowerCase().includes(utente)) { 
						x[i].style.display="none"; 
					} 
					else { 
						x[i].style.display="list-item";                  
					} 
				}
				document.getElementById("comuni").innerHTML=utente;
			}	
			
			}
			else
			{
				alert(risposta.msg);
			}
				
		}		    
    };
	xttp.open("GET", "../api/hobby.php", true);
	xttp.send();
}


function changeColorBlu2() {
	document.getElementById("ricerca2").style.backgroundColor = "lightblue";
	var xttp = new ajaxRequest();
	xttp.onreadystatechange  = function()
	{
	console.log(this.readyState + ' ' + this.status);
      if (this.readyState == 4 && this.status == 200)
	  {
			console.log(this.response);
			risposta = JSON.parse(this.response);
			console.log(risposta.status);

			if (risposta.status == "ok")		  
			{
			let x = document.getElementsByClassName('container');
			utenti = risposta.contenuto;
			console.log(utenti.length)
			for (j=0; j < utenti.length; j++)
		  	{
				utente = utenti[j]; 
				for (i = 0; i < x.length; i++) { 
					if (!x[i].innerHTML.toLowerCase().includes(utente)) { 
						x[i].style.display="none"; 
					} 
					else { 
						x[i].style.display="list-item";                  
					} 
				}
				document.getElementById("comuni").innerHTML=utente;
			}	
			
			}
			else
			{
				alert(risposta.msg);
			}
				
		}		    
    };
	xttp.open("GET", "../api/citta_nascita.php", true);
	xttp.send();
}


function changeColorBlu3() {
	document.getElementById("ricerca3").style.backgroundColor = "lightblue";
	var xttp = new ajaxRequest();
	xttp.onreadystatechange  = function()
	{
	console.log(this.readyState + ' ' + this.status);
      if (this.readyState == 4 && this.status == 200)
	  {
			console.log(this.response);
			risposta = JSON.parse(this.response);
			console.log(risposta.status);

			if (risposta.status == "ok")		  
			{
			let x = document.getElementsByClassName('container');
			utenti = risposta.contenuto;
			for (j=0; j < utenti.length; j++)
		  	{
				utente = utenti[j]; 
				for (i = 0; i < x.length; i++) { 
					if (!x[i].innerHTML.toLowerCase().includes(utente)) { 
						x[i].style.display="none"; 
					} 
					else { 
						x[i].style.display="list-item";                  
					} 
				}
				document.getElementById("comuni").innerHTML=utente;
			}	
			
			}
			else
			{
				alert(risposta.msg);
			}
				
		}		    
    };
	xttp.open("GET", "../api/citta_residenza.php", true);
	xttp.send();
}

function search_profile() { 
	let input = document.getElementById('search').value 
	input=input.toLowerCase(); 
	console.log(input)
	let x = document.getElementsByClassName('container'); 
	console.log(x)
	for (i = 0; i < x.length; i++) {  
		if (!x[i].innerHTML.toLowerCase().includes(input)) { 
			x[i].style.display="none"; 
		} 
		else { 
			x[i].style.display="list-item";                  
		} 
	} 
}

function popUp()
{
	window.open("notifications.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
/*
function read_comment() { 
	let input = document.getElementById('insertComment').value 
	input=input.toLowerCase(); 
	console.log(input);
	for(i=0; i<input.length; i++){
		var lettera = input[i];
		console.log(lettera);
		if (lettera == '@'){
			document.write(Stringa.link("giorno.htm"));
		}
	}
	
} */

