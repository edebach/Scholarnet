<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina di login</title>
    <!-- Carica gli stili di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Carica Fontawesome (immagini degli omini accanto ai form) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      /* Aggiunge il background grigio e centra il contenitore */
      body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      /* Aggiunge la forma quadrata al contenitore */
      .square {
        width: 450px;
        height: 550px;
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
    </style>
  </head>
  <body>
    <div class="square">
      <img src="./img/logo.jpg" alt="Logo del sito" class="logo mb-3" onclick="location.href='./index.php'">
      <h2 class="text-center mb-3">Login</h2>
      <!-- Il form è ancora statico, va settato in modo da verificare le credenziali e fornire accesso al sito -->
      
      <form name="myForm" action="http://localhost:3000/Logged/accesso.php" method="POST">
      
      <!--Prima riga: form per la password -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" name="emailInputLogin" aria-describedby="emailHelp" placeholder="Enter email" required>
            <label for="emailInputLogin" class="text-black text-opacity-50">Email</label>
          </div>
        </div><!--Fine prima riga-->
        <!--Seconda riga: form per la password -->
        <div class="mb-3 input-group">
          <div class="input-group-text">
            <i class="fa-solid fa-lock"></i>
          </div> 
          <div class="form-floating">
            <input type="password" class="form-control" name="passwordInput" placeholder="password" required>
            <label for="passwordInput" class="text-black text-opacity-50">Password</label>
          </div>
        </div> <!--Fine seconda riga-->
        <!--Terza riga: remember me checkbox -->
        <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="dropdownCheck">
              <label class="form-check-label" for="dropdownCheck">
                Remember me
              </label>
            </div>
          </div><!--Fine terza riga-->
        <button type="submit" class="btn btn-primary">Accedi</button>
        <div class="mt-1">
            <!-- Da inserire il link al sign up -->
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost:3000/singup.php">Primo accesso? Iscriviti ora!</a>
        </div>
      </form>
    </div>
  </body>
</html>