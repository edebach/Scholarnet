<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione corso</title>

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

    //Quando viene creato un corso viene generato in maniera casuale un codice di 8 cifre alfanumeriche
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codice = substr(str_shuffle($chars), 0, 8);

    $nomeCorso = $_POST['nomeCorso'];
    $materia = $_POST['materia'];

    if($materia==""){
        $materia = null;
    }

    $numIscritti = 0;
    //TODO: Per adesso ho inizializzato il link ad una stringa vuota, parte di implementazione del link alla classe
    $link = '';

    //eseguo un ciclo do-while fin quando mi genera un codice che non sta nel db
    do{
        $q1 = "select * from corso where codice=$1";
        $result = pg_query_params($dbconn, $q1, array($nomeCorso));
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codice = substr(str_shuffle($chars), 0, 8);
    } while(($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)));
        
    
    //inserisco i valori nella tabella corso
    $q2 = "insert into corso values ($1, $2, $3, $4, $5)";
    $data = pg_query_params($dbconn, $q2, array($codice, $nomeCorso, $materia, $numIscritti, $link));
    if ($data) {
        echo "<script>
                alert('Corso creato con successo!');
                window.location.href='../IndexLogged.php';
            </script>";
    }
    ?>
</body>
</html>