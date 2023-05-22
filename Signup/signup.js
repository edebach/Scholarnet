function validaForm() {
  const today = new Date();
  const inputDate = document.getElementById("data");
  const selectedDate = new Date(inputDate.value);
  console.log(today);
  console.log(selectedDate);
  if (selectedDate > today) {
    alert('Inserisci una data precedente a oggi');
    return false;
  }
  return true;
}
