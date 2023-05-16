<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
  }
  else {
      $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
              user=postgres password=biar") 
              or die('Could not connect: ' . pg_last_error());
  }

  $classe = $_POST['classe'];
  $titolo = $_POST['titolo'];
  $testo=$_POST['testo'];
  $utente=$_SESSION['nome']." ".$_SESSION['cognome'];
  $data_scadenza= null;
  $ora=null;
  $allegati=null;
  $email=$_SESSION['email'];

  if (isset($_POST['slider-compito']) && $_POST['slider-compito'] == 'on') {
    $data_scadenza= $_POST['data_scadenza'];
    $ora= $_POST['orario'];
  }
  
  $pubblicazione = date('d-m-Y H:i:s');

  if (isset($_FILES['allegati']) && $_FILES['allegati']['error'] == UPLOAD_ERR_OK) {
    $allegati = mt_rand(1000, 9999) . $_FILES['allegati']['name'];
    $uploadDir = '../../Allegati/'; // directory in cui salvare i file
    $fileName = basename($allegati);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['allegati']['tmp_name'], $uploadFile)) {
      echo 'Il file è stato caricato con successo.';
    } else {
      echo 'Si è verificato un errore durante il caricamento del file.';
    }
  }
 

  do {
    $id_post = mt_rand(1, 99999999);
    $q1 = "SELECT * FROM compito WHERE id_post=$1";
    $result = pg_query_params($dbconn, $q1, array($id_post));

  } while (($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)));
  

    $q1="INSERT INTO compito (classe, titolo, testo, allegati, utente, data_scadenza, ora, pubblicazione,email, id_post)
             VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
    $res=pg_query_params($dbconn, $q1, array($classe,$titolo,$testo,$allegati,$utente,$data_scadenza,$ora,$pubblicazione,$email, $id_post));
  if(!$res)
      echo"errore di inserimento del post";
    else {
      $q2= "SELECT link FROM corso WHERE codice=$1";
      $res=pg_query_params($dbconn, $q2, array($classe));
      $link=pg_fetch_array($res);
      $redirect_link = $link[0];

      echo"post inserito correttamente";
      header("location: $redirect_link");

    }

    
    
?>
