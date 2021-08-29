window.addEventListener('load', function() {

  var valname = [];
  var validnumber = [];
  var valpercentage = [];
  var valposition = [];
  var valbirthdate = [];  
  var arrtemp = [];

  document.getElementById("percentage").addEventListener("keypress", validNumber);

  function validNumber(event){
    var key = event.which || event.keyCode,
        value = event.target.value,
        n = value+String.fromCharCode(key);
    if ( isNaN(n) || n<1 || n>100)
      event.preventDefault();    
  }

  function regexValidarFecha() {
    let sep              = "[-]",
    
        dia1a28          = "(0?[1-9]|1\\d|2[0-8])",
        dia29            = "(29)",
        dia29o30         = "(29|30)",
        dia31            = "(31)",
        
        mes1a12          = "(0?[1-9]|1[0-2])",
        mes2             = "(0?2)",
        mesNoFeb         = "(0?[13-9]|1[0-2])",
        mes31dias        = "(0?[13578]|1[02])",
        
        diames29Feb      = mes2+sep+dia29,
        diames1a28       = mes1a12+sep+dia1a28,
        diames29o30noFeb = mesNoFeb+sep+dia29o30,
        diames31         = mes31dias+sep+dia31,
        diamesNo29Feb    = "(?:"+diames1a28+"|"+diames29o30noFeb+"|"+diames31+")",
        
        anno1a9999     = "(0{2,3}[1-9]|0{1,2}[1-9]\\d|0?[1-9]\\d{2}|[1-9]\\d{3})",
        annoMult4no100   = "\\d{1,2}(?:0[48]|[2468][048]|[13579][26])",
        annoMult400      = "(?:0?[48]|[13579][26]|[2468][048])00",
        annoBisiesto     = "("+annoMult4no100+"|"+annoMult400+")",
        
        fechaNo29Feb     = anno1a9999+sep+diamesNo29Feb,
        fecha29Feb       = annoBisiesto+sep+diames29Feb,
        
        fechaFinal       = "^(?:"+fechaNo29Feb+"|"+fecha29Feb+")$";
    
    return new RegExp(fechaFinal);
  } 

  //Valida una fecha ingresada como "aaaa-mm-dd"
  // - Si no es válida, devuelve false
  // - Si es válida, devuelve un objeto {d:"día",m:"mes",a:"año",date:date}
  // - Parámetro: UTC (opcional) si se debe devolver {date:(date)} en UTC
  //
  function validarFecha(texto, UTC = false) {
    let fechaValida = regexValidarFecha(),
        // fechaValida = /^(?:(?:(0?[1-9]|1\d|2[0-8])[/](0?[1-9]|1[0-2])|(29|30)[/](0?[13-9]|1[0-2])|(31)[/](0?[13578]|1[02]))[/](0{2,3}[1-9]|0{1,2}[1-9]\d|0?[1-9]\d{2}|[1-9]\d{3})|(29)[/](0?2)[/](\d{1,2}(?:0[48]|[2468][048]|[13579][26])|(?:0?[48]|[13579][26]|[2468][048])00))$/,
        grupos;
        
    if (grupos = fechaValida.exec(texto)) {
        //Unir día mes y año desde los grupos que pueden haber coincidido
        let d = [grupos[1],grupos[3],grupos[5],grupos[8]].join(''),
            m = [grupos[2],grupos[4],grupos[6],grupos[9]].join(''),
            a = [grupos[7],grupos[10]].join(''),
            date = new Date(0);

        //Obtener la fecha en formato local o UTC
        if (UTC) {
            date.setUTCHours(0);
            date.setUTCFullYear(a,parseInt(m,10) - 1,d);
        } else {
            date.setHours(0);
            date.setFullYear(a,parseInt(m,10) - 1,d);
        }
        
        //Devolver como objeto con cada número por separado
        return {
            d: d,
            m: m,
            a: a,
            date: date
        };
    }
    return false; //No es fecha válida
  }

  function eliminarFila(rowCount){    
    var indarr = rowCount - 2;
    var table = document.getElementById("tblowner");
    //var rowCount = table.rows.length;        
    if(rowCount <= 1)
      //alert('No se puede eliminar el encabezado');
      return false;
    else{
      
      //quitar elemento del hidden
      //si ya no tiene elementos los hiddens ocultar boton de save
      table.deleteRow(rowCount -1);

      if (arrtemp.length > 0){
        arrtemp.forEach(function(elemento, indice, array){
          console.log(indice +" - "+indarr);
          if (indice == indarr){
            arrtemp.splice(indice,1);
          }          
        });
      }

      if (arrtemp.length <= 0){
        $("#nro").val(1);
        $("#btn_save").attr("style","display:none;");       
      }
      
    }
  }

  
  function agregarFila(values){
    var nro = $("#nro").val();
    nro = parseInt(nro) + 1;
    var tabla = document.getElementById("tblowner");
    
    var nuevafila= tabla.insertRow(-1);
    nuevafila.innerHTML = '<td>'+values[0]+'</td><td>'+values[1]+'</td><td>'+values[2]+'</td><td>'+values[3]+'</td><td>'+values[4]+'</td>';
    
    var enlace = document.createElement("a");
    enlace.setAttribute("style","cursor:pointer;");
    enlace.setAttribute("id",nro);
    enlace.innerHTML = "<i class='fa fa-trash-o'></i>";
    enlace.addEventListener("click",function(e){eliminarFila(nro);});
    
    var columna = document.createElement("td");
    columna.setAttribute("align","center");
    
    columna.appendChild(enlace);
    nuevafila.appendChild(columna);
    tabla.appendChild(nuevafila);
 
    arrtemp[nro-2] = values;
    //document.getElementById("tblowner").insertRow(-1).innerHTML = '<td>'+values[0]+'</td><td>'+values[1]+'</td><td>'+values[2]+'</td><td>'+values[3]+'</td><td>'+values[4]+'</td><td align="center"><a class="linkdelete" id="'+nro+'" style="cursor:pointer;"><i class="fa fa-trash-o"></i></a></td>';
    $("#nro").val(nro);
  }
  
  $("#btn_add").click(function(){
    var msg = [];
    var ids = [];

    $("#name").attr("class","form-control");
    $("#idnumber").attr("class","form-control");
    $("#percentage").attr("class","form-control");
    $("#position").attr("class","form-control");
    $("#birthdate").attr("class","form-control");
    $("#msg_name").attr("style","display:none;");
    $("#msg_idnumber").attr("style","display:none;");
    $("#msg_percentage").attr("style","display:none;");
    $("#msg_position").attr("style","display:none;");
    $("#msg_birthdate").attr("style","display:none;");
    $("#msg_name").html("");
    $("#msg_idnumber").html("");
    $("#msg_percentage").html("");
    $("#msg_position").html("");
    $("#msg_birthdate").html("");

    if ($("#name").val() == ""){
      msg.push("The name is required");
      ids.push("name");
    }
    if ($("#idnumber").val() == ""){
      msg.push("The id number is required");
      ids.push("idnumber");
    }
    if ($("#percentage").val() == ""){
      msg.push("The percentage is required");
      ids.push("percentage");
    }
    if ($("#percentage").val() < 25){
      msg.push("The percentage must be greater than 25%");
      ids.push("percentage");
    }
    if ($("#percentage").val() > 100){
      msg.push("The percentage must be less than 100%");
      ids.push("percentage");
    }
    if ($("#position").val() == ""){
      msg.push("The position is required");
      ids.push("position");
    }
    if ($("#birthdate").val() == ""){
      msg.push("The birthdate is required");      
      ids.push("birthdate");
    }
    var resultado = validarFecha($("#birthdate").val());
    if (resultado == false){
      msg.push("The birthdate is not in the correct format");       
      ids.push("birthday");
    }    
    if (msg.length > 0){      
      msg.forEach(function(elemento, indice, array){        
        $("#"+ids[indice]).attr("class","form-control is-invalid");  
        $("#msg_"+ids[indice]).attr("style","display:block;");                   
        $("#msg_"+ids[indice]).html(msg[indice]);
      });
    }
    else{
      var values = [];      
      values.push($("#name").val());
      values.push($("#idnumber").val());
      values.push($("#percentage").val());
      values.push($("#position").val());
      values.push($("#birthdate").val());
      
      agregarFila(values); 
      
      /*valname.push($("#name").val());
      validnumber.push($("#idnumber").val());
      valpercentage.push($("#percentage").val());
      valposition.push($("#position").val());
      valbirthdate.push($("#birthdate").val());

      $('input[name="hdnname[]"]').val(JSON.stringify(valname));      
      $('input[name="hdnidno[]"]').val(JSON.stringify(validnumber));      
      $('input[name="hdnpercentage[]"]').val(JSON.stringify(valpercentage));      
      $('input[name="hdnposition[]"]').val(JSON.stringify(valposition));      
      $('input[name="hdnbirthdate[]"]').val(JSON.stringify(valbirthdate));*/      

      $("#name").val("");
      $("#idnumber").val("");
      $("#percentage").val("");
      $("#position").val("");
      $("#birthdate").val("");

      if (arrtemp.length > 0){
        $("#btn_save").attr("style","display:block;");
      }
      
    } 
  });

  $("#btn_save").click(function(){
    if (arrtemp.length > 0){
      arrtemp.forEach(function(elemento, indice, array){        
        $('input[name="hdnname[]"]').val(JSON.stringify(elemento[0]));      
        $('input[name="hdnidno[]"]').val(JSON.stringify(elemento[1]));      
        $('input[name="hdnpercentage[]"]').val(JSON.stringify(elemento[2]));      
        $('input[name="hdnposition[]"]').val(JSON.stringify(elemento[3]));      
        $('input[name="hdnbirthdate[]"]').val(JSON.stringify(elemento[4]));
      });
      $("#frm_createownership").submit();
    }
  }

})   