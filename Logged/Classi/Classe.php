<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Il mio blog</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Carica Fontawesome (immagini degli omini accanto ai form) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


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


  
    $('#annuncio-form').submit(function(event) {
      event.preventDefault();
      // Qui puoi aggiungere il codice per inviare l'annuncio al server
      $('.card-body').removeClass('show');
    });
  });
  
	</script>
</head>
<body>
	<!-- TODO: bisogna risolvere il bug della navbar quando si va mette lo schermo intero -->
	  <header class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
		  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
			<span class="navbar-toggler-icon"></span>
			<span class="visually-hidden">Toggle navigation</span>
		  </button>
		  <a class="navbar-brand mx-auto" href="#">Nome del corso</a>
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
			  <!-- ?php include '../profilo.html'; ?> -->
			</div>
		  </div>
		  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebar-label">
			<div class="offcanvas-header">
			  <h5 class="offcanvas-title" id="sidebar-label">Le mie classi</h5>
			  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
			  <nav class="navbar navbar-dark bg-dark">
				<ul class="navbar-nav">
				  <!-- TODO: Qui dobbiamo inserire l'elenco delle classi le classi -->
				</ul>
			  </nav>
			</div>
		  </div>
		</div>
		<!-- <div class="container" id="headerClasse">
			<div class="row">	
				<h1 class="text-center display-4" id="titoloClasse">Classe</h1>
				<nav class="navbar navbar-expand-lg navbar-dark">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="compiti-nav-link" href="#">Compiti</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profilo-nav-link" href="#">Profilo</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="mieClassi-nav-link" href="../IndexLogged.php">Le mie Classi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="logout-nav-link" href="../../index.php">Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div> -->
	  </header> 

	<main class="container my-4">
		<div class="row">
			<section class="col-md-8">
				<article class="card mb-4">
					<header class="card-header bg-light">
					  <h3 class="card-title mb-0">Inserisci un nuovo annuncio</h3>
					</header>
					<div class="card-body">
					  <button id="show-form-btn" class="btn btn-primary">Inserisci nuovo annuncio</button>
					  <form id="annuncio-form" action="#" method="post">
						<div class="mb-3">
						  <label for="titolo" class="form-label">Titolo</label>
						  <input type="text" class="form-control" id="titolo" name="titolo" required>
						</div>
						<div class="mb-3">
						  <label for="testo" class="form-label">Testo</label>
						  <textarea class="form-control" id="testo" name="testo" rows="3" required></textarea>
						</div>
						<div class="mb-3">
						  <label for="allegati" class="form-label">Allegati</label>
						  <input type="file" class="form-control" id="allegati" name="allegati">
						</div>
						<button type="submit" class="btn btn-primary">Pubblica annuncio</button>
						<button id="ret-form-btn" class="btn btn-secondary">Annulla</button>
					  </form>
					</div>
				  </article>
				  
				<h2 class="mb-4">Ultimi annunci</h2>
				<article class="card mb-4">
					<header class="card-header bg-light">
						<h3 class="card-title mb-0"><a href="#">Titolo dell'annuncio</a></h3>
						<p class="card-subtitle small">Data di pubblicazione: 01/01/2022</p>
					</header>
					<div class="card-body">
						<p class="card-text">Testo dell'annuncio</p>
						<p class="card-text">Allegati: <a href="#">file1.pdf</a>, <a href="#">file2.docx</a></p>
					</div>
					<footer class="card-footer">
						<a href="#" class="card-link">Commenti (3)</a>
					</footer>
				</article>
				<article class="card mb-4">
					<header class="card-header bg-light">
						<h3 class="card-title mb-0"><a href="#">Titolo dell'annuncio</a></h3>
						<p class="card-subtitle small">Data di pubblicazione: 01/01/2022</p>
					</header>
					<div class="card-body">
						<p class="card-text">Testo dell'annuncio</p>
						<p class="card-text">Allegati: <a href="#">file1.pdf</a></p>
					</div>
					<footer class="card-footer">
						<a href="#" class="card-link">Commenti (1)</a>
					</footer>
				</article>
			</section>
						<aside class="col-md-4">
				<h2 class="mb-4">Compiti assegnati</h2>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Compito</th>
							<th scope="col">Data di scadenza</th>
							<th scope="col">Tempo rimanente</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Compito 1</td>
							<td>01/01/2022</td>
							<td>1 giorno</td>
						</tr>
						<tr>
							<td>Compito 2</td>
							<td>02/01/2022</td>
							<td>2 giorni</td>
						</tr>
					</tbody>
				</table>
			</aside>
		</div>
	</main>
	<footer class="bg-light">
		<div class="container py-3">
			<p class="text-center mb-0">Il mio blog &copy; 2022</p>
		</div>
	</footer>
	<script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
