<?php
  session_start();
  session_unset();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    @media screen and (min-width: 768px) {
      .collapse.navbar-collapse {
        padding-left: 3.8cm;
      }
    }
    iframe {
      width: 550px;
      height: 400px;
      border: 1cm;
    }
  </style>

  <link rel="stylesheet" href="./src/rating.css">

  <!--ZONA DINAMICA: Implementazione oggetto AJAX recensioni -->
  <script>
    $(document).ready(function () {
      $('#allrec').trigger('click');
      $('#star5').prop('checked', true);
    });


    $(document).ready(function () {
      $("input[name='rating']").click(function () {
        var rating = $(this).val();
        var iframeDoc = $('iframe').contents()[0];
        var zonaDinamica = $(iframeDoc).find('#zonaDinamica');
        $.ajax({
          url: "./Recensioni/script.php",
          type: "POST",
          data: { stelle: rating },
          dataType: "json",
          success: function (data) {
            // Rimuovi il log sulla console e costruisci l'HTML con le recensioni
            var html = '';

            //Bootstrap CSS
            html += '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
            html += '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">';

            // Inizio struttura html
            if (data.length) {
              data.forEach(function (review) {
                if(review.stelle=="1"){
                  html_s = "stella";
                }
                else{
                    html_s = "stelle";
                }
                html +=
                  `<div class='container'>
                                <div class='row'>
                                    <div class='col-md-12 col-lg-10 col-xl-8'>
                                        <div class='card'>
                                            <div class='card-body p-4'>
                                                <h4 class='mb-4 pb-2'>${review.nome_recensione} - ${review.stelle+" "+html_s}</h4>
                                                <div class='row'>
                                                    <div class='col'>
                                                        <div class='d-flex flex-start'>
                                                            <img class='rounded-circle shadow-1-strong me-3' src='./Logged/Profilo/img/${review.immagine}' alt='avatar' width='65' height='65' />
                                                            <div class='flex-grow-1 flex-shrink-1'>
                                                                <div>
                                                                    <div class='d-flex justify-content-between align-items-center'>
                                                                        <p class='mb-1'><strong>${review.utente}</strong><span class='small'> - ${review.data}</span></p>
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
              if (rating == "1") {
                html += '<p>Nessuna recensione trovata per ' + rating + ' stella.</p>';
              }
              else {
                html += '<p>Nessuna recensione trovata per ' + rating + ' stelle.</p>';
              }
            }


            // Aggiungi l'HTML generato alla <div> "zonaDinamica" all'interno dell'<iframe>
            zonaDinamica.html(html);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });

      $("#allrec").click(function () {
        console.log('Bottone cliccato');
        var rating = "0";
        var iframeDoc = $('iframe').contents()[0];
        var zonaDinamica = $(iframeDoc).find('#zonaDinamica');
        $.ajax({
          url: "./Recensioni/script.php",
          type: "POST",
          data: { stelle: rating },
          dataType: "json",
          success: function (data) {
            // Rimuovi il log sulla console e costruisci l'HTML con le recensioni
            var html = '';

            //Bootstrap CSS
            html += '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
            html += '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">';

            // Inizio struttura html
            if (data.length) {
              data.forEach(function (review) {
                if(review.stelle=="1"){
                  html_s = "stella";
                }
                else{
                    html_s = "stelle";
                }
                html +=
                  `<div class='container'>
                                <div class='row'>
                                    <div class='col-md-12 col-lg-10 col-xl-8'>
                                        <div class='card'>
                                            <div class='card-body p-4'>
                                                <h4 class='mb-4 pb-2'>${review.nome_recensione} - ${review.stelle+" "+html_s}</h4>
                                                <div class='row'>
                                                    <div class='col'>
                                                        <div class='d-flex flex-start'>
                                                            <img class='rounded-circle shadow-1-strong me-3' src='./Logged/Profilo/img/${review.immagine}' alt='avatar' width='65' height='65' />
                                                            <div class='flex-grow-1 flex-shrink-1'>
                                                                <div>
                                                                    <div class='d-flex justify-content-between align-items-center'>
                                                                        <p class='mb-1'><strong>${review.utente}</strong><span class='small'> - ${review.data}</span></p>
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
              html += '<p>Ancora nessuna recensione.</p>';
            }


            // Aggiungi l'HTML generato alla <div> "zonaDinamica" all'interno dell'<iframe>
            zonaDinamica.html(html);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      // Seleziona tutte le stelle
      var stars = document.querySelectorAll('.rating input[type="radio"]');

      // Aggiungi un ascoltatore di eventi a ciascuna stella
      stars.forEach(function (star) {
        star.addEventListener('click', function () {
          // Se una stella viene selezionata, mostra l'iframe
          var iframe = document.querySelector('iframe');
          iframe.style.display = 'block';
        });
      });

      // Aggiungi un ascoltatore di eventi al contenitore delle stelle
      var rating = document.querySelector('.rating');
      rating.addEventListener('mouseleave', function () {
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
  <!--Sezione Header-->
  <header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="topleft">
        <a class="navbar-brand" href="./index.php">
          <img src="./img/logo_nosfondo.png" id="logoScholarnet" alt="Logo Scholarnet" width="50" height="50"
            class="d-inline-block align-text-top">
          <!-- Scholarnet -->
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
          <li class="nav-item">
            <div class="col-md-12 text-right">
              <a class="btn btn-outline-primary" href="./Login/login.html">Login</a>
              <a class="btn btn-outline-secondary" href="./Signup/singup.html">Sign Up</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <!-- Sezione Home -->
  <section id="home-section" class="bg-image" style="padding-top: 80px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 style="font-size: 40px;">Scholarnet</h1>
          <!-- Immagini carosello -->
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block" src="./img/sfondo-index1.jpg" alt="First slide"
                  style="width:1080px; height:566px;">
              </div>
              <div class="carousel-item">
                <img class="d-block" src="./img/sfondo-index2.jpeg" alt="Second slide"
                  style="width:1080px; height:566px;">
              </div>
              <div class="carousel-item">
                <img class="d-block" src="./img/sfondo-index3.jpeg" alt="Third slide"
                  style="width:1080px; height:566px;">
              </div>
              <div class="carousel-item">
                <img class="d-block" src="./img/sfondo-index4.jpg" alt="Fourth slide"
                  style="width:1080px; height:566px;">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Precedente</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Successivo</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sezione Descrizione -->
  <section id="descrizione-section" style="padding-top: 90px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Descrizione</h2>
          <p>Scholarnet è una piattaforma di apprendimento online mirata a simulare una classe virtuale.
            È progettata per semplificare la gestione dei corsi e delle attività scolastiche,
            consentendo agli insegnanti di creare e condividere lezioni, assegnazioni e materiali didattici
            con i loro studenti, e permettendo agli studenti di interagire con il 
            materiale fornito dal docente e con i loro compagni di corso.</p>
          <p>Gli studenti possono accedere a Scholarnet tramite il proprio account personale
            e visualizzare le lezioni e le attività assegnate dai loro insegnanti.
            Possono anche inviare i loro annunci e interagire con i loro compagni di classe e
            l'insegnante tramite i commenti nei post.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sezione Q&A -->
  <section id="qa-section" style="padding-top: 90px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>Domande frequenti</h2>
          <p>Qui troverai le risposte alle domande più frequenti sulle funzionalità della nostra applicazione web.</p>
          <div class="accordion" id="accordionExample">

            <!--Prima domanda-->
            <div class="card">
              <div class="card-header" id="headingOne">
                <h3 class="mb-0">
                  <button class="btn btn-link dropdown" type="button" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Quali sono le funzionalità principali dell'applicazione?
                  </button>
                </h3>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  Scholarnet si basa principalmente sulle creazione di classi virtuali, caricamento di materiali
                  didattici e assegnazione di compiti da parte dei docenti.
                </div>
              </div>
            </div>

            <!--Seconda domanda-->
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h3 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    Chi può usare l'applicazione?
                  </button>
                </h3>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  Scholarnet potrà essere utilizzata principalmente da insegnanti e studenti.
                  Gli insegnanti possono utilizzare l'applicazione per creare aule virtuali,
                  caricare materiali didattici, assegnare compiti e comunicare con gli studenti.
                  Gli studenti possono utilizzare l'applicazione per accedere all'aula virtuale,
                  vedere i materiali didattici caricati dagli insegnanti, svolgere i compiti assegnati e
                  comunicare tra di loro.
                </div>
              </div>
            </div>

            <!--Terza domanda-->
            <div class="card">
              <div class="card-header" id="headingThree">
                <h3 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Come posso creare una classe virtuale?
                  </button>
                </h3>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  Per creare la classe virtuale devi prima aver effettuato il <a href="./Signup/singup.html">signup</a> come docente.
                  Una volta iscritto ed eseguito il Login, potrai creare il tuo corso tramite la sezione presente nell'apposita pagina Home.
                </div>
              </div>
            </div>

            <!--Quarta domanda-->
            <div class="card">
              <div class="card-header" id="headingFour">
                <h3 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Come posso invitare gli studenti a partecipare alla classe virtuale?
                  </button>
                </h3>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                  Per invitare gli studenti a partecipare alla classe virtuale, basta fornirgli il codice della
                  classe, situato nello stream del corso. Ti basterà cliccarci sopra per copiarlo e condivederlo ai
                  tuoi studenti.
                </div>
              </div>
            </div>

            <!--Quinta domanda-->
            <div class="card">
              <div class="card-header" id="headingFive">
                <h3 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Cosa può fare uno studente iscritto ad un corso?
                  </button>
                </h3>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                  Se sei uno studente le uniche funzionalità che avrai, una volta che sarai dentro alla classe,
                  saranno quelle di pubblicare un annuncio se vorrai chiedere informazioni al docente, oppure
                  utilizzare la chat del corso, dove potrai trovare altri compagni di classe.
                </div>
              </div>
            </div>

            <!--Sesta domanda-->
            <div class="card">
              <div class="card-header" id="headingSeven">
                <h3 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Come può un docente creare e assegnare compiti agli studenti?
                  </button>
                </h3>
              </div>
              <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                  Per creare e assegnare un compito basterà pubblicare un compito nello stream della classe,
                  marcando l'appostito pulsante per identificarlo come compito.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sezione Recensioni -->
  <section id="recensione" style="padding-top: 80px;">
    <div class="container ">
      <div class="row">
        <div class="col-sm-12">
          <h2>Recensioni</h2>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <strong>Filtra per </strong>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--Modifica delle valutazioni usando icone di stelle-->
          <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"
              title="Eccellente - 5 stelle"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"
              title="Ottima - 4 stelle"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"
              title="Buona - 3 stelle"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"
              title="Sufficiente - 2 stelle"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"
              title="Insufficiente - 1 stella"></label>
          </fieldset>
          <button class="btn btn-outline-info ml-3" id="allrec" value="0"><label for="allrec"
              title="visualizza tutte le recensioni"> tutte le recensioni </label> </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--Visualizza il numero di recensioni totali-->
          <?php include './Recensioni/num-recensioni.php'; ?>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <!--ZONA DINAMICA: Implementazione oggetto AJAX display delle recensioni-->
          <iframe srcdoc="<html>
                    <head>
                        <style>
                            body { margin: 0; }
                        </style>

                        <!-- Bootstrap CSS -->
                        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'>
                    </head>
                    <body>
                        <div id='zonaDinamica'>
                          <?php
                          //Visualizza tutte le recensioni
                          $conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                                                user=postgres password=biar")
                                                        or die('Could not connect: ' . pg_last_error());

                          $q = "SELECT * FROM recensione r JOIN utente u ON u.email=r.utente order by data DESC";
                          $result = pg_query($conn, $q);

                          if($row = pg_fetch_array($result)){
                              do{
                                echo "
                              <div class='container'>
                                <div class='row'>
                                    <div class='col-md-12 col-lg-10 col-xl-8'>
                                        <div class='card'>
                                            <div class='card-body p-4'>
                                                <h4 class='mb-4 pb-2'>".$row['nome_recensione']." - ";
                                                if($row['stelle']=="1"){
                                                  echo "1 stella</h4>";
                                                }
                                                else{
                                                  echo $row['stelle']." stelle</h4>";
                                                }
                                                
                                                echo "<div class='row'>
                                                    <div class='col'>
                                                        <div class='d-flex flex-start'>
                                                            <img class='rounded-circle shadow-1-strong me-3' src='./Logged/Profilo/img/".$row['immagine']."' alt='avatar' width='65' height='65' />
                                                            <div class='flex-grow-1 flex-shrink-1'>
                                                                <div>
                                                                    <div class='d-flex justify-content-between align-items-center'>
                                                                        <p class='mb-1'><strong>".$row['nome']." ".$row['cognome']."</strong><span class='small'> - ". date('d/m/Y H:i:s', strtotime($row['data']))."</span></p>
                                                                    </div>
                                                                    <p class='small mb-0'>".$row['descrizione']."</p>
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
                            <br>";

                              }while($row = pg_fetch_array($result));
                          }
                          else{
                            echo "<p>Ancora nessuna recensione.</p>";
                          }

                          ?>
                        </div>
                    </body>
                    </html>">
          </iframe>
        </div>
      </div>
    </div>
  </section>
  </br>
  </br>


  <footer class="bg-light fixed-bottom">
    <div class="container py-3">
      <p class="text-center mb-0">Autori: Emanuele Elie Debach, Fabio Priori, Marco Giangreco &copy; 2023</p>
    </div>
  </footer>


</body>

</html>