<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iscrizione corso</title>
</head>
<body>
    <?php
        session_start();
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
        $istituto = $_SESSION['istituto'];
        $dataN=$_SESSION['dataN'];
        $sesso=$_SESSION['sesso'];

        $codCorso = $_POST['codiceCorso'];

        //verifico che il codice del corso inserito sia corretto
        $q1 = "select * 
            from corso 
            where codice=$1";

        $result = pg_query_params($dbconn, $q1, array($codCorso));
        if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
            echo "<script>
                    alert('Corso non trovato. Verifica il codice e l\'account, quindi riprova.');
                    window.location.href='../IndexLogged.php';
                </script>";
        }else{
        $link = $tuple['link'];
        }

        //inserisco i valori nella tabella partecipa
        $email = $_SESSION['email'];

        $q2 = "SELECT studente 
            FROM partecipa 
            WHERE corso=$1";

    //il risultato della query me lo salvo in un array
    $result1 = pg_query_params($dbconn, $q2, array($codCorso));
    
    //scorro sulle tuple dell'array e verifico se l'email inserita si trova nel mio db
    if (($tuple=pg_fetch_array($result1, null, PGSQL_ASSOC))) {
        echo "<script>
            if (confirm('Risulti già iscritto al corso! Vuoi comunque procedere?')) {
                window.location.href = '$link'; 
            } else {
                window.location.href='../IndexLogged.php'; 
            }
        </script>";
    }
        
        $q4 = "INSERT INTO partecipa VALUES($1, $2)";
        $data2 = pg_query_params($dbconn, $q4, array($email, $codCorso));

        echo "<script>
            window.location.href='$link';
            </script>";
        
    ?>
</body>
</html>