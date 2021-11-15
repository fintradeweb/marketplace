window.addEventListener('load', function() {
  $("#status").click(function(){    
    if ($(this).prop("checked") == true){
      $(this).attr("value",1);     
    }
    else{
      $(this).attr("value",0);      
    }
  }); 

  $("#rol_id").change(function(){    
  	if($(this).val() == 2){
  		$("#divcompany").attr("style","display:block");
  	}
  	else{
  	  $("#divcompany").attr("style","display:none");	
  	}
  });    
}) 