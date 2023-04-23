<?php
    
    // Connessione al database
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /");
    }
    else {
        $conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar") 
                or die('Could not connect: ' . pg_last_error());
    }

    // Recupera il numero di stelle selezionato
    $stelle = $_POST['stelle'];
    
    // Esegui la query per recuperare le recensioni corrispondenti
    $sql = "SELECT * FROM recensione WHERE stelle = $1";
    $result = pg_query_params($conn, $sql, array($stelle));

    // Costruisci un array con le recensioni
    $recensioni = array();
    while ($row = pg_fetch_array($result)) {
        $recensioni[] = array(
            'utente' => $row['utente'],
            'data' => $row['data'],
            'stelle' => $row['stelle'],
            'descrizione' => $row['descrizione']
        );
    }

    // Restituisci l'array come JSON
    header('Content-Type: application/json');
    echo json_encode($recensioni);

?>