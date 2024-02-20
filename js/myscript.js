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

			if (notifiche == 0) {
                    document.getElementById("notificationCount").style.display = "none";
			}
			
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



function ValutaCommento(codice_commento, utente_commentato, $cid) {
    //var messaggio;
	console.log($cid);
	console.log(codice_commento);
	
    var valutazione = window.prompt("Inserisci una valutazione da -3 a +3:");
	console.log(valutazione);

	if (valutazione != null){
		location.href='../backend/insertValutazione-exe.php?valutazione='+valutazione+'&codiceCommento='+codice_commento+'&utente='+utente_commentato;
	}
	
}

function ValutaCommentoDaProfile(codice_commento, utente_commentato, $cid) {
    //var messaggio;
	console.log($cid);
	console.log(codice_commento);
	
    var valutazione = window.prompt("Inserisci una valutazione da -3 a +3:");
	console.log(valutazione);

	if (valutazione != null){
		location.href='../backend/insertValutazioneDaProfile.php?valutazione='+valutazione+'&codiceCommento='+codice_commento+'&utente='+utente_commentato;
	}
	
}

function ValutaCommentoDaProfileAut(codice_commento, utente_commentato, $cid) {
    //var messaggio;
	console.log($cid);
	console.log(codice_commento);
	
    var valutazione = window.prompt("Inserisci una valutazione da -3 a +3:");
	console.log(valutazione);

	if (valutazione != null){
		location.href='../backend/insertValutazioneDaProfileAut.php?valutazione='+valutazione+'&codiceCommento='+codice_commento+'&utente='+utente_commentato;
	}
	
}


function logOutConfirm() {
    var conferma = window.confirm("Sicuro che vuoi sloggarti?");
	if (conferma){
		location.href='../backend/logout-exe.php';
	} 
}


function sameHobbies() {
	var xttp = new ajaxRequest();
	if (document.getElementById("ricerca1").style.backgroundColor=="white"){
		document.getElementById("ricerca1").style.backgroundColor = "lightblue";
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
				const userListItems = document.querySelectorAll('.container');
				console.log(userListItems);
				utenti = risposta.contenuto;
				console.log(utenti)
				userListItems.forEach((item, index) => {
					const user = utenti[index];
					if (user) {
						item.style.display = 'list-item'; // Mostra l'elemento se esiste un utente corrispondente
					} else {
						item.style.display = 'none'; // Nasconde l'elemento se non esiste un utente corrispondente
					}
				});
				
				}
				else
				{
					alert(risposta.msg);
				}
					
			}		    
		};
	} else {
		document.getElementById("ricerca1").style.backgroundColor = "white";
		
		
				if (risposta.status == "ok")		  
				{
					const userListItems = document.querySelectorAll('.container');
					userListItems.forEach((item) => {
					item.style.display = 'list-item';
					});
				}
	}

	xttp.open("GET", "../api/hobby.php", true);
	xttp.send();
}

function sameCityBir() {
	
	var xttp = new ajaxRequest();
	if (document.getElementById("ricerca2").style.backgroundColor=="white"){
		document.getElementById("ricerca2").style.backgroundColor = "lightblue";
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
				const userListItems = document.querySelectorAll('.container');;
				console.log(userListItems);
				utenti = risposta.contenuto;
				console.log(utenti)
				userListItems.forEach((item, index) => {
					const user = utenti[index];
					if (user) {
						item.style.display = 'list-item'; // Mostra l'elemento se esiste un utente corrispondente
					} else {
						item.style.display = 'none'; // Nasconde l'elemento se non esiste un utente corrispondente
					}
				});
				
				}
				else
				{
					alert(risposta.msg);
				}
				
		}		    
    };
		} else {
			document.getElementById("ricerca2").style.backgroundColor = "white";
			
			
					if (risposta.status == "ok")		  
					{
						const userListItems = document.querySelectorAll('.container');
						userListItems.forEach((item) => {
						item.style.display = 'list-item';
						});
					}
		}
	xttp.open("GET", "../api/citta_nascita.php", true);
	xttp.send();
}


function sameCityRes() {
	if (document.getElementById("ricerca3").style.backgroundColor=="white"){
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
				const userListItems = document.querySelectorAll('.container');;
				console.log(userListItems);
				utenti = risposta.contenuto;
				console.log(utenti)
				userListItems.forEach((item, index) => {
					const user = utenti[index];
					if (user) {
						item.style.display = 'list-item'; // Mostra l'elemento se esiste un utente corrispondente
					} else {
						item.style.display = 'none'; // Nasconde l'elemento se non esiste un utente corrispondente
					}
				});
				
				}
				else
				{
					alert(risposta.msg);
				}
				
		}		    
    };
	} else {
	document.getElementById("ricerca3").style.backgroundColor = "white";
	
	
			if (risposta.status == "ok")		  
			{
				const userListItems = document.querySelectorAll('.container');
				userListItems.forEach((item) => {
				item.style.display = 'list-item';
				});
			}
	}
	xttp.open("GET", "../api/citta_residenza.php", true);
	xttp.send();
}

function search_profile() { 
	let input = document.getElementById('search').value 
	input=input.toLowerCase(); 
	console.log(input)
	let x = document.getElementsByClassName('container'); 
	for (i = 0; i < x.length; i++) {  
		if (!x[i].innerHTML.toLowerCase().includes(input)) { 
			console.log(x[i].innerHTML.toLowerCase().includes(input));
			x[i].style.display="none"; 
		} 
		else { 
			x[i].style.display="list-item";    
			console.log(x[i].innerHTML.toLowerCase().includes(input));              
		} 
	} 
}

function popUp(codice)
{
	window.open("messaggioRiferito.php?codice="+codice, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}

