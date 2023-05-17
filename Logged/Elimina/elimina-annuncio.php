<?php
    session_start();
    if (isset($_POST["elimina_annuncio"])) {

        $codice_corso=$_POST['corso'];
        $titolo=$_POST['titolo'];
        $testo=$_POST['testo'];
        // Elimina le tuple nel database associate all'annuncio

        //Connessione al dbname Scholarnet
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                    user=postgres password=biar") 
                    or die('Could not connect: ' . pg_last_error());
        
        $q = "DELETE FROM compito WHERE classe=$1 AND titolo=$2 AND testo=$3";
        $result = pg_query_params($dbconn, $q, array($codice_corso,$titolo,$testo));
        if(!empty($_POST['allegati'])){
            $file = $_POST['allegati'];
            unlink($file);
        }

        // Restituisce la risposta in formato JSON
        header("Content-Type: application/json");
        echo json_encode(array("success" => true));
        exit;
    }
?>