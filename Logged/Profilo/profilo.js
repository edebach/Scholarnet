// Viene eseguito quando la pagina è completamente caricata 
$(document).ready(function () {
  var passwordModal = new bootstrap.Modal(
    document.getElementById("password-modal")
  );

  //Gestisce il click sul pulsante "Modifica password"
  $("#edit-password-btn").click(function () {
    //La funzione passwordModal.show() viene chiamata per mostrare il modal
    passwordModal.show();
  });

  // Gestisce il click sul pulsante "Modifica profilo"
  $("#edit-profile-btn").on("click", function () {
    $(".editable").addClass("d-none"); //Viene nascosta la classe editable
    $(".form-control.profilo").removeClass("d-none"); //Viene mostrata l'input tel di telefono
    $("#edit-profile-btn").addClass("d-none"); //Viene nascosto il pulsante "Modifica profilo"
    $("#save-profile-btn").removeClass("d-none"); //Viene mostrato il pulsante "Salva modifiche"
    $("#cancel-profile-btn").removeClass("d-none"); //Viene mostrato il pulsante "Annulla modifiche"
  });

  // Gestisce il click sul pulsante "Annulla modifiche"
  $("#cancel-profile-btn").on("click", function () {

    // Ripristina i valori precedenti di email e telefono
    $("#phone-input").val($("#phone").text());

    // Nascondi il pulsante "Salva modifiche" e mostra il pulsante "Modifica profilo" e l'input tel di telefono
    $(".editable").removeClass("d-none");
    $(".form-control.profilo").addClass("d-none");
    $("#save-profile-btn").addClass("d-none");
    $("#edit-profile-btn").removeClass("d-none");

    // Nascondi il pulsante "Annulla modifiche"
    $("#cancel-profile-btn").addClass("d-none");
  });

  // Gestisci il click sul pulsante "Salva modifiche"
  $("#save-profile-btn").on("click", function () {

    if (confirm("Vuoi salvare le modifiche?")) {

      $(".editable").removeClass("d-none");
      $(".form-control.profilo").addClass("d-none");
      $("#edit-profile-btn").removeClass("d-none");
      $("#save-profile-btn").addClass("d-none");
      $("#cancel-profile-btn").addClass("d-none");

      // Aggiorna le informazioni nel database tramite una chiamata AJAX
      $.ajax({
        url: "./Modifica/update_profile.php",
        type: "POST",
        data: {
          // passa i dati aggiornati tramite POST
          telefono: $("#phone-input").val(),
        },
        dataType: "json",
        success: function (response) {
          // gestisci la risposta del server
          location.reload();
          console.log(response);
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        },
      });
    }
  });
});

// Controlla il formato del numero di telefono
function validaInputTel() {
  var input = document.getElementById("phone-input");
  var errorMsg = document.getElementById("error-msg");

  //Verifica se il campo di input è stato compilato
  if (input.value) {
    input.setCustomValidity(""); // resetta eventuali errori precedenti

    // Verifica il campo di input sia valido type=tel
    if (!input.checkValidity()) {
      input.setCustomValidity("Formato richiesto: (+XXX) XXXXXXX");
      errorMsg.innerHTML = "Formato richiesto: (+XXX) XXXXXXX";
      input.style.color = "red";
    } else {
      input.setCustomValidity("");
      input.style.color = "";
      errorMsg.innerHTML = "";
    }
  } else {
    input.setCustomValidity("");
    input.style.color = "";
    errorMsg.innerHTML = "";
  }
}

//Controlla l'inserimento della nuova e vecchia password
function confrontaPassword() {
  var nuovaPassword = document.getElementById("nuova-password").value;
  var confermaPassword = document.getElementById("conferma-password").value;
  if (nuovaPassword !== confermaPassword) {
    alert("Le password non corrispondono. Riprovare.");
    return false;
  }
  return true;
}
