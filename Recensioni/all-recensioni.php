<?php
// Connessione al database
$conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                    user=postgres password=biar")
  or die('Could not connect: ' . pg_last_error());

$q = "SELECT * 
      FROM recensione r JOIN utente u ON u.email=r.utente";

$result = pg_query($conn, $q);

echo "<!DOCTYPE html>
      <html lang='en'>
      <head>
          <!-- Required meta tags -->
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

          <!-- Bootstrap CSS -->
          <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
            integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
      </head>
      <body>";

while ($row = pg_fetch_array($result)) {
  echo "
      <div class='container'>
          <div class='row'>
              <div class='col-md-12 col-lg-10 col-xl-8'>
                  <div class='card'>
                      <div class='card-body p-4'>
                          <h4 class='mb-4 pb-2'>" . $row['nome_recensione'] . " - ";
                          if($row['stelle']=="1"){
                            echo "1 stella</h4>";
                          }
                          else{
                            echo $row['stelle']." stelle</h4>"; 
                          }
                          echo "<div class='row'>
                              <div class='col'>
                                  <div class='d-flex flex-start'>
                                      <img class='rounded-circle shadow-1-strong me-3' src='./img/empty.jpg' alt='avatar' width='65' height='65' />
                                      <div class='flex-grow-1 flex-shrink-1'>
                                          <div>
                                              <div class='d-flex justify-content-between align-items-center'>
                                                  <p class='mb-1'><strong>" . $row['nome'] . " " . $row['cognome'] . "</strong><span class='small'> - " . date('d/m/Y', strtotime($row['data'])) . "</span></p>
                                              </div>
                                              <p class='small mb-0'>" . $row['descrizione'] . "</p>
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
}
echo "</body>
</html>";

?>