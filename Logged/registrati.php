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
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /");
    }
    else {
        $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                user=postgres password=biar") 
                or die('Could not connect: ' . pg_last_error());
    }

    $nome = $_POST['nomeInput'];
    $cognome = $_POST['cognomeInput'];
    $email = $_POST['emailInput'];
    $istituto = $_POST['floatingSelect'];
    $password = $_POST['passwordInput'];


    //verifica email già usata
    $q1 = "select email 
            from utente 
            where email=$1";

    $result = pg_query_params($dbconn, $q1, array($email));
    
    if (($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
        echo "<script>
                alert('Risulti già iscritto!');
                window.location.href='http://localhost:3000/login.php';
            </script>";
    }
    else{
        //inserimento utente nel db
        $q2 = "insert into utente values ($1, $2, $3, $4, $5)";
        $data = pg_query_params($dbconn, $q2, array($nome, $cognome, $email, $password, $istituto));
        if ($data) {
            echo "<script>
                    alert('Registrazione effettuata con successo!');
                    window.location.href='http://localhost:3000/login.php';
                </script>";
        }
    }

    ?>
</body>
</html>