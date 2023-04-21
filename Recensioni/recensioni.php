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

print_r($_SESSION);
  $stelle=$_POST['rating'];
  print_r($stelle);
  $descrizione=$_POST['FeedbackRecensione'];
  $data=date("Y-m-d H:i:s");

  $utente=$_SESSION['nome']." ".$_SESSION['cognome'];
    // TODO: inserire un controllo che mandi un allert se viene fatta più di una recensione al giorno
    // e modificare il formato nel database da date a varchar (forse)
    $query="INSERT INTO recensione (utente,data,stelle,descrizione) VALUES
                ($1, $2, $3, $4)";
    $res=pg_query_params($dbconn, $query, array($_SESSION['email'],$data,$stelle,$descrizione));
  
    if(!$res)
      echo"insert query non eseguita correttamente";
    else {
      echo"insert query eseguita correttamente";
      header("location: ../Logged/IndexLogged.php");
    }


  
?>
