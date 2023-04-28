<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
		$(document).ready(function() {
			$(".btn-elimina-classe").click(function() {
				if (confirm("Sei sicuro di voler eliminare la classe?")) {
                    var url = $(this).data("action");
                    var link = $(this).data("href");

					$.ajax({
                        url: url,
                        type: 'post',
                        data: { elimina_classe: true, link: link },
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
                                alert("Classe eliminata correttamente.");
                            } else {
                                alert("Errore durante l'eliminazione della classe.");
                            }
                        },
                        error: function(jqXHR, status, error) {
                            console.log(status + ": " + error);
                            alert("Errore durante l'eliminazione della classe.");
                        }
                    });
                    
				}
			});
		});
	</script>

</head>
<body>
    <?php

    //Connessione al db

    $dbconn = pg_connect("host=localhost port=5432 dbname=Scholarnet 
            user=postgres password=biar") 
            or die('Could not connect: ' . pg_last_error());


    $email = $_SESSION['email'];
    $flag = $_SESSION['flag'];

    /*foreach($GLOBALS as $k => $v){
        echo "$k => ";
        //funzione che ti permette di stampare qualcosa in formato leggibile
        print_r($v);
        echo "<br><hr/><br>";
    }*/

    //Controlliamo se si tratta di uno studente o docente
    //Docente
    if($flag=='0'){

        //Genera tutte le tuple che il docente insegna ai corsi
        $q1a = "SELECT * FROM corso c JOIN insegna i ON c.codice=i.corso WHERE i.docente=$1";
        $result1a = pg_query_params($dbconn, $q1a, array($email));

        if($row1=pg_fetch_array($result1a, null, PGSQL_ASSOC)){
            echo "<div class='row'>";
            do {
                //Parte l'interfaccia grafica: implementazione delle card corso
                echo "        
                <div class='card' style='width: 18rem;'>
                    <div class='position-relative'>
                        <img src='https://images7.alphacoders.com/114/1141397.jpg' class='card-img-top'>
                        <div class='position-absolute top-0 end-0'>
                            <div class='dropdown'>
                                <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='bi bi-three-dots-vertical'></i>
                                </button>
                                <ul class='dropdown-menu'>
                                    <li>
                                    <button class='btn btn-light d-inline-block mx-1 btn-elimina-classe' 
                                            id='btn-elimina-classe-" . $row1['link'] . "' 
                                            data-action='./Elimina/eliminaclasse.php'  
                                            data-href='". $row1['link']."'>Elimina classe
                                    </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title'><a href='./Logged/".$row1['link']."'>".$row1['nome']."</a></h5>
                        <p class='card-text'>".$row1['materia']."</p>
                    </div>
                </div>";
            
            } while ($row1 = pg_fetch_array($result1a));
            
        }
        
        //Genera tutte le tuple che il docente partecipa ai corsi
        $q1b = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
        $result1b = pg_query_params($dbconn, $q1b, array($email));

    
        if($row2=pg_fetch_array($result1b, null, PGSQL_ASSOC)){

            //Faccio il doppio ciclo while per evitare che il docente sia iscritto e insegna lo stesso corso
            while ($row1 = pg_fetch_array($result1a)){
                while ($row2= pg_fetch_array($result1b)){
                    if($row1['corso']!=$row2['corso']){
                        //Parte l'interfaccia grafica: implementazione delle card corso
                        echo "        
                        <div class='card' style='width: 18rem;'>
                            <div class='position-relative'>
                                <img src='https://images7.alphacoders.com/114/1141397.jpg' class='card-img-top'>
                                <div class='position-absolute top-0 end-0'>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='bi bi-three-dots-vertical'></i>
                                        </button>
                                        <ul class='dropdown-menu'>
                                            <li><button class='btn btn-light d-inline-block mx-1' id='btn-annulla-iscrizione'>Annulla iscrizione</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-title'><a href='./Logged/".$row2['link']."'>".$row2['nome']."</a></h5>
                                <p class='card-text'>".$row2['materia']."</p>
                            </div>
                        </div>";
                    }
                }
            }

            echo "</div>";
        }
        else{
            echo "<p>NON SEI ISCRITTO A NESSUN CORSO!</p>";
        }
        
    }
    //Studente
    else {

        //Genera tutte le tuple che lo studente partecipa ai corsi
        $q2 = "SELECT * FROM corso c JOIN partecipa p ON c.codice=p.corso WHERE p.studente=$1";
        $result2 = pg_query_params($dbconn, $q2, array($email));
        
        if(($row3=pg_fetch_array($result2, null, PGSQL_ASSOC))){
            echo "<div class='row'>";
            do {
                //Parte l'interfaccia grafica: implementazione delle card corso
                echo "        
                <div class='card' style='width: 18rem;'>
                    <div class='position-relative'>
                        <img src='https://images7.alphacoders.com/114/1141397.jpg' class='card-img-top'>
                        <div class='position-absolute top-0 end-0'>
                            <div class='dropdown'>
                                <button class='btn btn-secondary' style='opacity: 0.6;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='bi bi-three-dots-vertical'></i>
                                </button>
                                <ul class='dropdown-menu'>
                                    <li><button class='btn btn-light d-inline-block mx-1' id='btn-annulla-iscrizione'>Annulla iscrizione</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title'><a href='./Logged/".$row3['link']."'>".$row3['nome']."</a></h5>
                        <p class='card-text'>".$row3['materia']."</p>
                    </div>
                </div>";

            }  while ($row3 = pg_fetch_array($result2));
            echo "</div>";
        }
        else{
            echo "<p>NON SEI ISCRITTO A NESSUN CORSO!</p>";
        }
    }
    ?>
</body>
</html>