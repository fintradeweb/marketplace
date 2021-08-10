window.addEventListener('load', function() {
  
  $("#btn_save").click(function(){ 
    var msg = "";
    if ($("#name").val() == ""){
      msg = "The name is required"; 
    }
    if ($("#email").val() == ""){
      msg = "The email is required"; 
    } 
    if ($("#taxid").val() == ""){
      msg = "The tax id is required"; 
    }
    if ($("#datecompany").val() == ""){
      msg = "The date company was stablished is required"; 
    }
    if ($("#contactname").val() == ""){
      msg = "The contact name is required"; 
    }
    if ($("#president").val() == ""){
      msg = "The president name is required"; 
    }
    if ($("#typebussiness").val() == ""){
      msg = "The type of business is required"; 
    }
    if ($("#phone").val() == ""){
      msg = "The phone is required"; 
    }
    if ($("#country").val() == ""){
      msg = "The country is required"; 
    }
    if ($("#city").val() == ""){
      msg = "The city is required"; 
    }
    if ($("#state").val() == ""){
      msg = "The state is required"; 
    }
    if ($("#zipcode").val() == ""){
      msg = "The zip code is required"; 
    }
    if ($("#address").val() == ""){
      msg = "The address is required"; 
    }
    if ($("#phone").val() == ""){
      msg = "The phone is required"; 
    }    
    if (msg != ""){
      alert(msg);
    }
    else{
      console.log("submit");
    }    
  });
})   