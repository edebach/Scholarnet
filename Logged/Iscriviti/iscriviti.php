
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

    $nome = $_SESSION['nome'];
    $cognome = $_SESSION['cognome'];
    $istituto = $_SESSION['istituto'];
    $dataN = $_SESSION['dataN'];
    $sesso = $_SESSION['sesso'];
    $studente = $_SESSION['flag'];

    $codCorso = $_POST['codiceCorso'];

    //verifico che il codice del corso inserito sia corretto
    $q1 = "select * 
            from corso 
            where codice=$1";

    $result = pg_query_params($dbconn, $q1, array($codCorso));
    if (!($tuple = pg_fetch_array($result, null, PGSQL_ASSOC))) {
        echo "<script>
                    alert('Corso non trovato. Verifica il codice e l\'account, quindi riprova.');
                    window.location.href='../IndexLogged.php';
                </script>";
    } else {
        $link = $tuple['link'];
    }

    //inserisco i valori nella tabella partecipa
    $email = $_SESSION['email'];

    $q2 = "SELECT studente 
            FROM partecipa 
            WHERE corso=$1 AND studente=$2";

    //il risultato della query me lo salvo in un array
    $result1 = pg_query_params($dbconn, $q2, array($codCorso, $email));

    //scorro sulle tuple dell'array e verifico se l'email inserita si trova nel mio db
    if (($tuple = pg_fetch_array($result1, null, PGSQL_ASSOC))) {
        echo "<script>
            if (confirm('Risulti già iscritto al corso! Vuoi comunque procedere?')) {
                window.location.href = '$link'; 
            } else {
                window.location.href='../IndexLogged.php'; 
            }
        </script>";
    }
    $q3 = "SELECT docente 
    FROM insegna 
    WHERE corso=$1 AND docente=$2";

    //il risultato della query me lo salvo in un array
    $result2 = pg_query_params($dbconn, $q3, array($codCorso, $email));

    //scorro sulle tuple dell'array e verifico se l'email inserita si trova nel mio db
    if (($tuple = pg_fetch_array($result2, null, PGSQL_ASSOC))) {
        echo "<script>
        if (confirm('Risulti già un docente in questo corso! Vuoi comunque procedere?')) {
            window.location.href = '$link'; 
        } else {
            window.location.href='../IndexLogged.php'; 
        }
    </script>";
    }
    if ($studente) {

        $q4 = "INSERT INTO partecipa(studente,corso) VALUES($1, $2)";
        $data2 = pg_query_params($dbconn, $q4, array($email, $codCorso));
    } else {
        $q4 = "INSERT INTO insegna(docente,corso) VALUES($1, $2)";
        $data2 = pg_query_params($dbconn, $q4, array($email, $codCorso));
    }

    echo "<script>
            window.location.href='$link';
            </script>";


?>
