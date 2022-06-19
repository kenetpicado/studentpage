
jQuery(window).on("load", function() {
  $('#preloader').fadeOut(500);
  $('#wrapper').addClass('show');
});

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

