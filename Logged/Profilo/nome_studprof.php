<?php
echo "<h5>".$_SESSION['nome']." ".$_SESSION['cognome']."</h5>";
$q1= "SELECT \"flagStudente\" as flag 
      FROM utente 
      WHERE email=$1" ;

$email = $_SESSION['email'];
$result = pg_query_params($dbconn, $q1, array($email));
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
// print_r($row);
$flagStudente = $row['flag'];


if($flagStudente!=""){
    echo "<p>Studente</p>";
}
else{
    echo "<p>Professore</p>";
}




?>