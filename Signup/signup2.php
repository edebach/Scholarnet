<!DOCTYPE html>
<html lang="it">
<?php
session_start();
$_SESSION['nome'] = $_POST['nomeInput'];
$_SESSION['cognome']  = $_POST['cognomeInput'];
$_SESSION['istituto']  = $_POST['Istituti'];
$_SESSION['dataN']  = $_POST['datePicker'];
$_SESSION['sesso']  = $_POST['sesso'];
$_SESSION['flag'] = $_POST['flag'];

?>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Carica Fontawesome (immagini degli omini accanto ai form) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Signup 2</title>
    <!-- Carica gli stili di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Stili per il calendario, link: https://codepen.io/SaadRegal/pen/ezVBJL-->

    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


    <!--Verifica password-->
    <script>
      function validateForm() {
        var password = document.forms["myForm"]["passwordInput"].value;
        var repassword = document.forms["myForm"]["repasswordInput"].value;
        if (password != repassword) {
          alert("Le password non corrispondono");
          return false;
        }
        return true;
      }
    </script>

    <style>
      /* Aggiunge il background grigio e centra il contenitore */
      body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height:100vh;
      }
      #BottoneIscriviti{
        padding-left: 0.3cm;
        padding-right: 0.3cm;
      }
      #BottoneIndietro{
        padding-left: 0.3cm;
        padding-right: 0.3cm;
        padding-top: 0.1cm;
      }

      /* Aggiunge la forma quadrata al contenitore (forma diversa salla pagina di login)*/
      .square {
        width: 650px;
        height: 750px;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      /* Aggiunge la larghezza e l'altezza al logo */
      .logo {
        width: 150px;
        height: 150px;
      }
      /*Serve a regolare la larghezza dei campi della form*/
      form[name="myForm"] {
        width: 52%;
      }

    </style>
  </head>
  <body>
    <div class="square">
      <img src="../img/logo.jpg" alt="Logo del sito" class="logo mb-3">
      <h2 class="text-center mb-3">Signup</h2>
      <form name="myForm" action="./registrati.php" method="POST" onsubmit="return validateForm()">
        <!-- Per le floating label ho usato Bootstrap. Per la documentazione: https://getbootstrap.com/docs/5.3/forms/floating-labels/ -->
        <!-- Seconda riga: form solo per email.-->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" name="emailInput" aria-describedby="emailHelp" placeholder="Enter email" required>
            <label for="emailInput" class="text-black text-opacity-50">Email</label>
          </div>
        </div><!--Fine seconda riga-->
        
        <!--Terza riga: form per la password -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-lock"></i>
          </div> 
          <div class="form-floating">
            <input type="password" class="form-control" name="passwordInput" placeholder="password" required>
            <label for="passwordInput" class="text-black text-opacity-50">Password</label>
          </div>
        </div> <!--Fine terza riga-->
        <!--Quarta riga: form per reinserire password -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-key"></i>
          </div> 
          <div class="form-floating">
            <input type="password" class="form-control" id="repasswordInput" placeholder="password" required>
            <label for="repasswordInput" class="text-black text-opacity-50">Reinserisci password</label>
          </div>
        </div> 
        <!--Fine Quarta riga-->
        <div class="row" id="BottoneIscriviti">
          <button type="submit" class="btn btn-primary">Iscriviti</button>
        </div>
        <div class="row" id="BottoneIndietro">
          <button onclick="window.history.back()" class="btn btn-secondary">Indietro</button>
        </div>
      </form>
    </div>
  </body>
</html>