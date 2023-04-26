<?php

    //Connessione al db
    
    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
            user=postgres password=biar") 
            or die('Could not connect: ' . pg_last_error());
    

    $email = $_SESSION['email'];
    $flag = $_SESSION['flag'];

    foreach($GLOBALS as $k => $v){
        echo "$k => ";
        //funzione che ti permette di stampare qualcosa in formato leggibile
        print_r($v);
        echo "<br><hr/><br>";
    }

    //Controlliamo se si tratta di uno studente o docente
    //Docente
    if($flag=='0'){

        //Genera tutte le tuple che il docente insegna ai corsi
        $q1a = "SELECT * FROM utente u JOIN insegna i ON u.email=i.docente WHERE u.email=$1";
        $result1a = pg_query_params($dbconn, $q1a, array($email));

        if(($row=pg_fetch_array($result1a, null, PGSQL_ASSOC))){
            while ($row = pg_fetch_array($result1a)) {
                echo "<p>".$row['corso']."</p>";
            }
        }
        
        //Genera tutte le tuple che il docente partecipa ai corsi
        $q1b = "SELECT * FROM utente u JOIN partecipa p ON u.email=p.studente WHERE u.email=$1";
        $result1b = pg_query_params($dbconn, $q1b, array($email));

        if(($row=pg_fetch_array($result1b, null, PGSQL_ASSOC))){
            while ($row = pg_fetch_array($result1b)) {
                echo "<p>".$row['corso']."</p>";
            }
        }
        else{
            echo "<p>NON SEI ISCRITTO A NESSUN CORSO!</p>";
        }
        
    }
    //Studente
    else {

        //Genera tutte le tuple che lo studente partecipa ai corsi
        $q2 = "SELECT * FROM utente u JOIN partecipa p ON p.studente=u.email WHERE u.email=$1";
        $result2 = pg_query_params($dbconn, $q2, array($email));
        
        if(($row=pg_fetch_array($result2, null, PGSQL_ASSOC))){
            
            do {
                echo "<p>".$row['corso']."</p>";
            }  while ($row = pg_fetch_array($result2));
        }
        else{
            echo "<p>NON SEI ISCRITTO A NESSUN CORSO!</p>";
        }
    }
?>