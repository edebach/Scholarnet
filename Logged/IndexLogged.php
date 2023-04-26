<!DOCTYPE html>
<?php
session_start();
// TODO: Inserire un controllo periodico per verificare che la sessione dell'utente
//       non sia scaduta, altrimenti rimandarlo al login
?>
<html lang="it">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    

    <!-- Bootstrap JS -->
    <!-- questa riga sembra non essere necessaria -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- FONT-AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        footer {
          text-align: center;
          padding: 3px;
          background-color: rgb(45, 42, 42);
          color: rgb(237, 237, 237);
        }
        @media screen and (min-width: 768px) {
        .collapse.navbar-collapse {
          padding-left: 3.8cm;
        }
      }
      /* TODO: Bordo non visibile, verificare se si può risolvere altrimenti cancellare quel parametro */
      iframe{
        width:550px; 
        height:400px;
        border:1cm;
        background-color: ;
      }
     </style>


    <link rel="stylesheet" href="../src/rating.css">
    <link rel="stylesheet" href="../src/rating1.css">
    

    <!--ZONA DINAMICA1: Implementazione oggetto AJAX per click stelle-->
    <script>
       $(document).ready(function() {
        $("input[name='rating']").click(function() {
            var rating = $(this).val();
            var iframeDoc = $('iframe').contents()[0];
            var zonaDinamica = $(iframeDoc).find('#zonaDinamica');
            $.ajax({
                url: "../Recensioni/script.php",
                type: "POST",
                data: { stelle: rating },
                dataType: "json",
                success: function(data) {
                    // Rimuovi il log sulla console e costruisci l'HTML con le recensioni
                    var html = '';

                    //Bootstrap CSS
                    html += '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
                    html += '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">';
                    
                    // Inizio struttura html
                    
                    if(data.length) {
                        data.forEach(function(review) {
                            html += 
                            `<div class='container'>
                                <div class='row'>
                                    <div class='col-md-12 col-lg-10 col-xl-8'>
                                        <div class='card'>
                                            <div class='card-body p-4'>
                                                <h4 class='mb-4 pb-2'>${review.nome_recensione}</h4>
                                                <div class='row'>
                                                    <div class='col'>
                                                        <div class='d-flex flex-start'>
                                                            <img class='rounded-circle shadow-1-strong me-3' src='https://www.dm.unibo.it/matecofin/img/empty.jpg' alt='avatar' width='65' height='65' />
                                                            <div class='flex-grow-1 flex-shrink-1'>
                                                                <div>
                                                                    <div class='d-flex justify-content-between align-items-center'>
                                                                        <p class='mb-1'><strong>${review.utente}</strong><span class='small'>- ${review.data}</span></p>
                                                                    </div>
                                                                    <p class='small mb-0'>${review.descrizione}</p>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            `;
                        })
                    }
                    else {
                        html += '<p>Nessuna recensione trovata per ' + rating + ' stelle.</p>';
                    }


                    // Aggiungi l'HTML generato alla <div> "zonaDinamica" all'interno dell'<iframe>
                    zonaDinamica.html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        });
    </script>


    <script>
        $(document).ready(function(){
      // Seleziona tutte le stelle
      var stars = document.querySelectorAll('.rating input[type="radio"]');

      // Aggiungi un ascoltatore di eventi a ciascuna stella
      stars.forEach(function(star) {
        star.addEventListener('click', function() {
          // Se una stella viene selezionata, mostra l'iframe
          var iframe = document.querySelector('iframe');
          iframe.style.display = 'block';
        });
      });

      // Aggiungi un ascoltatore di eventi al contenitore delle stelle
      var rating = document.querySelector('.rating');
      rating.addEventListener('mouseleave', function() {
        // Se nessuna stella è selezionata, nascondi l'iframe
        var iframe = document.querySelector('iframe');
        if (!document.querySelector('.rating input[type="radio"]:checked')) {
          iframe.style.display = 'none';
        }
      });

    });
    </script>

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
                            <a class="btn btn-outline-primary" href="./Profilo.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                </svg>
                                <!--Pensavo di implementare che al momento che passo col cursore sul bottone profilo, senza cliccarlo, ti usciva un piccola finestra con le informazioni dell'utente-->
                                Profilo
                            </a>
                            <a class="btn btn-outline-danger" href="./Logout/logout.php">Logout</a>
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
            if($_SESSION['sesso']=="Maschio")
                echo "<h2>Benvenuto " .$_SESSION['nome']."!</h2>";
            else{
                if($_SESSION['sesso']=="Femmina")
                echo "<h2>Benvenuta " .$_SESSION['nome']."!</h2>";
                else{
                    echo "<h2>Benvenuto/a " .$_SESSION['nome']."!</h2>";
                }
            }
            ?>
        </div>
        <br>
        
        <!--Controllo studente/docente per la visualizzazione dello script-->
		<?php
            if($_SESSION['flag']=="1") include './scriptStudente.html';
            else include './scriptDocente.html';
        ?>

    </section> 
    
    <!-- Finestra di Iscriviti corso -->
    <div class="modal fade" id="iscriviti-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Iscriviti al corso</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    
                    <form name="iscriviti" action="./Iscriviti/iscriviti.php" method="POST">
                        <div class="row">
                            <h6>Chiedi il codice del corso all'insegnante e inseriscilo qui.</h6>
                            <input class="form-control" list="datalistOptions" name="codiceCorso" placeholder="Codice del corso" required pattern="[0-9A-Z]{8}">
                        </div>
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Iscriviti</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
        </div>
    </div>

    <!-- Finestra di Crea corso -->
    <div class="modal fade" id="crea-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Crea corso</h5>
            </div>
            <div class="modal-body">

                <form name="creazione" action="./Crea/crea.php" method="POST">
                <div class="mb-3">
                    <input class="form-control" type="text" name="nomeCorso" placeholder="Nome corso" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="materia" placeholder="Materia (non obbligatoria)">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Crea</button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Sezione Home -->
	<section id="home-section" class="bg-image mt-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-auto">

                    <!-- immagine di prova (carosello)-->
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
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
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Ultime recensioni</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm">    
                        <strong>Filtra per </strong>
                    </div>
                        <!-- Modifica delle valutazioni usando icone di stelle -->
                        <div class="col-sm-12 class=mb-5">
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time - 1 star"></label>
                            </fieldset>
                        </div>

                    
                    <div class="col-sm-12 "> 
                        <!--Visualizza il numero di recensioni totali-->
                        <?php include '../Recensioni/num-recensioni.php'; ?>
                    </div>
                </div>
                
                <!--ZONA DINAMICA: Implementazione oggetto AJAX-->
                <iframe srcdoc="<html>
                    <head>
                        <style>
                            body { margin: 0; }
                        </style>
                    </head>
                    <body>
                        <div id='zonaDinamica'>
                        </div>
                    </body>
                    </html>">
                </iframe>
                <br>

            <!--Bottone per inserire la recensione: solo per utenti loggati-->
            <div class="row">
                <button id="insert" type="button" class="btn btn-primary" data-toggle="modal" data-target="#recensione-popup">Inserisci la tua recensione</button>
            </div>
            
            <!--Finestra inserisci recensione-->
            <div class="modal fade" id="recensione-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Inserisci recensione</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        <form name="recensione" action="../Recensioni/recensioni.php" method="POST">
                            <!--PRIMA RIGA: Campo nome recensione-->
                            <div class="mb-3">
                                <label class="form-label">Nome recensione</label>
                                <input type="text" name="nomeRecensioneInput" class="form-control" id="exampleFormControlInput1" required>
                            </div>

                            <!--SECONDA RIGA: Campo descrizione-->
                            <div class="mb-3">
                                <label class="form-label">Descrizione</label>
                                <textarea class="form-control" name="FeedbackRecensione" id="descrizione" rows="3" placeholder="Feedback..." required></textarea>
                            </div>

                            <!--TERZA RIGA: Campo valutazione-->
                            <div class="col mb-3">
                                <div class="row">
                                    <label for="exampleFormControlTextarea1" class="form-label">Valutazione</label>
                                </div>
                                <div class="row">
                                    <fieldset class="rating1">
                                        <input type="radio" id="star5" name="rating1" value="5" /><label for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4" name="rating1" value="4" /><label for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3" name="rating1" value="3" /><label for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2" name="rating1" value="2" /><label for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1" name="rating1" value="1" /><label for="star1" title="Sucks big time - 1 star"></label>
                                    </fieldset>
                                </div>
                            </div>

                            <!--QUARTA RIGA: Campo bottoni-->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Invia</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                            </div>

                        </form>
                        </div>
                    </div>    
                </div>
                </div>
    </section>
    
    <br>

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