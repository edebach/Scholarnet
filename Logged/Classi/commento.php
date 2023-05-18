<?php

  if (isset($_POST["inserisci_commento"])) {
    $descrizione = $_POST['descrizione'];
    $email = $_POST['email'];
    $pubblicazione = $_POST['pubblicazione'];
    $titolo = $_POST['titolo'];
    $data_commento = date("d-m-Y H:i:s");

    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                  user=postgres password=biar")
      or die('Could not connect: ' . pg_last_error());

    //Inserimento del commento
    $q = "INSERT INTO commento VALUES ($1, $2, $3, $4,$5)";
    $ris = pg_query_params($dbconn, $q, array($email, $descrizione, $pubblicazione, $titolo, $data_commento));

    // Restituisce la risposta in formato JSON
    header("Content-Type: application/json");
    echo json_encode(array("success" => true));
    exit;
  }

?>