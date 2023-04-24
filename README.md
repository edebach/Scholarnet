# ScholarNet
`Progetto LTW`

**COMANDI UTILI GENERALE**:
- `git push` pusha il codice su github
- `git pull` prende il codice più recente da github
- `git reset --hard HEAD^` resetta l'head al penultimo commit
- `<?php include '../profilo.html'; ?>` importa un file html in un altro 

**COMANDI UTILI MySQL (DBMS)**:
- Creazione tabella:
```bash
create table 'nome_tabella' (
    attr_1 'data_type(dim)',
    ...,
    attr_n 'data_type(dim)'
);
```

- Modifica tabella (aggiunta colonna):
```bash
alter table 'nome_tabella' add 'new_column_name' 'data_type(dim)';
```

- Inserimento dati:
```bash
insert into 'nome_tabella' values('value_attr_1',...,'value_attr_n');
```

- Esportare il db su pgAdmin4:
1. Tasto destro sul db da esportare;
2. `Backup`;
3. Inserisci le informazioni che ti richiede (ricordati di salvarlo sulla cartella dove hai il progetto).

- Importare il db su pgAdmin4:
1. Tasto destro sul db da importare;
2. `Restore`;
3. Inserisci le informazioni che ti richiede (ricordati di salvarlo sulla cartella dove hai il progetto).

**SCHEMA LOGICO**: 
```bash
utente(nome, cognome, email(pk), pass, istituto, sesso, dataN, flagStudente)
    vincolo: dataN deve essere scritta nel formato hhhh/mm/dd
    
corso(codice(pk), nome, materia, numIscritti, link)
    inclusione: corso[codice] => insegna[docente]
    
insegna(docente(pk), corso(pk))
    f.k.: insegna[docente] => utente[email]
    f.k.: insegna[corso] => corso[codice]
    
partecipa(studente(pk), corso(pk))
    f.k.: partecipa[studente] => utente[email]
    f.k.: partecipa[corso] => corso[codice]

recensione(utente(pk), data(pk), stelle, descrizione, nome_recensione)
    f.k.: recensione[utente] => utente[email]
```

**COMANDI UTILI FABIO**:
- `git add -A index.html`

**COMANDI UTILI MARCO**:
```bash
foreach($GLOBALS as $k => $v){
    echo "$k => ";
    //funzione che ti permette di stampare qualcosa in formato leggibile
    print_r($v);
    echo "<br><hr/><br>";
}
```

**TESTO VERSIONE SMALL**:
```bash
<small id="emailSmall" class="form-text text-muted">Inserisci la tua email</small>
```

# COSE DA AGGIUNGERE:
!IMPORTANTE!
Bisogna modificare i file in file-php ma anche i loro riferimenti
Bisogna aggiungere i session_start() nei vari vile

**DA RICORDARE**:
- Quando modificate i nomi dei file php ricordate che i riferimenti dei bottoni vanno modificati altrimenti il link resta ad un file html

**INDEX**:
1) Aggiungere il logo di "Scholarnet" in alto a sinistra nella navbar
2)modifica recensione (disponibile solo se loggato)
3)vediamo se gestire la newsletter
4)modificare i campi di testo con informazioni vere



**SIGNUP**:
1) creare il file signup prosegui
2) prima parte modifiacre: nome,cognome,data di nascita, istituto, sesso
3)seconda parte signup: email password,conferma password, docente/studente


**LOGIN**:
1) Remember me 

**INDEXLOGGED**:
1) pulsanti crea e iscriviti al corso (meglio popup)
2) Recensione funzionante
3) modifica navbar con i miei corsi
4) modifica campi di testo con info vere

**LISTACLASSIDOCENTI**:
1) Finestre dei corsi gestiti dal docente
2) Pulsante crea corso
2) profilo+logout

**LISTACLASSISTUDENTI**:
1) Finestre dei corsi in cui si è iscritti
2) Pulsante unisciti a un corso
2) profilo+logout

**PROFILO**:
1) info utente(nella tabella utente)+foto profilo opzionale
2) pulsante modifica
3) numero corsi a cui si è iscritto

**CLASSI**:
1) rendere funzionante i pulsanti
2) sezione profile
3) sezione elenco classi
4) rendere il file duplicabile 

**SEZIONE SOCIAL**:
1) Da fare tutta

**DATABASE**:
1) Completamento della tabella utente


**venerdi ho modificato il peofilo iniziando a inserire dati personalizzati

https://www.remove.bg/it/upload

UPDATE mytable SET myfield = 'nuovo_valore' WHERE id = 'valore_id';
