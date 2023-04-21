<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
</head>
<body>
    <?php
    session_start();
    //File registrati.php pensato come fase di registrazione di un utente
    //Connessione al dbname Scholarnet
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /");
    }
    else {
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar") 
                or die('Could not connect: ' . pg_last_error());
    }

    $nome = $_SESSION['nome'];
    $cognome = $_SESSION['cognome'];
    $email = $_POST['emailInput'];
    $istituto = $_SESSION['istituto'];
    $password = $_POST['passwordInput'];
    $dataN=$_SESSION['dataN'];
    $sesso=$_SESSION['sesso'];
    // TODO: Aggiungere la variabile relativa a flagStudnete


    //query che restituisce tutte le tuple della tabella utente con l'email inserita nella form signup.php
    $q1 = "SELECT email 
            FROM utente 
            WHERE email=$1";

    //il risultato della query me lo salvo in un array
    $result = pg_query_params($dbconn, $q1, array($email));
    
    //scorro sulle tuple dell'array e verifico se l'email inserita si trova nel mio db
    if (($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
        echo "<script>
                alert('Risulti già iscritto!');
                window.location.href='../Login/login.html';
            </script>";
    }
    else{
        //inserimento utente nel db
        //una volta che ho verificato l'utente non è registrato, inserisco i dati forniti nel form signup.php, nel mio db
        $q2 = "INSERT INTO utente VALUES ($1, $2, $3, $4, $5, $6, $7)";
 
        //il risultato della query me lo salvo in un array, in questo caso con tutti i dati forniti
        $data = pg_query_params($dbconn, $q2, array($nome, $cognome, $email, $password, $istituto,$sesso,$dataN));
        if ($data) {
            echo "<script>
                    alert('Registrazione effettuata con successo!');
                    window.location.href='../Login/login.html';
                </script>";
        }
    }
    session_abort();

    ?>
</body>
</html>