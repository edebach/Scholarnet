<?php
  $q1 = "SELECT \"flagStudente\" as flag 
          FROM utente 
          WHERE email=$1";

  $email = $_SESSION['email'];
  $result = pg_query_params($dbconn, $q1, array($email));
  $row = pg_fetch_array($result, null, PGSQL_ASSOC);

  $flagStudente = $row['flag'];
  $sesso = $_SESSION['sesso'];

  echo "<br><img class='rounded-circle shadow-1-strong me-3 mb-2' src='./Profilo/img/".$_SESSION['immagine_profilo']."' alt='avatar' width='65' height='65' />";
?>