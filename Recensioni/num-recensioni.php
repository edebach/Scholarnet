<?php
    // Connessione al database
    $conn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
                    user=postgres password=biar")
        or die('Could not connect: ' . pg_last_error());



    $q = "SELECT COUNT(*) AS n
            FROM recensione";

    $result = pg_query($conn, $q);
    while ($row = pg_fetch_assoc($result)) {
        if ($row["n"] == 1)
            $row["n"] . " recensione totale";
        else
            echo $row["n"] . " recensioni totali";
    }

?>