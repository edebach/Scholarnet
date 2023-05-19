
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

    //Quando viene creato un corso viene generato in maniera casuale un codice di 8 cifre alfanumeriche
    
    $nomeCorso = $_POST['nomeCorso'];
    $materia = $_POST['materia'];

    if ($materia == "") {
        $materia = null;
    }

    //eseguo un ciclo do-while fin quando mi genera un codice non pesente nel db
    do {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codice = substr(str_shuffle($chars), 0, 8);
        $q1 = "SELECT * FROM corso WHERE codice=$1";
        $result = pg_query_params($dbconn, $q1, array($codice));

    } while (($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)));

    $file_originale = "../Classi/Classe.php"; // percorso del file PHP originale
    $nome_file_nuovo = "Classe_" . $codice . ".php"; // crea il nuovo nome del file con il codice del corso

    // imposta la cartella di destinazione dove verrà salvato il nuovo file
    $cartella_destinazione = "../Classi/";

    // copia il file originale nella cartella di destinazione con il nuovo nome
    if (copy($file_originale, $cartella_destinazione . $nome_file_nuovo)) {
        // il file è stato copiato correttamente
    } else {
        // si è verificato un errore durante la copia del file
        echo "<script>
        alert('Errore durante la copia del file.');
        window.location.href='../IndexLogged.php';
        </script>";
    }
    //inserisco i valori nella tabella corso
    $link = $cartella_destinazione . $nome_file_nuovo;

    // Array di 5 link di immagini
    $image_links = array(
        "../../img/link1.jpg",
        "../../img/link2.jpg",
        "../../img/link3.png",
        "../../img/link4.jpg",
        "../../img/link5.jpeg"
    );

    // Genera un numero casuale tra 0 e 4 per selezionare un link casuale dall'array
    $random_index = rand(0, 4);
    $link_imm = $image_links[$random_index];

    $q2 = "INSERT INTO corso(codice,nome,materia,link, link_imm) VALUES ($1, $2, $3, $4, $5)";
    $data = pg_query_params($dbconn, $q2, array($codice, $nomeCorso, $materia, $link, $link_imm));

    //inserisco i valori nella tabella insegna
    $flag = $_SESSION['flag']; //do per scontato che sia un docente
    $email = $_SESSION['email'];


    $q4 = "INSERT INTO insegna VALUES($1, $2)";
    $data2 = pg_query_params($dbconn, $q4, array($email, $codice));

    if ($data) {
        echo "<script>
                alert('Corso creato con successo!');
            </script>";
        header("Location: $link");
    }
?>