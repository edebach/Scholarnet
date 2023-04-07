# ScholarNet
Progetto LTW

COMANDI UTILI GENERALE:

git push: pusha il codice su github

git pull: prende il codice più recente da github

git reset --hard HEAD^: resetta l'head al penultimo commit


COMANDI UTILI DB:

- Creazione tabella:
create table 'nome_tabella' (
    attr_1 'tipo(dim)',
    ...,
    attr_n 'tipo(dim)'
);


- Modifica tabella (aggiunta colonna):
alter table 'nome_tabella' add 'new_column_name' 'data_type'(dim);

- Inserimento dati:
insert into 'nome_tabella' values('attr_1',...,'attr_n');



COMANDI UTILI FABIO:

git add -A index.html



TESTO VERSIONE SMALL:

<small id="emailSmall" class="form-text text-muted">Inserisci la tua email</small>

COSE DA AGGIUNGERE:
DA RICORDARE:
1) Quando modificate i nomi dei file php ricordate che i riferimenti dei bottoni vanno modificati altrimenti il link resta ad un file html

SIGNUP:
1) Scelta se professore o studente
2) Sesso della persona
3) Aggiungere Lo step successivo dopo prosegui

INDEX:
1) Risolvere bug "immagine bianca" nel carosello(RISOLTO A META, GUARDARE IL COMMENTO A RIGA 18, SE SI TOLGONO QUEI LINK FUNZIONA)
2) Aggiungere il logo di "Scholarnet" in alto a sinistra nella navbar
3) Parte php
4)avviso recensione (disponibile solo se loggato)

LOGIN:
1) Rendere tutti i pulsanti funzionanti

INDEXLOGGED:
1) Aggiungere profilo (leggi riga 87)

LISTACLASSIDOCENTI:
1) Finestre dei corsi gestiti dal docente
2) Pulsante crea corso
2) profilo+logout

LISTACLASSISTUDENTI:
1) Finestre dei corsi in cui si è iscritti
2) Pulsante unisciti a un corso
2) profilo+logout

PROFILO:
1) informazioni essenziali (Usando principalente php)

CLASSI:
1) Iniziare a costruire le classi

SEZIONE SOCIAL:
Da fare tutta

DATABASE:
da fare da 0