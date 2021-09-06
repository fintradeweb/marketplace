window.addEventListener('load', function() {



  document.getElementById("avg_montky_sales").addEventListener("keypress", validNumber);
  document.getElementById("ams_how_clients").addEventListener("keypress", validNumber);
  document.getElementById("estimated_montly_financing").addEventListener("keypress", validNumber);
  document.getElementById("emf_number_clients").addEventListener("keypress", validNumber);
  document.getElementById("rf_when_with_whom").addEventListener("keypress", validNumber);
  document.getElementById("cip_when_with_whom").addEventListener("keypress", validNumber);


  function validNumber(event){
    var key = event.which || event.keyCode,
        value = event.target.value,
        n = value+String.fromCharCode(key);
    if ( isNaN(n))
      event.preventDefault();
  }


})
