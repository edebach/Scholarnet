<!DOCTYPE html>
<html lang="it">

<head>
  <?php
  session_start();
  if (!isset($_SESSION['email'])) {
    echo "<script> alert(' Sessione scaduta, effettua nuovamente l\' accesso');
                  window.location.href='../../Login/login.html';
    </script>";
    exit();
  }
  $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
				user=postgres password=biar")
    or die('Could not connect: ' . pg_last_error());

  $file_name = basename($_SERVER['PHP_SELF']);
  $codice_corso = substr($file_name, -12, -4);

  $q1 = "SELECT * FROM corso where codice=$1";
  $result = pg_query_params($dbconn, $q1, array($codice_corso));
  $row = pg_fetch_array($result);
  $nome = $row['nome'];
  $materia = $row['materia'];
  $link = $row['link'];
  $studente = $_SESSION['flag'];

  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Classe</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="classe.css">


  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Carica Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!--Script per visualizzare la search-->
  <script>
    $(document).ready(function () {
      //Al momento del click del bottone search, gli ultimi annunci si nascondono
      $("#search-btn").click(function () {
        $("#ultimi-annunci").hide();
      });
      //al click ricarica la pagina
      var reloadBtn = document.getElementById("reload-btn");
      reloadBtn.addEventListener("click", function() {
        location.reload();
      });

      $("#search-btn").click(function () {
        var searchText = $("#input-search").val(); // Recupera il valore del campo input-search
        var codice_corso = "<?php echo substr(basename($_SERVER["PHP_SELF"]), -12, 8); ?>";  //Recupera il valore del codice del corso
        var flag = "<?php echo $_SESSION['flag'] ?>"; //Recupera il valore del flag

        $.ajax({
          url: "../../src/search.php", // URL della pagina PHP che esegue la query al database
          type: "POST",
          data: { searchText: searchText, codice_corso: codice_corso, flag: flag }, // Passa il valore di input-search come parametro della query
          success: function (result) {
            $("#zonaDinamica").html(result); // Aggiorna la zona dinamica con la tabella risultante dalla query
          }
        });
      });
    });
  </script>

  <!-- Nascondi lo slider compito se studente -->
  <script>
    $(document).ready(function () {
      const mySwitch = document.getElementById("slider-compito");
      $('#data-div').hide();
      $('#ora-div').hide();
      if (<?php echo "$studente"; ?> == "1") { $('#creaCompito').hide(); }
      else {
        mySwitch.addEventListener("change", function () {
          if (this.checked) {
            $('#data-div').fadeIn('1000');
            $('#ora-div').fadeIn('1000');

          } else {
            $('#data-div').fadeOut('1000');
            $('#ora-div').fadeOut('1000');
          }
        });
      }
    });
  </script>
  <script src="./classe.js" language="javascript"></script>

</head>

<body>
  <header>
    <nav class="navbar nav navbar-dark bg-dark flex-wrap">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <button class="navbar-toggler ms-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
            aria-controls="sidebar">
            <span class="navbar-toggler-icon"></span>
            <span class="visually-hidden">Toggle navigation</span>
          </button>
          <a class="navbar-brand text-center" href="#">
            <!-- Nome del corso di riferimento -->
            <?php echo $nome ?>
          </a>
        </div>

        <!-- offcanvas il mio profilo -->
        <button class="btn btn-link rounded-circle text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#profile">
          <!-- Icona dell'utente -->
          <i class="fa-sharp fa-regular fa-user fa-lg"></i>
        </button>
        <div class="offcanvas offcanvas-end" id="profile" aria-labelledby="profile-label">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="profile-label">Il mio profilo</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body">
            <?php
            //Prendiamo dal db tutte le informazione dell'utente
            $email = $_SESSION['email'];
            $q = "SELECT * FROM utente WHERE email=$1";
            $result = pg_query_params($dbconn, $q, array($email));
            $row = pg_fetch_array($result);
            ?>
        
            <div class="container">
              <div class="row">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <?php
                      //Caricamento immagine circolare
                      echo "<img class='rounded-circle shadow-1-strong mb-2' src='../Profilo/img/".$row['immagine']."' alt='avatar' width='65' height='65' />";
                    ?>
                  </div>
                  <div>
                    <?php 
                      //Campo nome e cognome, con indirizzo email associato
                      echo "<h6><strong>" . $row['nome'] . " " . $row['cognome'] . "</strong></h6>
                            <p class='mb-0'>" . $row['email'] . "</p>"; ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <?php
                  //Campo istituto
                  echo "<p>Istituto/Università: " . $row['istituto'] . "</p>"; 
                
                  //Campo data di nascita
                  if ($row['sesso'] == "Femmina")
                    echo "<p>Nata il " . date('d/m/Y', strtotime($row['dataN'])) . "</p>";
                  else
                    echo "<p>Nato il " . date('d/m/Y', strtotime($row['dataN'])) . "</p>";

                  //Campo telefono se esiste
                  if ($row['telefono'] != "")
                    echo "<p>Numero di telefono: " . $row['telefono'] . "</p>";

                  //Campo data iscrizione
                  echo "<p>Iscritto dal " . date('d/m/Y', strtotime($row['data_iscrizione'])) . "</p>";
                ?>
                <!--Link al file Profilo.php-->
                <p><a href="../Profilo.php">Vai al mio profilo</a></p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- offcanvas le mie classi -->
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
                  <a href="../IndexLogged.php" class="btn btn-outline-primary px-4 py-2">
                    <i class="fas fa-home mr-2"></i>
                    <span class="font-weight-bold">Home</span>
                  </a>
                </li>
                <?php
                $email = $_SESSION['email'];
                //STUDENTE
                if ($_SESSION['flag'] == '1') {
                  //Genera tutte le tuple che lo studente partecipa ai corsi
                  $q1 = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
                  $result1 = pg_query_params($dbconn, $q1, array($email));



                  if ($row1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {
                    do {

                      $path = $row1['link'];
                      $file = './' . basename($path);
                      //Parte il layout
                      echo "	<br>
												<li class='nav-item'>
												<div class='card w-100 h-100'>
												<div class='card-body d-flex flex-column '>
													<h4 class='card-title'>" . $row1['nome'] . "</h4>
													<button type='button' class='btn btn-outline-info d-inline-block mx-1'
															onClick=window.location.href='" . $file . "'>Vai al corso</button>
												</div>
											</div>
												</li>
											";

                    } while ($row1 = pg_fetch_array($result1, null, PGSQL_ASSOC));
                  }
                }
                //DOCENTE
                else {

                  //Genera tutte le tuple che il docente insegna ai corsi
                  $q1a = "SELECT * FROM corso c JOIN insegna i ON c.codice=i.corso WHERE i.docente=$1";
                  $result1a = pg_query_params($dbconn, $q1a, array($email));
                  $var = 0; //variabile che servirà per verificare se un docente partecipa o insegna dei corsi
                
                  if ($row2 = pg_fetch_array($result1a, null, PGSQL_ASSOC)) {

                    do {
                      $path = $row2['link'];
                      $file = './' . basename($path);
                      //Parte il layout
                      echo "	<br>
												<li class='nav-item'>
												<div class='card w-100 h-100'>
												<div class='card-body d-flex flex-column '>
													<h4 class='card-title'>" . $row2['nome'] . "</h4>
													<button type='button' class='btn btn-outline-info d-inline-block mx-1'
															onClick=window.location.href='" . $file . "'>Vai al corso</button>
												</div>
											</div>
												</li>
											";
                    } while ($row2 = pg_fetch_array($result1a, null, PGSQL_ASSOC));
                  }

                  //Genera tutte le tuple che il docente partecipa ai corsi
                  $q1b = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
                  $result1b = pg_query_params($dbconn, $q1b, array($email));


                  if ($row3 = pg_fetch_array($result1b, null, PGSQL_ASSOC)) {

                    do {
                      $path = $row3['link'];
                      $file = './' . basename($path);
                      //Parte il layout
                      echo "	<br>
														<li class='nav-item'>
															<button type='button' class='btn btn-outline-info d-inline-block mx-1'
																	onClick=window.location.href='" . $file . "'>" . $row3['nome'] . "</button>
														</li>
													";

                    } while ($row3 = pg_fetch_array($result1b, null, PGSQL_ASSOC));
                  }

                }

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

  <main class="container my-4" id="stream-section">
    <div class="row">
      <!-- inizio sesione stream -->
      <section class="col-lg-8">
        <article class="card mb-4 col-12 w-100" style="max-width: 500px;">
          <header class="card-header bg-light">
            <h3 class="card-title mb-0">Inserisci un nuovo annuncio</h3>
          </header>
          <div class="card-body">
            <button id="show-form-btn" class="btn btn-primary">Inserisci</button>
            <form id="annuncio-form" action="./annuncio.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="classe" id="classe" value="<?php echo $codice_corso; ?>">
              <div class="mb-3">
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" name="titolo" maxlength="30" required>
              </div>
              <div class="mb-3 position-relative">
                <label for="testo" class="form-label">Testo</label>
                <textarea class="form-control" id="testoAnnuncioForm" name="testo" rows="3"
                  style="height: 200px; overflow-y: auto; padding-bottom: 60px; resize: none;" required></textarea>
                <a href="#" class="position-absolute bottom-0 start-0" style="margin: 10px 5px 5px 10px;">
                  <i class="fa-sharp fa-solid fa-bold icona icona-grassetto icona-nera" id="icona-grassetto"
                    title="grassetto"></i>
                </a>
                <a href="#" class="position-absolute bottom-0 start-0 icona" style="margin: 10px 5px 5px 30px;">
                  <i class="fa-sharp fa-solid fa-italic icona icona-italic icona-nera" id="icona-italic"
                    title="italic"></i>
                </a>
                <a href="#" class="position-absolute bottom-0 start-0 icona" style="margin: 10px 5px 5px 50px;">
                  <i class="fa-sharp fa-solid fa-underline icona icona-underline icona-nera" id="icona-underline"
                    title="underline"></i>
                </a>
              </div>
              <div class="mb-2">
                <label for="allegati" class="form-label">Allegati</label>
                <input type="file" class="form-control" id="allegati" name="allegati">
              </div>
              <div id="creaCompito">
                <label class="switch">
                  <input type="checkbox" id="slider-compito" name="slider-compito" onchange="toggleFieldDataOra()">
                  <span class="slider"></span>
                </label> Compito
              </div>
              <div class="mb-3" id="data-div">
                <label for="data_scadenza" class="form-label">Data di consegna</label>
                <input type="date" class="form-control" id="data_scadenza" name="data_scadenza">
              </div>
              <div class="mb-3" id="ora-div">
                <label for="orario" class="form-label">Orario di consegna</label>
                <input type="time" class="form-control" id="orario" name="orario" value="">
              </div>
              <button type="submit" class="btn btn-primary mt-3">Pubblica</button>
              <button id="ret-form-btn" class="btn btn-secondary mt-3">Annulla</button>
            </form>
          </div>
        </article>

        <h2 class="mb-4">Ultimi annunci</h2>
        <div class="mx-auto d-flex align-items-center">
          <input type="text" id="input-search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="search-btn">Search</button>
          <button class="btn btn-outline-warning my-2 my-sm-0" type="button" id="reload-btn">Reset</button>
        </div>
        <br>
        <!--ZONA DINAMICA: Implementazione oggetto AJAX display search-->
        <div id="zonaDinamica">

        </div>
        <div id="ultimi-annunci">
          <?php include "./ultimi-annunci.php"; ?>
        </div>

      </section>
      <aside class="col-lg-4" id="aside-compiti">
        <div class="slideshow-container">

          <!-- Full-width slides/quotes -->
          <?php include "./compiti-assegnati.php" ?>

          <!-- Next/prev buttons -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <div class="card" id="codicecorsoCard">
          <div class="card-body">
            <h5 class="card-title">Codice corso</h5>
            <p class="card-text" title="copia" id="codiceCliccabile" onclick="copy();">
              <?php echo $codice_corso; ?>
            </p>
          </div>
        </div>
      </aside>
    </div>
  </main>
  <br>
  <br>

  <main class="container my-4" id="compiti-section">
    <?php
    //Seleziono tutti i compiti associati a una classe con quel codice codice corso
    $q = "SELECT * FROM compito WHERE classe=$1 AND data_scadenza is not null ORDER BY data_scadenza DESC";
    $result = pg_query_params($dbconn, $q, array($codice_corso));

    if ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
      echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";

      $i = 0;

      do {
        if (empty($row['allegati'])) {
          $percorso_file = null;
        } else {
          $percorso_file = "../../Allegati/" . $row['allegati'];
        }
        $nome_file = substr($row['allegati'], 4);
        $i++;
        $var = "flush-collapse-" . $i;
        echo 
          "<div class='accordion-item'>
						<h2 class='accordion-header'>
							<button class='accordion-button collapsed row align-items-center' type='button' data-bs-toggle='collapse' data-bs-target='#" . $var . "' aria-expanded='false' aria-controls='" . $var . "'>
								<div class='col-4'>
									<span class='card-text text-black' style='font-size: 20px;'>
										<i class='fa-solid fa-book' style='font-size: 20px;'></i>
										<label class='ml-2'>" . $row['titolo'] . "</label>
									</span>
								</div>";

        //impostiamo la data di scadenza del compito
        $data_scadenza = strtotime($row['data_scadenza']);

        //impostiamo la data attuale
        $data_attuale = time();
        $ora_attuale = date("H:i");
        $ora = substr($row['ora'], 0, 5);

        //calcoliamo il numero di giorni rimanenti
        $giorni_restanti = floor(($data_scadenza - $data_attuale) / (60 * 60 * 24));
        $giorni_restanti += 1;
        if($giorni_restanti<0){
          echo "<div class='col-4 text-center'  style='color: red;'>Tempo scaduto</div>";
          echo "<div class='col-4  '></div>";
        }
        else if($giorni_restanti==0){
          if ($ora <= $ora_attuale) {
            echo "<div class='col-4 text-center'  style='color: red;'>Tempo scaduto</div>";
            echo "<div class='col-4  '></div>";
          } else {
            echo "<div class='col-4 text-center'  style='color: orange;'>Oggi alle " . $ora . "</div>";
            echo "<div class='col-4  '></div>";
          }
        }
        else if($giorni_restanti==1){
          echo "<div class='col-4 text-center' style='color: orange;'>" . $giorni_restanti . " giorno</div>";
          echo "<div class='col-4  '></div>";          
        }
        else{
          echo "<div class='col-4 text-center' style='color: green;'>" . $giorni_restanti . " giorni</div>";
          echo "<div class='col-4  '></div>";
        }
        

        echo
          "</button>
						</h2>
						<div id='" . $var . "' class='accordion-collapse collapse' data-bs-parent='#accordionFlushExample'>
							<div class='accordion-body'>
								<p>" . $row['testo'] . "</p>
                ";
        if (!empty($row['allegati'])) {
          echo "<p class='card-text ml-3'> <a href='" . $percorso_file . "' target='_blank'>
                <button type='button' class='btn btn-link allegato' style='text-decoration: none; padding: 5px; border-radius: 999px;'>
                  <i class='fas fa-file'></i> " . $nome_file . "
                </button>
              </a></p>";
        }
                echo "
							</div>
						</div>
					</div> ";

      } while ($row = pg_fetch_array($result, null, PGSQL_ASSOC));

      echo "</div>";
    } else {
      echo "<p>Non ci sono compiti assegnati";
    }
    ?>


  </main>

  <main class="container my-4" id="persone-section">
    <h1 class="display-6"><strong>Professori</strong></h1>
    <hr color="red">
    <?php

    $codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

    //Visualizza la lista dei professori che insegnano ad un determinato corso
    $q1 = "SELECT u.nome, u.cognome 
					 FROM corso c JOIN insegna i ON c.codice=i.corso JOIN utente u ON u.email=i.docente 
					 WHERE c.codice=$1";

    $result1 = pg_query_params($dbconn, $q1, array($codice_corso));

    if ($row1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {
      echo "<ul class='list-group list-group-flush'>";
      do {
        echo "<li class='list-group-item'>" . $row1['nome'] . " " . $row1['cognome'] . "</li>";
      } while ($row1 = pg_fetch_array($result1, null, PGSQL_ASSOC));
      echo "</ul>";
    } else {
      echo "<p>Nessun partecipante.</p>";
    }

    ?>
    <br>

    <h1 class="display-6"><strong>Compagni di classe</strong></h1>
    <hr>
    <?php
    $codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

    //Visualizza la lista dei studenti che partecipano ad un determinato corso
    $q2 = "SELECT u.nome, u.cognome 
					FROM corso c JOIN partecipa p ON c.codice=p.corso JOIN utente u ON u.email=p.studente 
					WHERE c.codice=$1";

    $result2 = pg_query_params($dbconn, $q2, array($codice_corso));

    if ($row2 = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
      echo "<ul class='list-group list-group-flush'>";
      do {
        echo "<li class='list-group-item'>" . $row2['nome'] . " " . $row2['cognome'] . "</li>";
      } while ($row2 = pg_fetch_array($result2, null, PGSQL_ASSOC));
      echo "</ul>";
    } else {
      echo "<p>Nessun partecipante.</p>";
    }
    ?>

  </main>
    <script>
      var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides((slideIndex += n));
  }

  function currentSlide(n) {
    showSlides((slideIndex = n));
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
      slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
  }
  </script>
  <footer class="bg-light fixed-bottom">
    <div class="container py-3">
      <p class="text-center mb-0">Autori: Emanuele Elie Debach, Fabio Priori, Marco Giangreco &copy; 2023</p>
    </div>
  </footer>

</body>

</html>