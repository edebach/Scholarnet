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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Bootstrap JS -->
    <!-- questa riga sembra non essere necessaria -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!--Carosello immagine: SEZIONE CRITICA CHE FA APPARIRE L'IMMAGINE BIANCA-->
    <!--Icona stella-->
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

        iframe{
            width:550px; 
            height:400px;
            border:1cm;
        }
    </style>

    <link rel="stylesheet" href="./src/rating.css">
    
    <!--ZONA DINAMICA: Implementazione oggetto AJAX recensioni -->
    <script>
       $(document).ready(function() {
        $("input[name='rating']").click(function() {
            var rating = $(this).val();
            var iframeDoc = $('iframe').contents()[0];
            var zonaDinamica = $(iframeDoc).find('#zonaDinamica');
            $.ajax({
                url: "./Recensioni/script.php",
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
                                                            <img class='rounded-circle shadow-1-strong me-3' src='./img/empty.jpg' alt='avatar' width='65' height='65' />
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
    	<!--Sezione Header-->
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="topleft">
                <a class="navbar-brand" href="./index.php">
                <img src="./img/logo_nosfondo.png" id="logoScholarnet" alt="Logo Scholarnet" 
                width="50" height="50" class="d-inline-block align-text-top">
                    <!-- Scholarnet -->
                </a>
            </div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    <br>

    <!-- Sezione Home -->
	<section id="home-section" class="bg-image mt-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-auto">
					<h1>Scholarnet</h1>
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
</br>
</br>
    <!-- Sezione Descrizione -->
    <!-- TODO:Da riempire -->
    <section id="descrizione-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Qui potrai trovare informazioni dettagliate sul nostro sito e sui servizi offerti. Scopri come possiamo aiutarti!</p>
                </div>
            </div>
        </div>
    </section>
  
    <br>
    <br>

    <!-- Sezione Q&A -->
    <!-- TODO:Da riempire -->
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
    </br>
    </br>
    <!-- Sezione Recensioni -->
    <section id="recensione">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Ultime recensioni</h2>
                </div>
            </div>
            </br>   
            <div class="row">
                <div class="col-sm">    
                    <strong>Filtra per </strong>
                </div>
                <!-- Modifica delle valutazioni usando icone di stelle -->
                <div class="col-sm-12 class=mb-5">
                    <fieldset class="rating">
                        <!-- TODO: modifica i title delle lable in italiano -->
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time - 1 star"></label>
                    </fieldset>
                </div>
                <div class="col-sm-12 "> 
                    <!--Visualizza il numero di recensioni totali-->
                    <?php include './Recensioni/num-recensioni.php'; ?>
                </div>
            </div>            
            <!--ZONA DINAMICA: Implementazione oggetto AJAX display delle recensioni-->
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
        </div>
    </section>
    </br>

    <!-- TODO: fare in modo che il footer prenda tutta la riga togliendo i margini ai lati -->
    <footer class="bg-dark text-center text-white">

        <!-- Copyright -->
        
        <div class=" text-center m-0 p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <a class="text-white" >Autori: Emanuele Elie Debach, Fabio Priori, Marco Giangreco</a>
        </div>
        <!-- Copyright -->
        </footer>
        
    </body>
</html>


<!-- SEZIONE NEWSLETTER RIMOSSA -->
<!-- <div class="container p-4 pb-0">

            <section>
            <form action="">

                <div class="row d-flex justify-content-center">
                <div class="col-auto">
                    <p class="pt-2">
                    <strong>Sign up for our newsletter</strong>
                    </p>
                </div>
                <div class="col-md-5 col-12">

                    <div class="form-outline form-white mb-4">
                    <input type="email" class="form-control" id="emailNewsletter" aria-describedby="emailHelp" placeholder="Inserici email">
                    </div>
                </div>
                <div class="col-auto">

                    <button type="submit" class="btn btn-outline-light mb-4">
                    Subscribe
                    </button>
                </div>
                </div>
            </form>
            </section>
        </div>

         -->