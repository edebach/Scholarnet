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
    if ($stelle=="0"){
        $sql = "SELECT * FROM recensione JOIN utente on utente.email=recensione.utente order by data DESC";
        $result = pg_query($conn, $sql);
    }
    else{
        $sql = "SELECT * FROM recensione JOIN utente on utente.email=recensione.utente WHERE stelle = $1 order by data DESC";
        $result = pg_query_params($conn, $sql, array($stelle));
    }
        // Esegui la query per recuperare le recensioni corrispondenti

    // Costruisci un array con le recensioni
    $recensioni = array();
    while ($row = pg_fetch_array($result)) {
        $recensioni[] = array(
            'utente' => $row['nome']." ".$row['cognome'],
            'data' => date('d/m/Y H:i:s', strtotime($row['data'])),
            'stelle' => $row['stelle'],
            'descrizione' => $row['descrizione'],
            'nome_recensione' => $row['nome_recensione'],
            'immagine' => $row['immagine']
        );
    }

    // Restituisci l'array come JSON
    header('Content-Type: application/json');
    echo json_encode($recensioni);

?>