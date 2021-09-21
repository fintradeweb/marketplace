window.addEventListener('load', function() {
  $("#status").click(function(){    
    if ($(this).prop("checked") == true){
      $(this).attr("value",1);     
    }
    else{
      $(this).attr("value",0);      
    }
  });    
}) 