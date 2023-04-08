<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
    <!--Carosello immagine: SEZIONE CRITICA CHE FA APPARIRE L'IMMAGINE BIANCA-->
    <!--Icona stella-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        #TextareaRecensione{
            resize:none;
        }
    </style>
    <style>
        footer {
          text-align: center;
          padding: 3px;
          background-color: rgb(45, 42, 42);
          color: rgb(237, 237, 237);
        }
        /* Viene usato per staccare la scritta "Scholarnet" della Navbar */
        .topleft {
          position: absolute;
          top: 8px;
          left: 16px;
          font-size: 18px;
        }
     </style>

    <link rel="stylesheet" href="../src/rating.css">

    <title>Scholarnet</title>

</head>
<body>
    <!-- Sezione Header: NON TOCCARE!!!!-->
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <!-- <div class="topleft"> -->
                <a class="navbar-brand" href="#">Scholarnet</a>
            <!-- </div> -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-md-auto">
					<li class="nav-item">
						<a class="nav-link" href="#home-section">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#descrizione-section">Descrizione</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#qa-section">Q&amp;A</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="#recensione">Recensioni</a>
					</li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- da inserire ancora i riferimenti -->
					<li class="nav-item">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-primary" href="./Profilo.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                </svg>
                                <!--Pensavo di implementare che al momento che passo col cursore sul bottone profilo, senza cliccarlo, ti usciva un piccola finestra con le informazioni dell'utente-->
                                Profilo
                            </a>
                            <a class="btn btn-danger" href="../index.html">Logout</a>
                        </div>
					</li>
                    <!-- da inserire ancora i riferimenti -->
				</ul>
			</div>
		</nav>
	</header>
    <br>

    <!--Sezione crea o unisciti corso-->
    <section id="home-section" class="bg-image mt-5">

        <!-- Titolo da modificare -->
        <div class="container">
            <?php
                echo "<h2>Benvenuto nome_utente!</h2>";
            ?>
        </div>
        <br>
		<div class="container">
			<div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Iscriviti al corso</h4>
                            <ul>
                                <li>Seleziona un corso del tuo istituto/università</li>
                                <li>Utilizza un codice del corso con 5-7 lettere o numeri</li>
                            </ul>
                            <p>Se hai problemi a iscriverti al corso, consulta il <a target="_blank" href="#">Centro assistenza</a></p>
                            <a href="#" class="btn btn-primary">Iscriviti</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crea corso</h4>
                            <ul>
                                <li>Interagisci con i tuoi alunni, pubblicando materiale didattico</li>
                                <li>Genera una classe virtuale di studenti</li>
                            </ul>
                            <p>Se hai problemi a creare un corso, consulta il <a target="_blank" href="#">Centro assistenza</a></p>
                            <a href="#" class="btn btn-primary">Crea</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 



    <!-- Sezione Home -->
	<section id="home-section" class="bg-image mt-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-auto">

                    <!-- immagine di prova (carosello)-->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block" src="https://images.pexels.com/photos/256395/pexels-photo-256395.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="First slide" style="width:1280px; height:720px;">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block" src="https://images.pexels.com/photos/6209801/pexels-photo-6209801.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Second slide" style="width:1280px; height:720px;">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block" src="https://images.pexels.com/photos/2874782/pexels-photo-2874782.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Third slide" style="width:1280px; height:720px;">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <br>
    <br>

    <!-- Sezione Descrizione -->
    <section id="descrizione-section">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2>Descrizione</h2>
            <!-- Da riempire -->
            <p>Qui potrai trovare informazioni dettagliate sul nostro sito e sui servizi offerti. Scopri come possiamo aiutarti!</p>
            </div>
        </div>
        </div>
  </section>
  
  <br>
  <br>

    <!-- Sezione Q&A -->
    <section id="qa-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Domande frequenti</h2>
                    <p>Qui troverai le risposte alle domande più frequenti sulla nostra azienda e i nostri prodotti.</p>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h3 class="mb-0">
                                    <button class="btn btn-link dropdown" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Qual è il vostro prodotto più venduto?
                                    </button>
                                </h3>
                            </div>
    
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Il nostro prodotto più venduto è il nostro prodotto di punta, il quale è stato sviluppato con grande cura e attenzione ai dettagli per garantire una qualità eccellente.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h3 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Come posso effettuare un ordine?
                                    </button>
                                </h3>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Puoi effettuare un ordine sul nostro sito web, oppure contattarci telefonicamente o via e-mail per effettuare l'ordine.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h3 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Quanto tempo impiegate per la consegna?
                                    </button>
                                </h3>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Il tempo di consegna dipende dalla zona di consegna e dal tipo di prodotto. Solitamente la consegna avviene entro 3-5 giorni lavorativi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <br>

    <!-- Sezione Recensioni -->
    <section id="recensione">
        <div class="container ">
            <!-- form da generare-->
            <form action="" >
            <div class="row">
                <div class="col-sm-12 ">
                    <h2>Inserisci la tua recensione</h2>
                    <!--La mia idea che voglio implementare è quella di inserire per ogni categoria visualizza le recensioni-->
                    <!-- Modifica delle valutazioni usando icone di stelle -->
                    <div class="class=mb-5">
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control mb-2" placeholder="Feedback.." id="floatingTextarea2" style="height: 150px;width: 380px; resize:none"></textarea>
                <label for="floatingTextarea2"></label>

                <input type="submit" value="Invia" class="btn btn-outline-primary">
            </div>             
        </form>
        </div>
    </section>
    <!-- Da completare -->
    <div style="height: 20px; width: auto;"></div>
    <div id="includedContent"></div>

        <footer class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
              <!-- Section: Form -->
              <section>
                <form action="">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                    <!--Grid column-->
                    <div class="col-auto">
                      <p class="pt-2">
                        <strong>Sign up for our newsletter</strong>
                      </p>
                    </div>
                    <!--Grid column-->
          
                    <!--Grid column-->
                    <div class="col-md-5 col-12">
                      <!-- Email input -->
                      <div class="form-outline form-white mb-4">
                        <input type="email" class="form-control" id="emailNewsletter" aria-describedby="emailHelp" placeholder="Inserici email">
                      </div>
                    </div>
                    <!--Grid column-->
          
                    <!--Grid column-->
                    <div class="col-auto">
                      <!-- Submit button -->
                      <button type="submit" class="btn btn-outline-light mb-4">
                        Subscribe
                      </button>
                    </div>
                    <!--Grid column-->
                  </div>
                  <!--Grid row-->
                </form>
              </section>
              <!-- Section: Form -->
            </div>
            <!-- Grid container -->
          
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              <a class="text-white" >Autori: Emanuele Elie Debach, Fabio Priori, Marco Giangreco</a>
            </div>
            <!-- Copyright -->
          </footer>     

    </body>
</html>