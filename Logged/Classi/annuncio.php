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
  $allegati=$_POST['allegati'];
  $utente=$_SESSION['nome']." ".$_SESSION['cognome'];

  if (isset($_POST['slider-compito']) && $_POST['slider-compito'] == 'on') {
    $data= $_POST['data'];
    $ora= $_POST['orario'];

    
    $q1="INSERT INTO compito (classe, titolo, testo, allegati, utente, data, ora)
             VALUES ($1, $2, $3, $4, $5, $6, $7)";
    $res=pg_query_params($dbconn, $q1, array($classe,$titolo,$testo,$allegati,$utente,$data,$ora));
  if(!$res)
      echo"errore di inserimento del post";
    else {
      $q2= "SELECT link FROM corso WHERE codice=$1";
      $res=pg_query_params($dbconn, $q2, array($classe));
      $link=pg_fetch_array($res);
      print_r($link);
      $redirect_link = $link[0];

      echo"post inserito correttamente";
      header("location: $redirect_link");

    }
  }
  else{
    echo"non viene riconosciuto il post";
  }
    
?>
