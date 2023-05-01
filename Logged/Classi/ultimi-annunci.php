<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<title>Ultimi annunci</title>

	<style>
		iframe{
            width:550px; 
            height:400px;
            border:1cm;
        }
	</style>

	 <!--Script elimina_classe-->
	 <script>
		$(document).ready(function() {
			$(".btn-elimina-annuncio").click(function() {
				if (confirm("Sei sicuro di voler eliminare il post?")) {
					var url = $(this).data("action");
					var titolo = $(this).data("titolo");
					var testo = $(this).data("testo");
					var corso = $(this).data("corso");
					console.log(titolo);
					console.log(testo);
					console.log(corso);

					$.ajax({
						url: url,
						type: 'post',
						data: { elimina_annuncio: true, 
								testo: testo, corso:corso, titolo:titolo },
						dataType: 'json',
						success: function(data) {
							if (data.success) {
								alert("Annuncio eliminato correttamente.");
								location.reload(); // Ricarica la pagina
							} else {
								console.log(data.message);
								alert("Errore durante l'eliminazione dell\' annuncio.");
							}
						},
						error: function(jqXHR, status, error) {
							console.log(status + ": " + error);
							alert("Errore durante l\'eliminazione della classe.");
						}
					});
				}
			});
		});
	</script>
</head>
<body>
	<?php
		$utente=$_SESSION['nome']." ".$_SESSION['cognome'];
		$codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

		//Query
		$q = "SELECT * FROM compito WHERE classe=$1";
		$result = pg_query_params($dbconn, $q, array($codice_corso));

		if($row=pg_fetch_array($result, null, PGSQL_ASSOC)){

			do{ 
				//ANNUNCIO
				if(empty($row['data_scadenza'])){
					echo "
					<div class='card text-black bg-light mb-3 d-inline-block'>
						<div class='card-body'>";
						if(!$_SESSION['flag']) echo "
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
						if(!$_SESSION['flag']) echo "
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
								<span style='margin-left: auto; font-size: 18px;'>
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

			} while($row=pg_fetch_array($result, null, PGSQL_ASSOC));



		}
		else{
			echo "<p>Al momento non ci sono annunci.</p>";
		}

	?>
	<!--COMPITO-->
	<!--<div class="card text-black bg-light mb-3 d-inline-block">
		<div class="card-body">
			<div style="display: flex; align-items: center;">
				<span class="card-text bg-light text-black" style="font-size: 20px;">
				<i class="fa-solid fa-book" style="font-size: 20px;"></i>
				Compito
				</span>
				<span style="margin-left: auto; font-size: 18px;">
					Data di pubblicazione: 01/01/2022
				</span>
			</div>
			<hr>
			<div class="card-body">
				<p class="card-text">Testo dell'annuncio</p>
				<p class="card-text ml-3">Allegati: <a class="card-link text-black" href="#">file1.pdf</a>, <a class="card-link text-black"href="#">file2.docx</a></p>
			</div>
			<hr>
				<p class="card-text" style="margin-left: 18px">Data di consegna: 01/01/2022</p>
		</div>
		<footer class="card-footer">
			<a href="#" class="card-link text-black">Commenti (3)</a>
		</footer>
	</div>-->

	<!--ANNUNCIO-->
	<!--<div class="card text-black bg-light mb-3 d-inline-block">
		<div class="card-body">
			<div class="card-text bg-light text-black" style="display: flex; align-items: center;">
				<span style="font-size: 20px;">
					<i class="fa-sharp fa-solid fa-scroll"></i>
					Annuncio
				</span>
				<span style="margin-left: auto; font-size: 18px;">
					Data di pubblicazione: 01/01/2022
				</span>
			</div>
			<hr>
			<div class="card-body">
				<p class="card-text">Testo dell'annuncio</p>
				<p class="card-text ml-3">Allegati: <a class="card-link text-black" href="#">file1.pdf</a>, <a class="card-link text-black"href="#">file2.docx</a></p>
			</div>
		</div>
		<footer class="card-footer">
			<a href="#" class="card-link text-black">Commenti (3)</a>
		</footer>
	</div>-->

</body>
</html>