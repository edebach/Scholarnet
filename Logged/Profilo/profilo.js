$(document).ready(function () {
  var passwordModal = new bootstrap.Modal(
    document.getElementById("password-modal")
  );
  $("#edit-password-btn").click(function () {
    passwordModal.show();
  });
});
$(document).ready(function () {
  // Gestisci il clic sul pulsante "Modifica profilo"
  $("#edit-profile-btn").on("click", function () {
    $(".editable").addClass("d-none");
    $(".form-control.profilo").removeClass("d-none");
    $("#edit-profile-btn").addClass("d-none");
    $("#save-profile-btn").removeClass("d-none");
    $("#cancel-profile-btn").removeClass("d-none");
  });
  $("#cancel-profile-btn").on("click", function () {
    // Ripristina i valori precedenti di email e telefono
    // $("#email-input").val($("#email").text());
    $("#phone-input").val($("#phone").text());
    // Nascondi il pulsante "Salva modifiche" e mostra il pulsante "Modifica profilo"
    $(".editable").removeClass("d-none");
    $(".form-control.profilo").addClass("d-none");
    $("#save-profile-btn").addClass("d-none");
    $("#edit-profile-btn").removeClass("d-none");
    // Nascondi il pulsante "Annulla modifiche"
    $("#cancel-profile-btn").addClass("d-none");
  });

  // Gestisci il clic sul pulsante "Salva modifiche"
  $("#save-profile-btn").on("click", function () {
    if (confirm("vuoi salvare le modifiche?")) {
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
          // email: $('#email-input').val(),
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
    function validaInputTel() {
      var input = document.getElementById("phone-input");
      var errorMsg = document.getElementById("error-msg");

      if (input.value) {
        input.setCustomValidity(""); // resetta eventuali errori precedenti

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
        function confrontaPassword() {
          var nuovaPassword = document.getElementById("nuova-password").value;
          var confermaPassword =
            document.getElementById("conferma-password").value;
          if (nuovaPassword !== confermaPassword) {
            alert("Le password non corrispondono. Riprovare.");
            return false;
          }
          return true;
        }