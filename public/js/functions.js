//CONFIRMACION DE CAMBIAR ESTADO DEL CURSO
$('.estado').submit(function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Cambiar estado del curso',
    icon: 'warning',
    text: 'Esta acción cambiará el estado del curso a Inactivo',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Cambiar'
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  })
})

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
