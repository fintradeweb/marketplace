window.addEventListener('load', function() {
  
  function isValidURL(url){
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if(RegExp.test(url)){
      return true;
    }else{
      return false;
    }
  }

  $("#btn_save").click(function(){ 
    var msg = "";
    /*if ($("#name").val() == ""){
      msg = "The name is required"; 
    }
    if ($("#email").val() == ""){
      msg = "The email address is required"; 
    } 
    //if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
    //  msg = "The email address entered is not correct";      
    //}
    if ($("#ruc_tax").val() == ""){
      msg = "The tax id is required"; 
    }
    if ($("#date_company").val() == ""){
      msg = "The date company was stablished is required"; 
    }
    if ($("#contact_name").val() == ""){
      msg = "The contact name is required"; 
    }
    if ($("#president_name").val() == ""){
      msg = "The president name is required"; 
    }
    if ($("#type_bussiness").val() == ""){
      msg = "The type of business is required"; 
    }
    if ($("#phone").val() == ""){
      msg = "The phone is required"; 
    }
    if ($("#country_id").val() == ""){
      msg = "The country is required"; 
    }
    if ($("#city_id").val() == ""){
      msg = "The city is required"; 
    }
    if ($("#state_id").val() == ""){
      msg = "The state is required"; 
    }
    if ($("#zip").val() == ""){
      msg = "The zip code is required"; 
    }
    if ($("#address").val() == ""){
      msg = "The address is required"; 
    }      
    if ($("#website").val() != ""){
      if(isValidURL($("#txt_website").val()) == false){
        msg = "The url website entered is not correct";
      }
    } 
    if (msg != ""){
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: msg
      });
    }
    else{
      $("#frm_createinformation").submit();
    } */
  });

  $("#btn_edit").click(function(){ 
    /*var msg = "";
    if ($("#id").val() == ""){
      msg = "The fields are wrong"; 
    }
    if ($("#name").val() == ""){
      msg = "The name is required"; 
    }
    if ($("#email").val() == ""){
      msg = "The email address is required"; 
    } 
    if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
      msg = "The email address entered is not correct";      
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
    if ($("#website").val() != ""){
      if(isValidURL($("#website").val()) == false){
        msg = "The url website entered is not correct";
      }
    } 
    if (msg != ""){
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: msg
      });
    }
    else{
      $("#frm_editinformation").submit();
    }*/    
  });

})   