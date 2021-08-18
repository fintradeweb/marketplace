window.addEventListener('load', function() {

  document.getElementById("percentage").addEventListener("keypress", validNumber);

  function validNumber(event){
    var key = event.which || event.keyCode,
        value = event.target.value,
        n = value+String.fromCharCode(key);
    if ( isNaN(n) || n<1 || n>100)
      event.preventDefault();    
  }

  $("#btn_save").click(function(){
    var msg = "";
    if ($("#name").val() == ""){
      msg = "The name is required"; 
    }
    if ($("#idnumber").val() == ""){
      msg = "The id number is required"; 
    }
    if ($("#percentage").val() == ""){
      msg = "The percentage is required"; 
    }
    if ($("#percentage").val() < 25){
      msg = "The percentage must be greater than 25%"; 
    }
    if ($("#percentage").val() > 100){
      msg = "The percentage must be less than 100%"; 
    }
    if ($("#position").val() == ""){
      msg = "The position is required"; 
    }
    if (msg != ""){
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: msg
      });
    }
    else{
      console.log("paso");
    } 
  });

})   