function inizializzaStorageUtenti(){
    if (typeof(localStorage.utenti)=="undefined"){
        localStorage.utenti="[]";
    }

}
function resetstorage(){
    localStorage.utenti="[]";
    
}


function uguali(u,o){
    if((o.c==u.c) && (o.n==u.n) && (o.m==u.m))
        return true;
    return false
}


function inserisciUtente(){
    if(document.registrazione.cognome.value==""){
        alert("Inserire cognome");
        return false;
    }
    if(document.registrazione.nome.value==""){
        alert("Inserire nome");
        return false;
    }
    if(document.registrazione.matricola.value==""){
        alert("Inserire matricola");
        return false;
    }
    var u= JSON.parse(localStorage.utenti);
    var nextpos= u.length;
    var o= {c:document.registrazione.cognome.value, 
            n:document.registrazione.nome.value,
            m:document.registrazione.matricola.value
            };
    for(i=0;i<nextpos;i++)
        if(uguali(o,u[i])){
            alert("utente già inserito");
            return false;
        }
    alert("dati inseriti correttamente");
    u[nextpos]=o;
    localStorage.utenti=JSON.stringify(u);
    return true;

}
function stampastoragesemplice(){
    var u= JSON.parse(localStorage.utenti);
    var l= u.length;
    var s= new String("<h3> Stato di localstorage:</h3>");
    for(i=0;i<l;i++){
        s+=JSON.stringify(u[i])+"<br/>"; 
    }
    document.getElementById("vistaStorage").innerHTML=s;
    return true;


}
function stampastoragetabella(){
    var u= JSON.parse(localStorage.utenti);
    var l= u.length;
    var s= new String("<h3> Stato di localstorage:</h3>");
    s+="<table border=1><tr><th>cognome</th><th>nome</th><th>matricola</th></tr>";
    for(i=0;i<l;i++){
        s +="<tr><td>"+u[i].c+"</td><td>"+u[i].n+"</td><td>"+u[i].m+"</td></tr>";
    }
    s+="</table>";
    document.getElementById("vistaStorage").innerHTML=s;
    return true;

}

