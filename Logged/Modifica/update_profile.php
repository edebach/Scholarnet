<?php
    session_start();
    //Connessione al dbname Scholarnet
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /");
    } else {
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                        user=postgres password=biar")
            or die('Could not connect: ' . pg_last_error());
    }

    $email = $_SESSION['email'];
    $telefono = $_POST['telefono'];

    // Query per aggiornare il profilo dell'utente nel database
    $update_query = "UPDATE utente SET  telefono='$telefono' WHERE email=$1";
    $result = pg_query_params($dbconn, $update_query, array($email));

    if ($result) {
        // Aggiorna le informazioni di sessione
        $_SESSION["telefono"] = $telefono;
        // Restituisce la risposta in formato JSON
        header("Content-Type: application/json");
        echo json_encode(array("success" => true));
        exit;
    } else {
        echo "Errore nell'aggiornamento del profilo: " . pg_last_error($dbconn);
    }
?>