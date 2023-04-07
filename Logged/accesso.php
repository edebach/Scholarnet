<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso</title>
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

    $email = $_POST['emailInputLogin'];
    $q1 = "select * 
            from utente 
            where email = $1";
    $result = pg_query_params($dbconn, $q1, array($email));
    
    if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
        echo "<script>
                alert('Non sei ancora iscritto');
                window.location.href='http://localhost:3000/login.php';
            </script>";
    }
    else {
        $password = $_POST['passwordInput'];
        $q2 = "select * 
                from utente 
                where email = $1 and pass = $2";
        $result = pg_query_params($dbconn, $q2, array($email,$password));
        if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
            echo "<script>
                    alert('Password errata!');
                    window.location.href='http://localhost:3000/login.php';
                </script>";
        }
        else {
            echo "<script>
                    window.location.href='http://localhost:3000/Logged/IndexLogged.php';
                </script>";
        }
    }
?>
</body>
</html>

