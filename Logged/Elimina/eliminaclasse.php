<?php
session_start();
if (isset($_POST["elimina_classe"])) {
    // Elimina il file corrente
    $file = $_POST['link'];
    unlink($file);

    // Elimina le tuple nel database associate alla classe
    // ...

    // Restituisce la risposta in formato JSON
    header("Content-Type: application/json");
    echo json_encode(array("success" => true));
    exit;
}
?>