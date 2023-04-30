<!DOCTYPE html>
<html lang="it">
<head>
	<?php
	session_start();
	$dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
              user=postgres password=biar") 
              or die('Could not connect: ' . pg_last_error());
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Classe</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Carica Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	
	<style>
		.card {
		width: 600px;
		}

	</style>


	<script>
			$(document).ready(function() {
				// Nascondi tutte le sezioni tranne quella iniziale ("Stream")
				$("#compiti-section, #persone-section").hide();

				// Gestisci il click sui bottoni
				$(".nav-link").click(function(event) {
					event.preventDefault();
					// Nascondi tutte le sezioni
					$("#stream-section, #compiti-section, #persone-section").hide();
					// Mostra la sezione corrispondente al bottone selezionato
					$($(this).attr("href")).show();
				});
			});
	</script>

	<script>
		$(document).ready(function() {
			$('#show-form-btn').click(function() {
				$('#annuncio-form').toggleClass('show');
				$(this).fadeOut('600');
		});
		$('#ret-form-btn').click(function() {
				$('#annuncio-form').toggleClass('show');
				$('#show-form-btn').fadeIn('600');
		});



			// $('#annuncio-form').submit(function(event) {
			// event.preventDefault();
			// // Qui puoi aggiungere il codice per inviare l'annuncio al server
			// $('.card-body').removeClass('show');
			// });
		});
    </script>
  	<script>
		$(document).ready(function() {
			const mySwitch = document.getElementById("slider-compito");
			$('#data-div').hide();
			$('#ora-div').hide();

			mySwitch.addEventListener("change", function() {
			if (this.checked) {
				$('#data-div').fadeIn('1000');
				$('#ora-div').fadeIn('1000');

			} else {
				$('#data-div').fadeOut('1000');
				$('#ora-div').fadeOut('1000');
			}
			});
		});
	</script>

	<style>
		.navbar-brand {
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		text-align: center;
		}
		
	</style>
	<script>
		function copy() {
			// seleziona l'elemento che contiene il testo da copiare
			const paragrafo = document.querySelector('.card-text');

			// crea un nuovo elemento di tipo textarea
			const textarea = document.createElement('textarea');

			// imposta il valore del textarea al testo del paragrafo
			textarea.value = paragrafo.textContent;

			// aggiungi il textarea alla pagina, ma fuori dalla visualizzazione
			textarea.setAttribute('readonly', '');
			textarea.style.position = 'absolute';
			textarea.style.left = '-9999px';
			document.body.appendChild(textarea);

			// seleziona il contenuto del textarea
			textarea.select();

			// copia il contenuto selezionato negli appunti
			document.execCommand('copy');

			// rimuovi il textarea dalla pagina
			document.body.removeChild(textarea);

			alert('Testo copiato negli appunti!');
		}

	</script>

	<script>
		function toggleFieldDataOra() {
			var slider = document.getElementById("slider-compito");
			var dataInput = document.getElementById("data");
			var oraInput = document.getElementById("orario");

			if (slider.checked) {
				dataInput.setAttribute("required", "");
				oraInput.setAttribute("value", "23:59");
			} else {
				dataInput.removeAttribute("required");
				oraInput.removeAttribute("value");
			}
		}
	</script>

	<style>
		#codiceCliccabile:hover {
			
			color: blue;
        	position: relative

		}
	</style>

</head>
<body>
	<!-- TODO: bisogna risolvere il bug della navbar quando si va mette lo schermo intero -->
	<header>
		<nav class="navbar nav navbar-dark bg-dark">
			<div class="container-fluid">
				<div class="d-flex align-items-center">
					<button class="navbar-toggler ms-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
						<span class="navbar-toggler-icon"></span>
						<span class="visually-hidden">Toggle navigation</span>
					</button>
				
					<a class="navbar-brand text-center" href="#">Nome del corso</a>
				</div>
				<button class="btn btn-link rounded-circle text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#profile">
					<i class="fa-sharp fa-regular fa-user fa-lg"></i>
				</button>
				<div class="offcanvas offcanvas-end" tabindex="-1" id="profile" aria-labelledby="profile-label">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="profile-label">Il mio profilo</h5>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<!-- TODO: Qui puoi inserire il contenuto della finestra con le informazioni del tuo profilo -->
						<!-- Possiamo inserire direttamente il file profilo all'interno del tab, creerei una versione
						alternativa minimizzata da mettere qui e una completa da lasciare a parte se si vuole senno la eliminiamo -->
						<!--php include '../profilo.html'; ?> -->
					</div>
				</div>
				<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebar-label">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="sidebar-label">Le mie classi</h5>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<nav class="navbar navbar-white bg-white">
							<ul class="navbar-nav d-block"> <!-- Aggiunta classi d-flex e flex-row -->
								<!-- Inserimento pulsante "Home" -->
								<li class="nav-item">
									<button class="btn btn-outline-info d-inline-block mx-1" id="btn-ritorna-index" 
									onClick="window.location.href='../IndexLogged.php'">Home</button>
								</li>
								<!-- TODO: Qui dobbiamo inserire l'elenco delle classi le classi -->
								<?php
									
									$email = $_SESSION['email'];
									//STUDENTE
									if($_SESSION['flag']=='1'){
										//Genera tutte le tuple che lo studente partecipa ai corsi
										$q1 = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
										$result1 = pg_query_params($dbconn, $q1, array($email));
										
										
										
										if($row1=pg_fetch_array($result1, null, PGSQL_ASSOC)){
											do{

												$path = $row1['link'];
												$file = './' . basename($path);
												//Parte il layout
												echo "	<br>
														<li class='nav-item'>
															<button type='button' class='btn btn-outline-info d-inline-block mx-1'
																	onClick=window.location.href='".$file."'>".$row1['nome']."</button>
														</li>
													";
												
											}while($row1=pg_fetch_array($result1, null, PGSQL_ASSOC));
										}
									}
									//DOCENTE
									else{

										//Genera tutte le tuple che il docente insegna ai corsi
										$q1a = "SELECT * FROM corso c JOIN insegna i ON c.codice=i.corso WHERE i.docente=$1";
										$result1a = pg_query_params($dbconn, $q1a, array($email));
										$var=0; //variabile che mi servirà per verificare se un docente partecipa o insegna dei corsi

										if($row2=pg_fetch_array($result1a, null, PGSQL_ASSOC)){

											do {
												$path = $row2['link'];
												$file = './' . basename($path);
												//Parte il layout
												echo "	<br>
														<li class='nav-item'>
															<button type='button' class='btn btn-outline-info d-inline-block mx-1'
																	onClick=window.location.href='".$file."'>".$row2['nome']."</button>
														</li>
													";
											}while($row2=pg_fetch_array($result1a, null, PGSQL_ASSOC));
										}

										//Genera tutte le tuple che il docente partecipa ai corsi
										$q1b = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
										$result1b = pg_query_params($dbconn, $q1b, array($email));

									
										if($row3=pg_fetch_array($result1b, null, PGSQL_ASSOC)){
											
											do {
												$path = $row3['link'];
												$file = './' . basename($path);
												//Parte il layout
												echo "	<br>
														<li class='nav-item'>
															<button type='button' class='btn btn-outline-info d-inline-block mx-1'
																	onClick=window.location.href='".$file."'>".$row3['nome']."</button>
														</li>
													";

											} while($row3=pg_fetch_array($result1b, null, PGSQL_ASSOC));
										}

									}
									
									/*
									// Inserimento dell'elenco delle classi
									$email = $_SESSION["email"];
									if (($_SESSION["flag"]) == "0") {
										$q1 = "SELECT corso.nome, corso.link FROM insegna JOIN corso ON insegna.corso = corso.codice WHERE insegna.docente = $1";
									} else {
										$q1 = "SELECT corso.nome, corso.link FROM partecipa JOIN corso ON partecipa.corso = corso.codice WHERE partecipa.studente = $1";
									}
									$result = pg_query_params($dbconn, $q1, array($_SESSION['email']));
									$classe = array();
									while ($row = pg_fetch_array($result)) {
										$nome = $row["nome"];
										$link = $row["link"];
										echo ""; //TODO:Questa è la riga sove insserire le varie cartelle con le classi
									// idea non funzionante (da inserire ddentro echo):
									// <li><div class='col-sm-6'>
									// 	<div class='card bg-light mb-3'>
									// 	<div class='card-body'>
									// 		<h5 class='card-title'>
									// 		<a href=' $link' class='text-primary'>
									// 			<i class='fas fa-chalkboard-teacher fa-lg mr-2'></i>
									// 			$nome
									// 		</a>
									// 		</h5>
									// 	</div>
									// 	</div>
									// </div>
									// </li>
									
									}*/
									?>

							</ul>
						</nav>
					</div>
				</div>
			</div>
		</nav>
		<nav class="navbar nav navbar-white ">
			<div class="container-fluid">
				<ul class="nav nav-tabs mx-auto">
					<li class="nav-item">
						<a class="nav-link btn btn-lg" href="#stream-section">Stream</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-lg" href="#compiti-section">Compiti</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-lg" href="#persone-section">Persone</a>
					</li>
				</ul>
			</div>
		</nav>
	</header> 

<style>
  header .container-fluid {
    padding-right: 0;
    padding-left: 0;
  }

  header .container-fluid .row {
    margin-right: 0;
    margin-left: 0;
  }
</style>

	<main class="container my-4" id="stream-section">
	<div class="mx-auto">
    <form class="form-inline my-2 my-lg-0" action="../../src/search.php" method="POST">
      <input
        class="form-control mr-sm-2"
        name="searchText"
        type="search"
        value="<?php if (isset($_SESSION['searchText'])) echo $_SESSION['searchText'];?>"
        placeholder="Search"
        aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
		<div class="row">
			<!-- inizio sesione stream -->
			<section class="col-lg-8">
				<article class="card mb-4">
					<header class="card-header bg-light">
					  <h3 class="card-title mb-0">Inserisci un nuovo annuncio</h3>
					</header>
					<div class="card-body">
					  <button id="show-form-btn" class="btn btn-primary">Inserisci nuovo annuncio</button>
					   <form id="annuncio-form" action="./annuncio.php" method="post">
					   <?php 
							$file_name = basename($_SERVER['PHP_SELF']);
							$value = substr($file_name, -12,-4);
							/*echo "console.log($value)";*/
						?>
							<input type="hidden" name="classe" id="classe" value="<?php echo $value; ?>">
						<div class="mb-3">
						  <label for="titolo" class="form-label">Titolo</label>
						  <input type="text" class="form-control" id="titolo" name="titolo" required>
						</div>
						<div class="mb-3">
						  <label for="testo" class="form-label">Testo</label>
						  <textarea class="form-control" id="testo" name="testo" rows="3" required></textarea>
						</div>
						<div class="mb-2">
							<!-- TODO: Non carica i file correttamente ma solo il nome del file -->
						  <label for="allegati" class="form-label">Allegati</label>
						  <input type="file" class="form-control" id="allegati" name="allegati">
						</div>
						<div>
						<label class="switch">
								<input type="checkbox" id="slider-compito" name="slider-compito" onchange="toggleFieldDataOra()">
								<span class="slider"></span>
							</label> Compito
						</div>
						<div class="mb-3" id="data-div">
							<label for="data" class="form-label">Data</label>
							<input type="date" class="form-control" id="data" name="data">
						</div>
						<div class="mb-3" id="ora-div">
							<label for="orario" class="form-label">Orario</label>
							<input type="time" class="form-control" id="orario" name="orario" value="">
						</div>
						<button type="submit" class="btn btn-primary mt-3">Pubblica annuncio</button>
						<button id="ret-form-btn" class="btn btn-secondary mt-3">Annulla</button>
					  </form>
					</div>
				</article>
				
				<h2 class="mb-4">Ultimi annunci</h2>
				<?php include "./ultimi-annunci.php"; ?>
				
			</section>
			<aside class="col-lg-4" id="aside-compiti">
        	<div class="slideshow-container">

          	<!-- Full-width slides/quotes -->
			<?php include "./compiti-assegnati.php"?>
			
          <!-- Next/prev buttons -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
          
				<div class="card" id="codicecorsoCard">
					<div class="card-body">
						<h5 class="card-title">Codice corso</h5>
						<p class="card-text" title="copia" id="codiceCliccabile" onclick="copy();"><?php echo substr(basename($_SERVER["PHP_SELF"]), -12, 8); ?></p>
					</div>
				</div>
			</aside>
		</div>
	</main>
  <style>
    * {box-sizing: border-box}

    /* Slideshow container */
    .slideshow-container {
      position: relative;
      background: #f1f1f1f1;
    }

    /* Slides */
    .mySlides {
      display: none;
      padding: 80px;
      text-align: center;
      height: 500px;
    }

    /* Next & previous buttons */
    .prev, .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      margin-top: -30px;
      padding: 16px;
      color: #888;
      font-weight: bold;
      font-size: 20px;
      border-radius: 0 3px 3px 0;
      user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      position: absolute;
      right: 0;
      border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
      background-color: rgba(0,0,0,0.8);
      color: white;
    }

    /* The dot/bullet/indicator container */
    .dot-container {
        text-align: center;
        padding: 20px;
        background: #ddd;
    }

    /* The dots/bullets/indicators */
    .dot {
      cursor: pointer;
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    /* Add a background color to the active dot/circle */
    .active, .dot:hover {
      background-color: #717171;
    }
</style>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
	<footer class="bg-light">
		<div class="container py-3">
			<p class="text-center mb-0">Autori: Emanuele Elie Debach, Fabio Priori, Marco Giangreco &copy; 2023</p>
		</div>
	</footer>
	<script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
