<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accesso</title>
</head>

<body>
  <?php
  session_start();
  //Connessione al dbname Scholarnet
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
  } else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                        user=postgres password=biar")
      or die('Could not connect: ' . pg_last_error());
  }

  $email = $_POST['emailInputLogin'];

  //query che restituisce tutte le tuple della tabella utente con l'email inserita nella form login.php
  $q1 = "SELECT * 
                    FROM utente 
                    WHERE email = $1";

  //il risultato della query me la salvo in un array
  $result = pg_query_params($dbconn, $q1, array($email));

  //scorro sulle tuple dell'array e verifico se l'email inserita si trova nel mio db
  if (!($tuple = pg_fetch_array($result, null, PGSQL_ASSOC))) {
    echo "<script>
                        alert('Non sei ancora iscritto');
                        window.location.href='../Login/login.html';
                    </script>";
  } else {
    $password = $_POST['passwordInput'];

    //una volta che ho verificato l'utente è registrato verifico se ha inserito una corretta password
    $q2 = "SELECT * 
                        FROM utente 
                        WHERE email = $1 AND pass = $2";
    $result = pg_query_params($dbconn, $q2, array($email, $password));
    if (!($tuple = pg_fetch_array($result, null, PGSQL_ASSOC))) {
      echo "<script>
                            alert('Password errata!');
                            window.location.href='../Login/login.html';
                        </script>";
    } else {
      $_SESSION['email'] = $tuple['email'];
      $_SESSION['nome'] = $tuple['nome'];
      $_SESSION['cognome'] = $tuple['cognome'];
      $_SESSION['istituto'] = $tuple['istituto'];
      $_SESSION['sesso'] = $tuple['sesso'];
      $_SESSION['dataN'] = $tuple['dataN'];
      $_SESSION['telefono'] = $tuple['telefono'];

      if ($tuple['flagStudente'] == "t") {
        $_SESSION['flag'] = "1";
      } else {
        $_SESSION['flag'] = "0";
      }
      $_SESSION['immagine_profilo'] = $tuple['immagine'];

      header("Location: ../Logged/IndexLogged.php");

    }

  }

  ?>
</body>

</html>