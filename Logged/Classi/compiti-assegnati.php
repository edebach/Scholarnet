<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compiti Assegnati</title>
</head>
<body>
    <?php
        $codice_corso = substr(basename($_SERVER["PHP_SELF"]), -12, 8);

        
        //Query
        $q = "SELECT * FROM compito WHERE classe=$1 AND data_scadenza is not null";
        $result = pg_query_params($dbconn, $q, array($codice_corso));

        if($row=pg_fetch_array($result, null, PGSQL_ASSOC)){
            do{
                echo "
                        <div class='mySlides'>
                            <h2 class='mb-4'>Compiti assegnati</h2>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Compito</th>
                                        <th scope='col'>Data di scadenza</th>
                                        <th scope='col'>Tempo rimanente</th>
                                    </tr>
                                </thead>
                                <tbody>";

                                    //impostiamo la data di scadenza del compito
                                    $data_scadenza = strtotime($row['data_scadenza']);

                                    //impostiamo la data attuale
                                    $data_attuale = time();

                                    //calcoliamo il numero di giorni rimanenti
                                    $giorni_restanti = floor(($data_scadenza - $data_attuale) / (60 * 60 * 24));
                                    $giorni_restanti+=1;

                        echo            "<tr>
                                        <td>".$row['titolo']."</td>
                                        <td>".date('d/m/Y', strtotime($row['data_scadenza']))."</td>";
                                        if($giorni_restanti<0){
                                            echo "<td>Tempo scaduto</td>";
                                        }
                                        else if($giorni_restanti==1){
                                            echo "<td>".$giorni_restanti." giorno</td>";
                                        }else{
                                            echo "<td>".$giorni_restanti." giorni</td>";
                                        }
                                        
                        echo         "</tr>
                                    <tr>
                                        <td colspan='3'>
                                            <p>".$row['testo']."</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    ";
                
            } while($row=pg_fetch_array($result, null, PGSQL_ASSOC));
        }
        else{
            echo "
                <div class='mySlides'>
                    <h2 class='mb-4'>Compiti assegnati</h2>
                    <p>Non ci sono compiti assegnati</p>
                </div>";
        }


    ?>
</body>
</html>