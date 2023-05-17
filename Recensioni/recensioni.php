<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
  } else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar")
      or die('Could not connect: ' . pg_last_error());
  }

  $nomeRecensione = $_POST['nomeRecensioneInput'];
  $stelle = $_POST['rating1'];

  $descrizione = $_POST['FeedbackRecensione'];
  $data = date("Y-m-d H:i:s");

  $utente = $_SESSION['nome'] . " " . $_SESSION['cognome'];

  $query = "INSERT INTO recensione (utente,data,stelle,descrizione,nome_recensione) VALUES
                  ($1, $2, $3, $4, $5)";
  $res = pg_query_params($dbconn, $query, array($_SESSION['email'], $data, $stelle, $descrizione, $nomeRecensione));

  if (!$res)
    echo "insert query non eseguita correttamente";
  else {
    echo "insert query eseguita correttamente";
    header("location: ../Logged/IndexLogged.php");
  }
?>