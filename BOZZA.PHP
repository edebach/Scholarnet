<?php
//$utente=$_SESSION['nome']." ".$_SESSION['cognome'];
$codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

//Query
$q = "SELECT * FROM compito WHERE classe=$1 ORDER BY pubblicazione DESC";
$result = pg_query_params($dbconn, $q, array($codice_corso));

if ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {

    do {
        //ANNUNCIO
        if (empty($row['data_scadenza'])) {
            echo "
					<div class='card text-black bg-light mb-3 d-inline-block'>
						<div class='card-body'>";
            if (!$_SESSION['flag'] or $row['email'] == $_SESSION['email'])
                echo "
						<div class='position-absolute top-0 end-0'>
                            <div class='dropdown'>
                                <button class='btn' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
								<i class='fa-solid fa-xmark fa-xs'></i>                                </button>
                                <ul class='dropdown-menu dropdown-menu-end'>
                                    <li>
                                        <div class='text-center'>
                                            <button class='btn btn-light d-inline-block mx-1 btn-elimina-annuncio' 
                                                    data-action='../Elimina/elimina-annuncio.php' 
													data-testo='" . $row['testo'] . "' 
													data-titolo='" . $row['titolo'] . "'
													data-corso='" . $codice_corso . "'
													>Elimina annuncio
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>";
            echo "<div class='card-text bg-light text-black' style='display: flex; align-items: center;'>
								<span style='font-size: 18px;'>
									<i class='fa-sharp fa-solid fa-scroll'></i>
									" . $row['titolo'] . "-" . $row['utente'] . "
								</span>
								<span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>" . date('d/m/Y', strtotime($row['pubblicazione'])) . "</span>
							</div>
							<hr>
							<div class='card-body'>
								<p class='card-text'>" . $row['testo'] . "</p>
								<p class='card-text ml-3'>Allegati: <a class='card-link text-black' href='#'>file1.pdf</a>, <a class='card-link text-black'href='#'>file2.docx</a></p>
							</div>
						</div>
						<footer class='card-footer'>
							<a href='#' class='card-link text-black'>Commenti (3)</a>
						</footer>
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
                                                    	>Elimina annuncio
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>";
            echo "


							<div style='display: flex; align-items: center;'>
								<span class='card-text bg-light text-black' style='font-size: 18px;'>
									<i class='fa-solid fa-book' style='font-size: 18px;'></i>
									" . $row['titolo'] . "-" . $row['utente'] . "
								</span>
								<span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>
									Data di pubblicazione: " . date('d/m/Y', strtotime($row['pubblicazione'])) . "
								</span>
							</div>
							<hr>
							<div class='card-body'>
								<p class='card-text'>" . $row['testo'] . "</p>
								<p class='card-text ml-3'>Allegati: <a class='card-link text-black' href='#'>file1.pdf</a>, <a class='card-link text-black'href='#'>file2.docx</a></p>
							</div>
							<hr>
								<p class='card-text' style='margin-left: 12px'>Data di consegna: " . date('d/m/Y', strtotime($row['data_scadenza'])) . "</p>
						</div>
						<footer class='card-footer'>
							<a href='#' class='card-link text-black'>Commenti (3)</a>
						</footer>
					</div>";

        }

    } while ($row = pg_fetch_array($result, null, PGSQL_ASSOC));



} else {
    echo "<p>Al momento non ci sono annunci.</p>";
}

?>