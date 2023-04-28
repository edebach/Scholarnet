<?php
    session_start();
    
        $file = $_POST['link'];
        // Elimina le tuple nel database associate alla tabella partecipa
     
        //Connessione al dbname Scholarnet
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                    user=postgres password=biar") 
                    or die('Could not connect: ' . pg_last_error());
        
        //Prima query che restituisce il codice_corso che sono associate al link
        $q1 = "SELECT c.codice FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE link=$1";
        $result1 = pg_query_params($dbconn, $q1, array($file));

        if($row1=pg_fetch_array($result1, null, PGSQL_ASSOC)){
            $codice_corso = $row1['codice'];
        }

        //Seconda query che elimina la tupla con il codice_corso nella tabella partecipa
        $q2 = "DELETE FROM partecipa WHERE corso=$1";
        $result2 = pg_query_params($dbconn, $q2, array($codice_corso));

        
        // Restituisce la risposta in formato JSON
        header("Content-Type: application/json");
        echo json_encode(array("success" => true));
        exit;
    


?>