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

    // Controllo che la vecchia password sia stata inserita correttamente
    print_r($_POST);
    $email = $_SESSION['email'];
    $vecchia_password = $_POST['vecchia-password'];
    $query1 = "SELECT * FROM utente WHERE email = $1 AND pass = $2";
    $result = pg_query_params($dbconn, $query1, array($email,$vecchia_password));
    if (pg_num_rows($result) == 0) {
        echo "<script> 
                alert('La vecchia password non è corretta.');
                window.location.href='../Profilo.php';
                </script>";
        exit();
    }

    // Controllo che la nuova password e la conferma della password corrispondano
    $nuova_password = $_POST['nuova-password'];
    $conferma_password = $_POST['conferma-password'];
    if ($nuova_password !== $conferma_password) {
        echo "<script> 
                alert('Le password non coincidono.');
                window.location.href='../Profilo.php';
            </script>";
        exit();
    }

    // Aggiornamento della password dell'utente nel database
    $query2 = "UPDATE utente SET pass = $1 WHERE email = $2";
    $result = pg_query_params($dbconn, $query2, array($nuova_password,$email));
    if (!$result) {
        echo "<script> 
            alert('Si è verificato un errore nell\'aggiornamento della password.');
            window.location.href='../Profilo.php';
            </script>";
       
        exit();
    }

    // La password è stata aggiornata con successo
    echo "<script> 
        alert('La password è stata aggiornata con successo.');
        window.location.href='../Profilo.php';
        </script>";
    exit();
?>