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
    
    $q = "DELETE FROM corso WHERE link=$1";
    $result = pg_query_params($dbconn, $q, array($file));

    // Restituisce la risposta in formato JSON
    header("Content-Type: application/json");
    echo json_encode(array("success" => true));
    exit;
}
?>