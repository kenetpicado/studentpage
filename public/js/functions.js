
//CONFIRMACION PARA ELIMINAR DATO
$('.eliminar').submit(function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Elminar elemento',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  })
})

tipo.addEventListener("change", function () {
  if (tipo.value == "1") {
    document.getElementById("concepto").disabled = true;
  } else {
    document.getElementById("concepto").disabled = false;
  }
});

if (tipo.value == "1") {
  document.getElementById("concepto").disabled = true;
} else {
  document.getElementById("concepto").disabled = false;
}

