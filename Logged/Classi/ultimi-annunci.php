<?php
  $codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

  //Query
  $q = "SELECT * FROM compito c join utente u on c.email=u.email  WHERE classe=$1 ORDER BY pubblicazione DESC";
  $result = pg_query_params($dbconn, $q, array($codice_corso));

  // Calcola il numero totale di compiti per la classe
  $num_compiti = pg_num_rows($result);

  // Calcola il numero di pagine
  $num_pagine = ceil($num_compiti / 3);

  // Ottieni il numero di pagina corrente dalla query string
  $pagina_corrente = isset($_GET["pagina"]) ? $_GET["pagina"] : 1;

  // Calcola l'indice di partenza del subset di compiti da visualizzare
  $indice_inizio = ($pagina_corrente - 1) * 3;
  $i = 0;
  // Seleziona i 5 compiti più recenti per la pagina corrente
  if (pg_num_rows($result) > 0) {
    pg_result_seek($result, $indice_inizio);
    $row = pg_fetch_array($result, null, PGSQL_ASSOC);
    $count = 0;

    do {
      if (empty($row['allegati'])) {
        $percorso_file = null;
      } else {
        $percorso_file = "../../Allegati/" . $row['allegati'];
      }
      $nome_file = substr($row['allegati'], 4);
      $i++;
      $var = "collapse-" . $i;
      $var1 = "collapse-" . $i;
      //ANNUNCIO
      if (empty($row['data_scadenza'])) {

        echo "
          <div class='card text-black bg-light mb-3 d-inline-block'>
            <div class='card-body'>";
        
        if (!$_SESSION['flag'] or $row['email'] == $_SESSION['email']){
          echo "
            <div class='position-absolute top-0 end-0'>
              <div class='dropdown'>
                <button class='btn' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='fa-solid fa-xmark fa-xs'></i></button>
                <ul class='dropdown-menu dropdown-menu-end'>
                  <li>
                    <div class='text-center'>
                      <button class='btn btn-light d-inline-block mx-1 btn-elimina-annuncio' 
                          data-action='../Elimina/elimina-annuncio.php' 
                          data-testo='" . $row['testo'] . "' 
                          data-titolo='" . $row['titolo'] . "'
                          data-corso='" . $codice_corso . "'
                          data-allegati='" . $percorso_file . "'
                          >Elimina annuncio
                      </button>
                    </div>
                  </li>
                </ul>
              </div>
            </div>";
        }
        echo "<div class='card-text bg-light text-black' style='display: flex; align-items: center;'>
                <span style='font-size: 18px;'>
                  <i class='fa-sharp fa-solid fa-scroll'></i>";
                  if($row['flagStudente']=="t")
                  echo " ".$row['titolo'] . " - " . $row['utente'];
                  else
                  echo " ".$row['titolo'] . " - prof. " . $row['cognome'];
                  echo "
                </span>
                <span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>
                Data di pubblicazione: " . date('d/m/Y', strtotime($row['pubblicazione'])) . "</span>
              </div>
              <hr>
              <div class='card-body'>
                <p class='card-text'>" . $row['testo'] . "</p>
                ";
        if (!empty($row['allegati'])) {
          echo "<p class='card-text ml-3'> <a href='" . $percorso_file . "' target='_blank'>
                  <button type='button' class='btn btn-link allegato' style='text-decoration: none; padding: 5px; border-radius: 999px;'>
                    <i class='fas fa-file'></i> " . $nome_file . "
                  </button>
                </a></p>";
        }
        echo "
              </div>
            </div>
            ";



        // Commento in annunci
        echo "
              <div class='accordion ' id='div-commento-'" . $var . ">
                <div class='accordion-item'>
                  <h2 class='accordion-header'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#" . $var . "' aria-expanded='true' aria-controls='" . $var . "'>
                      Commenti &nbsp;
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-sticky' viewBox='0 0 16 16'>
                        <path d='M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zM2 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V8H9.5A1.5 1.5 0 0 0 8 9.5V14H2.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V9.5a.5.5 0 0 1 .5-.5h4.293L9 13.793z'/>
                      </svg>
                    </button>
                  </h2>
                  <div id='" . $var . "' class='accordion-collapse collapse' data-bs-parent='#div-commento-'" . $var . ">
                    <div class='accordion-body accordion-container'>";
        $pubb = $row['pubblicazione'];
        $titolo = $row['titolo'];

        //Restituisce tutti i commenti per quell'annuncio
        $q = "SELECT * 
                              FROM commento c1 JOIN compito c2 ON c1.pubblicazione=c2.pubblicazione AND c1.titolo=c2.titolo JOIN utente u ON u.email=c1.email
                              WHERE c1.pubblicazione=$1 AND c2.titolo=$2";

        $ris = pg_query_params($dbconn, $q, array($pubb, $titolo));

        if (($row1 = pg_fetch_array($ris, null, PGSQL_ASSOC))) {


          echo "<table cellpadding='5' cellspacing='15'>";
          do {
            echo "<tr>
                                    <td><img class='rounded-circle shadow-1-strong me-3' src='../Profilo/img/" . $row1['immagine'] . "' alt='avatar' width='35' height='35' /></td>
                                    <td><strong>" . $row1['nome'] . " " . $row1['cognome'] . " - </strong>" . date('d/m/Y H:i', strtotime($row1['data_commento'])) . "<br>" . $row1['descrizione'] . "</td>
                                    </tr>
                                  ";
          } while ($row1 = pg_fetch_array($ris, null, PGSQL_ASSOC));
          echo "
                          </table>";
        }

        echo "
                        <hr style='opacity:20%'>

                        <div class='m-3 d-flex align-items-center'>  
                          <img class='rounded-circle shadow-1-strong me-3' src='../Profilo/img/" . $_SESSION['immagine_profilo'] . "' alt='avatar' width='35' height='35' />
                          
                          <div class='input-group'>
                            <input type='text' class='form-control' name='descrizione' id='descrizione-commento" . $row['id_post'] . "' placeholder='Aggiungi un commento...'>
                            <button class='btn btn-outline-secondary btn-inserisci-commento'
                                    id = btn-inserisci-commento" . $row['id_post'] . "
                                    data-action='./commento.php' 
                                    data-id='" . $row['id_post'] . "'
                                    data-titolo='" . $row['titolo'] . "'
                                    data-pubblicazione='" . $row['pubblicazione'] . "'
                                    data-email='" . $_SESSION['email'] . "' disabled>
                              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-send' viewBox='0 0 16 16'>
                              <path d='M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z'/>
                              </svg>
                            </button>
                          </div>  
                          
                        </div>
                        
                            
                            
                        
                      </div>";

        echo " </div>
                              </div>
                            </div>
                          </div>";
      }
      //COMPITO
      else {
        echo "
          <div class='card text-black bg-light mb-3 d-inline-block'>
            <div class='card-body'>
            ";
        if (!$_SESSION['flag'])
          echo "
            <div class='position-absolute top-0 end-0'>
              <div class='dropdown'>
                <button class='btn' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='fa-solid fa-xmark fa-xs'></i>
                </button>
                <ul class='dropdown-menu dropdown-menu-end'>
                  <li>
                    <div class='text-center'>
                      <button class='btn btn-light d-inline-block mx-1 btn-elimina-annuncio' 
                          data-action='../Elimina/elimina-annuncio.php'
                          data-testo='" . $row['testo'] . "' 
                          data-titolo='" . $row['titolo'] . "'
                          data-corso='" . $codice_corso . "'
                          data-allegati='" . $percorso_file . "'													  
                            >Elimina compito
                      </button>
                    </div>
                  </li>
                </ul>
              </div>
            </div>";
        echo "
              <div style='display: flex; align-items: center;'>
                <span class='card-text bg-light text-black' style='font-size: 18px;'>
                  <i class='fa-solid fa-book' style='font-size: 18px;'></i>";
                  if ($row['flagStudente'] == "t")
                  echo " ".$row['titolo'] . " - " . $row['utente'];
                  else
                  echo " ".$row['titolo'] . " - prof. " . $row['cognome'];
                  echo"
                </span>
                <span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>
                  Data di pubblicazione: " . date('d/m/Y', strtotime($row['pubblicazione'])) . "
                </span>
              </div>
              <hr>
              <div class='card-body'>
                <p class='card-text'>" . $row['testo'] . "</p>
                ";
        if (!empty($row['allegati'])) {
          echo "<p class='card-text ml-3'> <a href='" . $percorso_file . "' target='_blank'>
                  <button type='button' class='btn btn-link allegato' style='text-decoration: none; padding: 5px; border-radius: 999px;'>
                    <i class='fas fa-file'></i> " . $nome_file . "
                  </button>
                </a></p>";
        }
        echo "
              </div>
              <hr>
                <p class='card-text' style='margin-left: 12px'>Data di consegna: " . date('d/m/Y', strtotime($row['data_scadenza'])) . "</p>
            </div>
            ";
        echo "
              <div class='accordion ' id='div-commento-'" . $var1 . ">
                <div class='accordion-item'>
                  <h2 class='accordion-header'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#" . $var1 . "' aria-expanded='true' aria-controls='" . $var1 . "'>
                      Commenti &nbsp;
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-sticky' viewBox='0 0 16 16'>
                        <path d='M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zM2 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V8H9.5A1.5 1.5 0 0 0 8 9.5V14H2.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V9.5a.5.5 0 0 1 .5-.5h4.293L9 13.793z'/>
                      </svg>
                    </button>
                  </h2>
                  <div id='" . $var1 . "' class='accordion-collapse collapse' data-bs-parent='#div-commento-'" . $var1 . ">
                    <div class='accordion-body accordion-container'>";

        $pubb = $row['pubblicazione'];
        $titolo = $row['titolo'];

        //Restituisce tutti i commenti per quell'annuncio
        $q1 = "SELECT * 
                  FROM commento c1 JOIN compito c2 ON c1.pubblicazione=c2.pubblicazione AND c1.titolo=c2.titolo JOIN utente u ON u.email=c1.email
                  WHERE c1.pubblicazione=$1 AND c2.titolo=$2";

        $ris1 = pg_query_params($dbconn, $q1, array($pubb, $titolo));

        if (($row2 = pg_fetch_array($ris1, null, PGSQL_ASSOC))) {

          echo "<table cellpadding='5' cellspacing='15'>";
          do {
            echo "<tr>
                        <td><img class='rounded-circle shadow-1-strong me-3' src='../Profilo/img/" . $row2['immagine'] . "' alt='avatar' width='35' height='35' /></td>
                        <td><strong>" . $row2['nome'] . " " . $row2['cognome'] . " - </strong>" . date('d/m/Y H:i', strtotime($row2['data_commento'])) . "<br>" . $row2['descrizione'] . "</td>
                      </tr>";
          } while ($row2 = pg_fetch_array($ris1, null, PGSQL_ASSOC));
          echo "
              </table>";
        }

        echo "
                        <hr style='opacity:20%'>

                        <div class='m-3 d-flex align-items-center'>  
                          <img class='rounded-circle shadow-1-strong me-3' src='../Profilo/img/" . $_SESSION['immagine_profilo'] . "' alt='avatar' width='35' height='35' />
                          
                          <div class='input-group'>
                            <input type='text' class='form-control' name='descrizione' id='descrizione-commento" . $row['id_post'] . "' placeholder='Aggiungi un commento...'>
                            <button class='btn btn-outline-secondary btn-inserisci-commento'
                                    id = btn-inserisci-commento" . $row['id_post'] . "
                                    data-action='./commento.php' 
                                    data-id='" . $row['id_post'] . "'
                                    data-titolo='" . $row['titolo'] . "'
                                    data-pubblicazione='" . $row['pubblicazione'] . "'
                                    data-email='" . $_SESSION['email'] . "' disabled>
                              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-send' viewBox='0 0 16 16'>
                              <path d='M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z'/>
                              </svg>
                            </button>
                          </div>  
                          
                        </div>
                        
                            
                            
                        
                      </div>";

        echo " </div>
                              </div>
                            </div>
                          </div>";

      }
      $count++;

    } while (($row = pg_fetch_array($result, null, PGSQL_ASSOC)) and $count < 3);

    // Mostra l'elenco di numeri di pagina per la paginazione
    echo "<nav aria-label='Page navigation example'>
        <ul class='pagination '>";
    for ($pagina = 1; $pagina <= $num_pagine; $pagina++) {
      if ($pagina == $pagina_corrente) {
        echo "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";
      } else {
        echo "<li class='page-item'><a class='page-link' href='?pagina=$pagina'>$pagina</a></li>";
      }
    }
    echo "</ul></nav>";
  } else {
    echo "<p>Al momento non ci sono annunci.</p>";
  }
?>