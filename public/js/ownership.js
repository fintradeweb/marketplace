window.addEventListener('load', function() {

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