<!DOCTYPE html>
<html lang="it">
<head>
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



			$('#annuncio-form').submit(function(event) {
			event.preventDefault();
			// Qui puoi aggiungere il codice per inviare l'annuncio al server
			$('.card-body').removeClass('show');
			});
		});
  </script>
  	<script>
		$(document).ready(function() {
			const mySwitch = document.getElementById("slider-compito");

			mySwitch.addEventListener("change", function() {
			if (this.checked) {
				// lo switch è attivo
				console.log("Lo switch è attivo!");
			} else {
				// lo switch è disattivo
				console.log("Lo switch è disattivo!");
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
				<!-- <ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" href="#stream-section">Stream</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#compiti-section">Compiti</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#persone-section">Persone</a>
					</li>
				</ul> -->
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
						<nav class="navbar navbar-dark bg-dark">
							<ul class="navbar-nav">
								<!-- TODO: Qui dobbiamo inserire l'elenco delle classi le classi -->
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
		<!-- <div class="container-fluid mt-3">
			<div class="row justify-content-center">
			<div class="col-auto">
				<a class="btn btn-primary" href="#stream-section">Stream</a>
			</div>
			<div class="col-auto">
				<a class="btn btn-primary" href="#compiti-section">Compiti</a>
			</div>
			<div class="col-auto">
				<a class="btn btn-primary" href="#persone-section">Persone</a>
			</div>
			</div>
		</div> -->
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
		<div class="row">
			<!-- inizio sesione stream -->
			<section class="col-lg-8">
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
						<div class="mb-2">
						  <label for="allegati" class="form-label">Allegati</label>
						  <input type="file" class="form-control" id="allegati" name="allegati">
						</div>
						<div>
						<label class="switch">
								<input type="checkbox" id="slider-compito">
								<span class="slider"></span>
							</label> Compito
						</div>
						<button type="submit" class="btn btn-primary mt-3">Pubblica annuncio</button>
						<button id="ret-form-btn" class="btn btn-secondary mt-3">Annulla</button>
					  </form>
					</div>
				</article>
				  
				<h2 class="mb-4">Ultimi annunci</h2>
				<div class="card text-black bg-light mb-3 d-inline-block">
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
				</div>
				<div class="card text-black bg-light mb-3 d-inline-block">
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
			</section>
			<aside class="col-lg-4" id="aside-compiti">
        <div class="slideshow-container">
          <!-- Full-width slides/quotes -->
          <div class="mySlides">
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
                  <td colspan="3">

                    
                    <p>TESTO </p>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mySlides">
            <q>But man is not made for defeat. A man can be destroyed but not defeated.</q>
            <p class="author">- Ernest Hemingway</p>
          </div>

          <div class="mySlides">
            <q>I have not failed. I've just found 10,000 ways that won't work.</q>
            <p class="author">- Thomas A. Edison</p>
          </div>

          <!-- Next/prev buttons -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

          <!-- Dots/bullets/indicators -->
          <div class="dot-container">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
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
      height: 680px;
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
			<p class="text-center mb-0">Il mio blog &copy; 2022</p>
		</div>
	</footer>
	<script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
