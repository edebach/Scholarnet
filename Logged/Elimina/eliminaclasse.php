<?php
session_start();
if (isset($_POST["elimina_classe"])) {
    // Elimina il file corrente
    $file = $_POST['link'];
    unlink($file);
 
    // Elimina le tuple nel database associate alla classe

    //Connessione al dbname Scholarnet
    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar") 
                or die('Could not connect: ' . pg_last_error());
    
    $q0="SELECT codice FROM corso WHERE link=$1";
    $result = pg_query_params($dbconn, $q0, array($file));
    $row = pg_fetch_array($result);
    $codice_corso = $row["codice"];

    $q1 = "DELETE FROM insegna WHERE corso=$1";
    $result = pg_query_params($dbconn, $q1, array($codice_corso));
    if (pg_affected_rows($result) < 1) {
        // La query non ha modificato alcuna riga
        header("Content-Type: application/json");
        echo json_encode(array("success" => false, "message" => "Errore nella cancellazione dei docenti del corso."));
        exit;
    }
    $q2 = "DELETE FROM partecipa WHERE corso=$1";
    $result = pg_query_params($dbconn, $q2, array($codice_corso));


    $q3 = "DELETE FROM compito WHERE classe=$1";
    $result = pg_query_params($dbconn, $q3, array($codice_corso));

    
    $q4 = "DELETE FROM corso WHERE codice=$1";
    $result = pg_query_params($dbconn, $q4, array($codice_corso));
    if (pg_affected_rows($result) < 1) {
        // La query non ha modificato alcuna riga
        header("Content-Type: application/json");
        echo json_encode(array("success" => false, "message" => "Errore nella cancellazione del corso."));
        exit;
    }

    // Restituisce la risposta in formato JSON
    header("Content-Type: application/json");
    echo json_encode(array("success" => true));
    exit;
}
?>