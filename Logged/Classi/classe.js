$(document).ready(function () {
  // Nascondi tutte le sezioni tranne quella iniziale ("Stream")
  $("#compiti-section, #persone-section").hide();

  // Gestisci il click sui bottoni
  $(".nav-link").click(function (event) {
    event.preventDefault();
    // Nascondi tutte le sezioni
    $("#stream-section, #compiti-section, #persone-section").hide();
    // Mostra la sezione corrispondente al bottone selezionato
    $($(this).attr("href")).show();
  });
});

$(document).ready(function () {
  $("#show-form-btn").click(function () {
    $("#annuncio-form").toggleClass("show");
    $(this).fadeOut("600");
  });
  $("#ret-form-btn").click(function () {
    $("#annuncio-form").toggleClass("show");
    $("#show-form-btn").fadeIn("600");
  });
});

function copy() {
  // seleziona l'elemento che contiene il testo da copiare
  const paragrafo = document.querySelector("#codiceCliccabile");

  // copia il testo del paragrafo negli appunti
  navigator.clipboard
    .writeText(paragrafo.textContent.trim())
    .then(() => {
      alert("Testo copiato negli appunti!");
    })
    .catch((error) => {
      console.error("Errore durante la copia del testo negli appunti:", error);
    });
}

function toggleFieldDataOra() {
  var slider = document.getElementById("slider-compito");
  var dataInput = document.getElementById("data_scadenza");
  var oraInput = document.getElementById("orario");

  if (slider.checked) {
    dataInput.setAttribute("required", "");
    oraInput.setAttribute("value", "23:59");
  } else {
    dataInput.removeAttribute("required");
    oraInput.removeAttribute("value");
  }
}

function isIconaNera($icona) {
  return $icona.hasClass("icona-nera");
}

function selezionato($icona) {
    $icona.addClass("fa-bounce");
    setTimeout(function() {
      $icona.removeClass("fa-bounce");
  }, 1000); 
}

$(document).ready(function () {
  // const $campoTesto = $("#testoAnnuncioForm");
  const $iconaGrassetto = $(".icona-grassetto");
  const $iconaitalic = $(".icona-italic");
  const $iconaunderline = $(".icona-underline");

  $iconaGrassetto.on("click", function () {
    selezionato($iconaGrassetto);
  });
$iconaitalic.on("click", function () {
  selezionato($iconaitalic);
});
  $iconaunderline.on("click", function () {
    selezionato($iconaunderline);
  });
  var textarea = document.getElementById("testoAnnuncioForm");

  // Otteniamo il bottone di formattazione
  var boldButton = document.getElementById("icona-grassetto");
  var italicButton = document.getElementById("icona-italic");
  var underlineButton = document.getElementById("icona-underline");

  // Aggiungiamo un gestore di eventi al bottone di formattazione
  boldButton.addEventListener("click", function () {
    const selectionStart = textarea.selectionStart;
    const selectionEnd = textarea.selectionEnd;
    let boldText = "";

    if (selectionStart === selectionEnd) {
      // se non c'è alcun testo selezionato, inserisci i 4 asterischi e posiziona il cursore al centro
      boldText = "****";
      textarea.value =
        textarea.value.substring(0, selectionStart) +
        boldText +
        textarea.value.substring(selectionEnd);
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    } else {
      const selectedText = textarea.value.substring(
        selectionStart,
        selectionEnd
      );
      const boldText = "**" + selectedText + "**";
      const newText =
        textarea.value.substring(0, selectionStart) +
        boldText +
        textarea.value.substring(selectionEnd);
      textarea.value = newText;
      // riposizioniamo il cursore dopo il testo in grassetto
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    }
    textarea.focus();
  });
  italicButton.addEventListener("click", function () {
    const selectionStart = textarea.selectionStart;
    const selectionEnd = textarea.selectionEnd;
    let ialicText = "";

    if (selectionStart === selectionEnd) {
      // se non c'è alcun testo selezionato, inserisci i 4 asterischi e posiziona il cursore al centro
      ialicText = "____";
      textarea.value =
        textarea.value.substring(0, selectionStart) +
        ialicText +
        textarea.value.substring(selectionEnd);
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    } else {
      const selectedText = textarea.value.substring(
        selectionStart,
        selectionEnd
      );
      const ialicText = "__" + selectedText + "__";
      const newText =
        textarea.value.substring(0, selectionStart) +
        ialicText +
        textarea.value.substring(selectionEnd);
      textarea.value = newText;
      // riposizioniamo il cursore dopo il testo
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    }
    textarea.focus();
  });
  underlineButton.addEventListener("click", function () {
    const selectionStart = textarea.selectionStart;
    const selectionEnd = textarea.selectionEnd;
    let underlineText = "";

    if (selectionStart === selectionEnd) {
      // se non c'è alcun testo selezionato, inserisci i 4 asterischi e posiziona il cursore al centro
      underlineText = "~~~~";
      textarea.value =
        textarea.value.substring(0, selectionStart) +
        underlineText +
        textarea.value.substring(selectionEnd);
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    } else {
      const selectedText = textarea.value.substring(
        selectionStart,
        selectionEnd
      );
      const underlineText = "~~" + selectedText + "~~";
      const newText =
        textarea.value.substring(0, selectionStart) +
        underlineText +
        textarea.value.substring(selectionEnd);
      textarea.value = newText;
      // riposizioniamo il cursore dopo il testo
      textarea.selectionStart = selectionStart + 2;
      textarea.selectionEnd = selectionEnd + 2;
    }
    textarea.focus();
  });



  const form = document.querySelector("#annuncio-form");

  form.addEventListener("submit", function (event) {
    const textarea = document.querySelector("#testoAnnuncioForm");
    // const icona = document.getElementsByClassName("icona");
    textarea.style.display = "none";
    // icona.style.display = "none";
    const regexBold = /\*\*([^*]*)\*\*/g; // espressione regolare per cercare testo tra quattro asterischi
    const regexUnderline = /~~([^~]+)~~/g;
    const regexItalic = /__([^_]+)__/g;
    // const regexCross = /--([^>]+)--/g;
    newText = textarea.value.replace(regexBold, "<strong>$1</strong>");
    textarea.value = newText;
    newText = textarea.value.replace(regexUnderline, "<u>$1</u>");
    textarea.value = newText;
    newText = textarea.value.replace(regexItalic, "<em>$1</em>");
    textarea.value = newText;
    // newText = textarea.value.replace(regexCross, "<del>$1</del>");
    // textarea.value = newText;
    newText = textarea.value.replace(/\n/g, "<br>");
    textarea.value = newText;
  });
});



  // Script elimina annuncio
    $(document).ready(function () {
      $(".btn-elimina-annuncio").click(function () {
        if (confirm("Sei sicuro di voler eliminare il post?")) {
          var url = $(this).data("action");
          var titolo = $(this).data("titolo");
          var testo = $(this).data("testo");
          var corso = $(this).data("corso");
          var allegati = $(this).data("allegati");
          
          $.ajax({
            url: url,
            type: 'post',
            data: {
              elimina_annuncio: true,
              testo: testo, corso: corso, titolo: titolo, allegati: allegati
            },
            dataType: 'json',
            success: function (data) {
              if (data.success) {
                alert("Annuncio eliminato correttamente.");
                location.reload(); // Ricarica la pagina
              } else {
                console.log(data.message);
                alert("Errore durante l\'eliminazione dell\' annuncio.");
              }
            },
            error: function (jqXHR, status, error) {
              console.log(status + ": " + error);
              alert("Errore durante l\'eliminazione dell\' annuncio.");
            }
          });
        }
      });
    });

    // Script inserisci commento
     $(document).ready(function () {
      $(".input-group input[type='text']").on("input", function() { // Aggiunge un listener all'evento "input" dell'input text
            var input = $(this);
            var btn = input.siblings("button");
            if (input.val().trim() === "") { // Controlla se l'input è vuoto o contiene solo spazi
                btn.prop("disabled", true); // Disabilita il bottone se l'input è vuoto
                btn.removeClass("btn-attivo");
            } else {
                btn.prop("disabled", false); // Abilita il bottone se l'input non è vuoto
                btn.addClass("btn-attivo");
            }
        });
      
      $(".btn-inserisci-commento").click(function () {
       
        var id_post = $(this).data("id"); 
        var url = $(this).data("action");
        var descrizione = $("#descrizione-commento"+id_post).val();
        var titolo = $(this).data("titolo");
        var pubblicazione = $(this).data("pubblicazione");
        var email = $(this).data("email");

        $.ajax({
          url: url,
          type: 'post',
          data: {
            inserisci_commento: true,
            pubblicazione: pubblicazione, email: email, titolo: titolo, descrizione: descrizione
          },
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              location.reload(); // Ricarica la pagina
            } else {
              console.log(data.message);
              alert("Errore durante l\'inserimento del commento.");
            }
          },
          error: function (jqXHR, status, error) {
            console.log(status + ": " + error);
            alert("Errore durante l\'inserimento del commento.");
          }
        });
      });
    });
    
    