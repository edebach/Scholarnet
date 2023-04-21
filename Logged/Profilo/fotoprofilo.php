<?php

$q1= "SELECT \"flagStudente\" as flag 
      FROM utente 
      WHERE email=$1" ;

$email = $_SESSION['email'];
$result = pg_query_params($dbconn, $q1, array($email));
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
// print_r($row);
$flagStudente = $row['flag'];
$sesso=$_SESSION['sesso'];
if($sesso=="Maschio"){
    if($flagStudente!=""){
        echo "./Profilo./img/studente.png";

    }
    else{
    echo "./Profilo./img/professore.png";
    }
}
else{
    if($sesso=="Femmina"){
        if($flagStudente!=""){
            echo "./Profilo./img/studentessa.png";
    
        }
        else{
        echo "./Profilo./img/professoressa.png";
        }
    }
    else{
        echo "./Profilo./img/neutro.png";
    }
}

?>