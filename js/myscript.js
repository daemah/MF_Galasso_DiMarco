function ValutaCommento() {
    var messaggio;
    var valutazione = window.prompt("Inserisci una valutazione da 1 a 10:", );
    
    messaggio = "Hai valutato il commento con: " + valutazione;
    document.getElementById("visualizza").innerHTML = messaggio;

}