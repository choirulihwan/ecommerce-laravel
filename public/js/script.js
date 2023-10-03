"use strict";

function NumericInput(inp, locale) {
  var numericKeys = "0123456789";
  

  // restricts input to numeric keys 0-9
  inp.addEventListener("keypress", function (e) {
    var event = e || window.event;
    var target = event.target;

    if (event.charCode == 0) {
      return;
    }

    if (-1 == numericKeys.indexOf(event.key)) {
      // Could notify the user that 0-9 is only acceptable input.
      event.preventDefault();
      return;
    }
  });

  // add the thousands separator when the user blurs
  inp.addEventListener("blur", function (e) {
    var event = e || window.event;
    var target = event.target;
    
    // var tmp = target.value.replace(/,/g, "");    
    var tmp = target.value.replace(/[^-,\d]/g, '');
    var val = Number(tmp).toLocaleString(locale);
    
    if (tmp == "") {
      target.value = "";
    } else {
      target.value = val;
    }
  });

  // strip the thousands separator when the user puts the input in focus.
  inp.addEventListener("focus", function (e) {
    var event = e || window.event;
    var target = event.target;
    var val = target.value.replace(/[,.]/g, "");

    target.value = val;
  });
}