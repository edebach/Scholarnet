<?php
    //connessione al db
    $conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar") 
                or die('Could not connect: ' . pg_last_error());
    
    //recupera il valore di search, %: la parola ricercata si può trovare in qualsiasi punto del testo o titolo
    $searchText = '%' . $_POST['searchText'] . '%';
    $utente = $_POST['utente'];
    $codice_corso = $_POST['codice_corso'];
    $flag = $_POST['flag'];


    // Query
    $sql = "SELECT * FROM compito WHERE testo LIKE $1 OR titolo LIKE $1 ORDER BY pubblicazione DESC";
    $result = pg_query_params($conn, $sql, array($searchText));

    if($row = pg_fetch_array($result)){
        do{
            //ANNUNCIO
				if(empty($row['data_scadenza'])){
					echo "
					<div class='card text-black bg-light mb-3 d-inline-block'>
						<div class='card-body'>";
						if(!$flag) echo "
						<div class='position-absolute top-0 end-0'>
                            <div class='dropdown'>
                                <button class='btn' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
								<i class='fa-solid fa-xmark fa-xs'></i>                                </button>
                                <ul class='dropdown-menu dropdown-menu-end'>
                                    <li>
                                        <div class='text-center'>
                                            <button class='btn btn-light d-inline-block mx-1 btn-elimina-annuncio' 
                                                    data-action='../Elimina/elimina-annuncio.php' 
													data-testo='".$row['testo']."' 
													data-titolo='".$row['titolo']."'
													data-corso='".$codice_corso."'
													>Elimina annuncio
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>";
						echo	"<div class='card-text bg-light text-black' style='display: flex; align-items: center;'>
								<span style='font-size: 18px;'>
									<i class='fa-sharp fa-solid fa-scroll'></i>
									".$row['titolo']."-".$utente."
								</span>
								<span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>".date('d/m/Y', strtotime($row['pubblicazione']))."</span>
							</div>
							<hr>
							<div class='card-body'>
								<p class='card-text'>".$row['testo']."</p>
								<p class='card-text ml-3'>Allegati: <a class='card-link text-black' href='#'>file1.pdf</a>, <a class='card-link text-black'href='#'>file2.docx</a></p>
							</div>
						</div>
						<footer class='card-footer'>
							<a href='#' class='card-link text-black'>Commenti (3)</a>
						</footer>
					</div>";
				}
				//COMPITO
				else{
					echo "
					<div class='card text-black bg-light mb-3 d-inline-block'>
						<div class='card-body'>
						";
						if(!$flag) echo "
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
													data-testo='".$row['testo']."' 
													data-titolo='".$row['titolo']."'
													data-corso='".$codice_corso."'													  
                                                    	>Elimina annuncio
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>";
						echo	"


							<div style='display: flex; align-items: center;'>
								<span class='card-text bg-light text-black' style='font-size: 18px;'>
									<i class='fa-solid fa-book' style='font-size: 18px;'></i>
									".$row['titolo']."-".$utente."
								</span>
								<span style='margin-left: auto; margin-top: 3px; font-size: 12px;'>
									Data di pubblicazione: ".date('d/m/Y', strtotime($row['pubblicazione']))."
								</span>
							</div>
							<hr>
							<div class='card-body'>
								<p class='card-text'>".$row['testo']."</p>
								<p class='card-text ml-3'>Allegati: <a class='card-link text-black' href='#'>file1.pdf</a>, <a class='card-link text-black'href='#'>file2.docx</a></p>
							</div>
							<hr>
								<p class='card-text' style='margin-left: 12px'>Data di consegna: ".date('d/m/Y', strtotime($row['data_scadenza']))."</p>
						</div>
						<footer class='card-footer'>
							<a href='#' class='card-link text-black'>Commenti (3)</a>
						</footer>
					</div>";
                }

        }while($row = pg_fetch_array($result));
    }
    else{
        echo "<p>Non ci sono messaggi.</p>";
    }
    


?>