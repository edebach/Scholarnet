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


    $nomeCorso = $_POST['nomeCorso'];
    $materia = $_POST['materia'];

    if($materia==""){
        $materia = null;
    }

    $numIscritti = 0;
    //TODO: Per adesso ho inizializzato il link ad una stringa vuota, parte di implementazione del link alla classe


    //eseguo un ciclo do-while fin quando mi genera un codice che non sta nel db
    do{
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codice = substr(str_shuffle($chars), 0, 8);
        $q1 = "SELECT * FROM corso WHERE codice=$1";
        $result = pg_query_params($dbconn, $q1, array($codice));

    } while(($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)));
        
    $nome_file_originale = "../Classi/Classe.php"; // nome del file PHP originale
    $nome_file_nuovo = "Classe_" . $codice . ".php"; // crea il nuovo nome del file con il codice del corso

    // imposta la cartella di destinazione dove verrà salvato il nuovo file
    $cartella_destinazione = "../Classi/";

    // copia il file originale nella cartella di destinazione con il nuovo nome
    if (copy($nome_file_originale, $cartella_destinazione . $nome_file_nuovo)) {
        // il file è stato copiato correttamente, rinomina il nuovo file
        // rename($cartella_destinazione . $nome_file_nuovo, $cartella_destinazione . $nome_file_nuovo);
        // echo "File generato correttamente.";
    } else {
        // si è verificato un errore durante la copia del file
        echo "<script>
        alert('Errore durante la copia del file.');
        window.location.href='../IndexLogged.php';
        </script>";
    }
    //inserisco i valori nella tabella corso
    $link = $cartella_destinazione. $nome_file_nuovo;
    $q2 = "INSERT INTO corso VALUES ($1, $2, $3, $4, $5)";
    $data = pg_query_params($dbconn, $q2, array($codice, $nomeCorso, $materia, $numIscritti, $link));
    print_r($data);
    if ($data) {
        echo "<script>
                alert('Corso creato con successo!');
            </script>";
            header("Location: $link");
    }
    ?>
</body>
</html>