<?php
  $q1 = "SELECT * 
          FROM utente 
          WHERE email=$1";

  $email = $_SESSION['email'];
  $result = pg_query_params($dbconn, $q1, array($email));
  $row = pg_fetch_array($result, null, PGSQL_ASSOC);

  echo "<br><img class='rounded-circle shadow-1-strong me-3 mb-2' src='./Profilo/img/".$row['immagine']."' alt='./Profilo/img/" . $row['immagine'] . "' width='65' height='65' />";
?>