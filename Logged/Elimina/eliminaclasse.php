<?php
    session_start();
    if (isset($_POST["elimina_classe"])) {
        // Elimina il file corrente
        $file = $_POST['link'];
        $codice_corso = $_POST['codice_corso'];
        unlink($file);
    
        // Elimina le tuple nel database associate alla classe

        //Connessione al dbname Scholarnet
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                    user=postgres password=biar") 
                    or die('Could not connect: ' . pg_last_error());
        
        //cancello tutti gli allegati caricati nella classe da cancellare
        $q1 = "SELECT allegati FROM compito where classe=$1";
        $result1 = pg_query_params($dbconn, $q1, array($codice_corso));

        
        $q = "DELETE FROM corso WHERE link=$1";
        $result2 = pg_query_params($dbconn, $q, array($file));
        
        while($row = pg_fetch_array($result1, null, PGSQL_ASSOC)){
            if(!empty($row['allegati'])){
                $percorso_file = "../../Allegati/" . $row['allegati'];
                unlink($percorso_file);
            }
        }
        // Restituisce la risposta in formato JSON
        header("Content-Type: application/json");
        echo json_encode(array("success" => true));
        exit;
}
?>