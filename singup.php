<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Carica Fontawesome (immagini degli omini accanto ai form) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Signup page</title>
    <!-- Carica gli stili di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Per gli stili nel file "Style.cc"-->
    <link rel="stylesheet" href="style.css">
    <style>
      /* Aggiunge il background grigio e centra il contenitore */
      body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height:100vh;
      }
      #BottoneProsegui{
        padding-left: 0.3cm;
        padding-right: 0.3cm;
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

      /* TODO: Regola l'omino accanto a Nome e cognome*/
    </style>
  </head>
  <body>
    <div class="square">
      <img src="./img/logo.jpg" alt="Logo del sito" class="logo mb-3" onclick="location.href='./index.php'">
      <h2 class="text-center mb-3">Signup</h2>
      <!-- Il form è ancora statico, va settato in modo da verificare che le credenziali inserite siano nel formato giusto -->
      <form name="myForm" action="http://localhost:3000/Logged/registrati.php" method="POST">
        <!-- Per le floating label ho usato Bootstrap. Per la documentazione: https://getbootstrap.com/docs/5.3/forms/floating-labels/ -->
        <!-- Prima riga: form per nome e cognome.-->
        <div class="row">
          <div class="col">
            <!-- IMMAGINE DELL'OMINO: guardare video del seguente link: https://www.youtube.com/watch?v=q93hR316nk4-->
            <div class="mb-3 input-group">
              <div class="input-group-text">
                <i class="fa-solid fa-user"></i>
              </div>
              <div class="form-floating">
                <input type="text" class="form-control" name="nomeInput" placeholder="Nome" required>
                <label for="nomeInput" class="text-black text-opacity-50">Nome</label>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 input-group">
              <div class="input-group-text">
                <i class="fa-solid fa-user"></i>
              </div>
              <div class="form-floating">
                <input type="text" class="form-control" name="cognomeInput" placeholder="Cognome" required>
                <label for="cognomeInput" class="text-black text-opacity-50">Cognome</label>
              </div>
            </div>
          </div>
        </div><!--Fine prima riga-->
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
        <!--Terza riga: Form per scelta scuola.-->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-graduation-cap"></i>
          </div> 
          <div class="form-floating">
            <select class="form-select" name="floatingSelect" aria-label="Floating label select example" required>
              <option selected></option>
              <option value="1">scuola 1</option>
              <option value="2">scuola 2</option>
              <option value="3">scuola 3</option>
            </select>
            <label for="floatingSelect" class="text-black text-opacity-50">Istituto</label>
          </div>
        </div><!--Fine terza riga-->
        <!--Quarta riga: form per la password -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-lock"></i>
          </div> 
          <div class="form-floating">
            <input type="password" class="form-control" name="passwordInput" placeholder="password" required>
            <label for="passwordInput" class="text-black text-opacity-50">Password</label>
          </div>
        </div> <!--Fine quarta riga-->
        <!--Quinta riga: form per reinserire password. DA FARE: CONTROLLARE CHE LA PASSWORD REINSERITA SIA UGUALE A QUELLA INSERITA IN PRECEDENZA -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-key"></i>
          </div> 
          <div class="form-floating">
            <input type="password" class="form-control" id="repasswordInput" placeholder="password" required>
            <label for="repasswordInput" class="text-black text-opacity-50">Reinserisci password</label>
          </div><!--Fine quinta riga-->
        </div> 
        <div class="row" id="BottoneProsegui">
        <button type="submit" class="btn btn-primary">Prosegui</button>
        </div>
        <div class="mt-2">
          <!-- Da inserire il link al sign in -->
          <div style="text-align: center">
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost:3000/login.php">Sei già iscritto? Effettua l'accesso!</a>
          </div>
          
      </div>
      </form>
    </div>

    <!-- Carica gli script di Bootstrap -->
  </body>
</html>