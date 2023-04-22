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

    // Costruisci l'HTML con le recensioni
    $html = '';
    if (!($row=pg_fetch_array($result))) {
        while($row=pg_fetch_array($result)) {
            $html .= '<div class="recensione">';
            $html .= '<p>Utente: ' . $row['utente'] . '</p>';
            $html .= '<p>Data: ' . $row['data'] . '</p>';
            $html .= '<p>Stelle: ' . $row['stelle'] . '</p>';
            $html .= '<p>Descrizione: ' . $row['descrizione'] . '</p>';
            $html .= '</div>';
        }
    } else {
        $html .= '<p>Nessuna recensione trovata per ' . $stelle . ' stelle.</p>';
    }

    // Restituisci l'HTML
    echo $html;
?>