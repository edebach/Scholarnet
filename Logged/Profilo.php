<!DOCTYPE html>
<?php
session_start();
$dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
            user=postgres password=biar") 
            or die('Could not connect: ' . pg_last_error());
?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .gradient-custom {
                /* fallback for old browsers */
                background: #f6d365;

                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
                }
        </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

     <!-- Carica Fontawesome (immagini degli omini accanto ai form) -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .btn-close {
        position: absolute;
        top: .2cm;
        right: .2cm;
      }
    </style>
      
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
                        <!-- immagine inserita da utente-->
                        <img src=<?php
                          include "./Profilo/fotoprofilo.php"
                          ?>
                          alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                          <?php
                          include "./Profilo/nome_studprof.php"
                          ?>
                        <i class="far fa-edit mb-5"></i>
                      </div>
                      <div class="col-md-8">
                        <div class="card-body p-4">
                          <h6>Informazioni</h6>
                          <hr class="mt-0 mb-4">
                          <div class="row pt-1">
                            <div class="col-6 mb-3">
                              <h6>Email</h6>
                              <p class="text-muted">info@example.com</p>
                            </div>
                            <div class="col-6 mb-3">
                              <h6>Phone</h6>
                              <p class="text-muted">123 456 789</p>
                            </div>
                          </div>
                          <h6>Projects</h6>
                          <hr class="mt-0 mb-4">
                          <div class="row pt-1">
                            <div class="col-6 mb-3">
                              <h6>Recent</h6>
                              <p class="text-muted">Lorem ipsum</p>
                            </div>
                            <div class="col-6 mb-3">
                              <h6>Most Viewed</h6>
                              <p class="text-muted">Dolor sit amet</p>
                            </div>
                          </div>
                          <div class="d-flex justify-content-start">
                            <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                            <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
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