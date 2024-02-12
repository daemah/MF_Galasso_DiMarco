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
/*
function ValutaCommento()
{
	// var cognome = this.value;
	
	var xttp = new ajaxRequest();
	xttp.onreadystatechange  = function()
	{
		// console.log(this.readyState + ' ' + this.status);
      if (this.readyState == 4 && this.status == 200)
	  {
		  // console.log(this.response);
		  risposta = JSON.parse(this.response);
		  
          if (risposta.status == "ok")		  
		  {
           valutazione = risposta.contenuto;
           menu = document.getElementById('visualizza');	   
		  }
		  else
		  {
			  alert(risposta.msg);
		  }
		    
	  }		  
    };
	xttp.open("GET","php/getRegioni.php",true);
	xttp.send();
}
*/

function ValutaCommento() {
    //var messaggio;
    var valutazione = window.prompt("Inserisci una valutazione da -3 a +3:");
	//document.write("Valutazione: "+$codice_commento);
	console.log(valutazione);
    //messaggio = valutazione;
    //document.getElementById("visualizza").innerHTML = codiceCommento;
	//location.href='../frontend/post.php?valutazione='+valutazione;
}

function logOutConfirm() {
    var conferma = window.confirm("Sicuro che vuoi sloggarti?");
	if (conferma){
		location.href='../backend/logout-exe.php';
	} 
}
