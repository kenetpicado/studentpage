//CONFIRMACION DE CAMBIAR ESTADO DEL CURSO
$('.estado').submit(function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Cambiar estado del curso',
    icon: 'warning',
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
    title: 'Elminar',
    text: 'Esta accion no se puede deshacer.',
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