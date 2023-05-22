<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    echo "<script> alert(' Sessione scaduta, effettua nuovamente l\' accesso');
                    window.location.href='../Login/login.html';
      </script>";
    exit();
  }

  //Connessione al db
  $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                  user=postgres password=biar")
    or die('Could not connect: ' . pg_last_error());
  
  // Calcola il numero totale di corsi a cui è iscritto l'utente loggato (studente o docente)
  $q1 = "SELECT SUM(conteggio) AS somma
          FROM (
            SELECT count(*) AS conteggio
            FROM partecipa
            WHERE studente=$1
            UNION ALL
            SELECT count(*) AS conteggio
            FROM insegna
            WHERE docente=$1
          ) AS conteggi; ";
  $ris = pg_query_params($dbconn, $q1, array($_SESSION['email']));
  $num_corsi = pg_fetch_result($ris, 0, 'somma');

  // Determina il corso con più iscritti tra i corsi a cui partecipa l'utente loggato come studente o docente
  $q2 = " SELECT COALESCE(c.nome, '') AS corso, COUNT(*) AS num_iscritti
          FROM corso c LEFT JOIN insegna i ON c.codice = i.corso
                       LEFT JOIN partecipa p ON c.codice = p.corso
          WHERE i.docente = $1 OR p.studente = $1
          GROUP BY c.nome
          ORDER BY num_iscritti DESC
          LIMIT 1; ";
  $max_corso = "";
  $ris = pg_query_params($dbconn, $q2, array($_SESSION['email']));
  if (pg_num_rows($ris) > 0)
    $max_corso = pg_fetch_result($ris, 0, 'corso');
?>

<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

  <!-- Librerie di modal -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <!-- Carica Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./Profilo/profilo.css">

  <!-- Carica il file js -->
  <script src="./Profilo/profilo.js" language="javascript"></script>

</head>

<body>
  
  <section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
          <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
              <button type="button" class="btn-close" aria-label="Close" onclick="window.history.back()"></button>
              
              <div class="col-md-4 gradient-custom text-center text-white"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <!-- immagine profilo in base a professione e sesso -->
                <?php include "./Profilo/fotoprofilo.php" ?>
                <?php include "./Profilo/nome_studprof.php" ?>
              </div>

              
              <div class="col-md-8">
                <div class="card-body p-4">

                  <!-- Sezione 'Informazioni' -->
                  <h6>Informazioni</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">

                      <!-- Email -->
                      <h6>Email</h6>
                      <p class="text-muted">
                        <span class="text-muted" id="email">
                          <?php echo $_SESSION["email"]; ?>
                        </span>
                      </p>
                    </div>

                    <!-- Telefono -->
                    <div class="col-6 mb-3">
                      <h6>Telefono</h6>
                      <p class="text-muted">
                        <span class="editable" id="phone">
                          <?php echo $_SESSION["telefono"]; ?>
                        </span>
                        <!-- Verifica il formato del telefono -->
                        <input type="tel" class="form-control profilo d-none" id="phone-input"
                               oninput="validaInputTel()" pattern="^\+?\d{1,3}\s?\d{6,}$"
                               value="<?php echo $_SESSION["telefono"]; ?>">
                        <span id="error-msg" style="color: red;"></span>
                      </p>
                    </div>
                  </div>

                  <!-- Sezione 'Corsi' -->
                  <h6>Corsi</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Miei Corsi</h6>
                      <p class="text-muted">
                        <?php echo $num_corsi; ?>
                      </p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Corso con più iscritti</h6>
                      <p class="text-muted">
                        <?php echo $max_corso; ?>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <div>
                      <button type="button" class="btn btn-link p-0 btn-sm" id="edit-password-btn"
                        data-target="#password-modal" data-toggle="modal">Modifica password</button>
                    </div>
                    <div>
                      <button type="button" class="btn btn-primary btn-sm me-2" id="edit-profile-btn">
                        Modifica profilo</button>
                      <button type="button" class="btn btn-success btn-sm d-none" id="save-profile-btn">
                        Salva modifiche</button>
                      <button type="button" class="btn btn-secondary btn-sm d-none" id="cancel-profile-btn">
                        Annulla modifiche</button>
                    </div>


                    <!-- Modal: modifica password -->
                    <div class="modal fade" id="password-modal" tabindex="-1" role="dialog"
                      aria-labelledby="password-modal-label" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="password-modal-label">Modifica password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form name="resetPassword" action="./Profilo/resetPassword.php" method="POST"
                            onSubmit="return confrontaPassword();">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="old-password">Vecchia password</label>
                                <input type="password" class="form-control" id="vecchia-password"
                                  name="vecchia-password" required>
                              </div>
                              <div class="form-group">
                                <label for="new-password">Nuova password</label>
                                <input type="password" class="form-control" id="nuova-password" name="nuova-password"
                                  required>
                              </div>
                              <div class="form-group">
                                <label for="confirm-password">Conferma nuova password</label>
                                <input type="password" class="form-control" id="conferma-password"
                                  name="conferma-password" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                              <button type="submit" class="btn btn-primary " id="save-password-btn">Salva</button>
                            </div>
                          </form>
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
    </div>
    </div>
  </section>
</body>

</html>