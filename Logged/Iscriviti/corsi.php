<?php

//Connessione al db

$dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
              user=postgres password=biar")
  or die('Could not connect: ' . pg_last_error());


$email = $_SESSION['email'];
$flag = $_SESSION['flag'];

// Controlliamo se si tratta di uno studente o docente: 
// Nel caso il flag sia 0 si trattadi un docente, nel caso in cui è 1 di uno studente
if ($flag == '0') { // Docente

  //Genera tutte le tuple dove il docente insegna in dei corsi
  $q1a = "SELECT * FROM corso c JOIN insegna i ON c.codice=i.corso WHERE i.docente=$1";
  $result1a = pg_query_params($dbconn, $q1a, array($email));
  $var = 0; //variabile che mi servirà per verificare se un docente partecipa o insegna dei corsi


  if ($row1 = pg_fetch_array($result1a, null, PGSQL_ASSOC)) {
    $var = 1;
    echo "<div class='row'>";
    do {
      //Parte l'interfaccia grafica: implementazione delle card corso
      echo "        
                  <div class='card' style='width: 18rem;'>
                      <div class='position-relative'>
                          <img src='" . $row1['link_imm'] . "' class='card-img-top'>
                          <div class='position-absolute top-0 end-0'>
                              <div class='dropdown'>
                                  <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                  <i class='bi bi-three-dots-vertical'></i>
                                  </button>
                                  <ul class='dropdown-menu dropdown-menu-end'>
                                      <li>
                                          <div class='text-center'>
                                              <button class='btn btn-light d-inline-block mx-1 btn-elimina-classe' 
                                                      id='btn-elimina-classe-" . $row1['link'] . "' 
                                                      data-classe='" . substr($row1['link'], -12, -4) . "'
                                                      data-action='./Elimina/eliminaclasse.php'  
                                                      data-href='" . $row1['link'] . "'>Elimina classe
                                              </button>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class='card-body'>
                          <h5 class='card-title'><a href='./Logged/" . $row1['link'] . "'>" . $row1['nome'] . "</a></h5>
                          <p class='card-text'>" . $row1['materia'] . "</p>
                      </div>
                  </div>";

    } while ($row1 = pg_fetch_array($result1a));

  }


  //Genera tutte le tuple che il docente partecipa ai corsi
  $q1b = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
  $result1b = pg_query_params($dbconn, $q1b, array($email));


  if ($row2 = pg_fetch_array($result1b, null, PGSQL_ASSOC)) {
    $var = 1;
    echo "<div class='row'>";
    do {
      //Parte l'interfaccia grafica: implementazione delle card corso
      echo "        
                  <div class='card' style='width: 18rem;'>
                      <div class='position-relative'>
                          <img src='" . $row2['link_imm'] . "' class='card-img-top'>
                          <div class='position-absolute top-0 end-0'>
                              <div class='dropdown'>
                                  <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                  <i class='bi bi-three-dots-vertical'></i>
                                  </button>
                                  <ul class='dropdown-menu dropdown-menu-end'>
                                      <li>
                                          <div class='text-center'>
                                              <button class='btn btn-light d-inline-block mx-1 btn-elimina-classe' 
                                                      id='btn-elimina-classe-" . $row2['link'] . "' 
                                                      data-classe='" . substr($row2['link'], -12, -4) . "'
                                                      data-action='./Elimina/eliminaclasse.php'  
                                                      data-href='" . $row2['link'] . "'>Elimina classe
                                              </button>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class='card-body'>
                          <h5 class='card-title'><a href='./Logged/" . $row2['link'] . "'>" . $row2['nome'] . "</a></h5>
                          <p class='card-text'>" . $row2['materia'] . "</p>
                      </div>
                  </div>";

    } while ($row2 = pg_fetch_array($result1b));

    echo "</div>";
  }

  if ($var == 0) {
    echo "<p>Non sei iscritto a nessun corso.</p>";
  }
} else { //Studente
  //Genera tutte le tuple che rappresentano i corsi a cui partecipa lo studente
  $q2 = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
  $result2 = pg_query_params($dbconn, $q2, array($email));

  if (($row3 = pg_fetch_array($result2, null, PGSQL_ASSOC))) {
    echo "<div class='row'>";
    do {
      //Parte l'interfaccia grafica: implementazione delle card corso
      echo "        
                  <div class='card' style='width: 18rem;'>
                      <div class='position-relative'>
                          <img src='" . $row3['link_imm'] . "' class='card-img-top'>
                          <div class='position-absolute top-0 end-0'>
                              <div class='dropdown'>
                                  <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                  <i class='bi bi-three-dots-vertical'></i>
                                  </button>
                                  <ul class='dropdown-menu dropdown-menu-end'>
                                      <li>
                                          <div class='text-center'>
                                              <button class='btn btn-light d-inline-block mx-1 btn-annulla-iscrizione' 
                                                      id='btn-annulla-iscrizione-" . $row3['link'] . "'
                                                      data-action='./Elimina/annulla-iscrizione.php'
                                                      data-href='" . $row3['link'] . "'>
                                                      Annulla iscrizione
                                              </button>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class='card-body'>
                          <h5 class='card-title'><a href='./Logged/" . $row3['link'] . "'>" . $row3['nome'] . "</a></h5>
                          <p class='card-text'>" . $row3['materia'] . "</p>
                      </div>
                  </div>";

    } while ($row3 = pg_fetch_array($result2));
    echo "</div>";
  } else {
    echo "<p>Non sei iscritto a nessun corso.</p>";
  }
}
?>