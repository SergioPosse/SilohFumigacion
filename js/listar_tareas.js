function clic() {
  $("#intro").fadeOut();
  $("#intro2").fadeOut();
  $("#intro3").fadeOut();
  //CONTROLO SI HAY UNA TABLA EN USO YA EN EL document
  //SI HAY UNA LA ELIMINO DEL DOM ASI AGREGO LA NUEVA ACTUALIZADA CON EL NUEVO ARRAY
  //TENGO QUE AGREGAR LA TABLA AL DOM CON APPENDCHILD PARA QUE ME LA RECONOZCA LUEGO AL HACER
  //CLICK EN CADA FILA
  var tabla = document.getElementById("tablita");
      if(tabla)
      {// si existe la tabla entonces la borro para apendd la nueva
        Materialize.toast('Actualizando tabla', 4000);

      }
      else
      {
        Materialize.toast('Se creara la tabla por primera vez', 4000);
      }

	var myTable="";
  if (cont_timer==0) //uso de nuevo el contador del clic para que si es el primer clic haga fade a la tabla
  //con la clase "animated fade"
  {
    myTable+="<div class='animated fadeInDown'><table id='tablita' class='centered bordered highlight'>";
  }
  else
  {
    myTable+="<div><table id='tablita' style='cursor:pointer' class='centered bordered'>";
  }
  myTable+="<thead><tr style:'border:solid black'><th>Tipo</th><th>Plaga</th><th>Cliente</th><th>Empleado</th><th>Importe(ultimo)</th><th>Hace..</th><th></th></tr></thead><tbody>";
    
    
    
  $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    // URL a la que se enviará la solicitud Ajax
    url: "../controladores/getTareas.php",
})
 .done(function( data, textStatus, jqXHR ) {
     if ( console && console.log ) {
         console.log( "La solicitud se ha completado correctamente." );
         var tareas = data;  
         var selectedIndex = $('input[name=group1]:checked').index('input[name=group1]');
             
        selectedIndex=parseInt(selectedIndex);
            if(selectedIndex===0)
            {
                Materialize.toast("Mostrando Todas Las Tareas", 4000); 
            }
            else
            {
                if(selectedIndex===1)
                {
                  Materialize.toast("Mostrando Tareas Reactivables", 4000);
                }
                else
                {
                    if(selectedIndex===2)
                    {
                     Materialize.toast("Mostrando Tareas Nuevas", 4000);
                    }
                    else
                    {
                        if(selectedIndex===3)
                        {
                         Materialize.toast("Mostrando Tareas Terminadas", 4000);
                        }
                    }
                }    
            }       
         
         
         
         
         
         for (var i=0; i<tareas.length; i++) {

    //primero controlo que si la tarea no se termino y pasaron mas de 60 segundos
    //entonces es una tarea urgente precaucion y se colorea amarillo
    //si la tarea es menor a 60 y verde osea finalizada no cambia nada
    //si la tarea es menor a 60 y sin color es nueva y no cambia nada
    //este condicional solo sirve para colorear amarilla una fila
    //porque para colorearla verde uso la funcion ondblClick que se repite en estos 3 condicionales igual
    //cuando hago doble click a la fila me ejecuta una funcion que le cambia el valor al indice de ese ARRAY
    //por false o true, es una llave selectora entre esos dos valores
    //asi se puede finalizar una tarea con dobleclick y con otro dobleclick dar de alta de nuevo

    //var d = new Date();//uso de moment para la hora en segundos
    //var n = d.toLocaleTimeString();
    //var hora2 = moment(n, "HH:mm:ss");
    //var hora1 = moment(tareas[i].fec_inicio, "HH:mm:ss");
    //var diff = hora2.diff(hora1, 's'); // diferencia en segundos usando moment

    //SI LA TAREA ES NORMAL Y ADEMAS PASARON 60 SEGUNDOS ENTONCES SE LE ASIGNA "P" AL ARRAY
    //DE LO CONTRARIO SI ESTA VERDE QUEDA VERDE SI ESTA SELECCIONADA QUEDA SELECCIONADA.
    //if((diff>60)&&(tareas[i].estado==1)){
       // tareas[i][5]='P';
    //}
                       
          if(selectedIndex===0){
    
                  if(parseInt(tareas[i].estado)===3)
                  {//DEFINO POR CADA FILA EL EVENTO CLICK, THIS PASA COMO PARAMETRO osea la misma row asi puedo usar rowindex en la funcion
                 // alert("3");

myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' style='background-color:#ffff66' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";

                  }
                  else
                  {
                    if(parseInt(tareas[i].estado)===2)  
                    {
                       //  alert("2");
                      myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' style='background-color:#82FA58' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";
                    }
                    else
                    {
                      if(parseInt(tareas[i].estado)===1)
                      {
                         //  alert("1");

                        myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";
                      }
                    }
                   }
              
          }
          else
          {
            if(selectedIndex===1)
             {
              
                 
                 if(parseInt(tareas[i].estado)===3)
                      {
                        

                        myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' style='background-color:#ffff66' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";
                      }
                 else {continue;}
                
            }
            else
            {
                if(selectedIndex===2)
                {
                    
                    
                    if(parseInt(tareas[i].estado)===1)  
                    {
                       //  alert("2");
                      myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";
                    }else {continue;}
                    
                }
                else{
                    if(selectedIndex===3)
                    {
                        
                      if(parseInt(tareas[i].estado)===2)
                          {
                            myTable+="<tr data-cli='"+tareas[i].cli_id+"' data-emp='"+tareas[i].emp_id+"' data-tar='"+tareas[i].tipTar_id+"' data-pla='"+tareas[i].tipPla_id+"' data-id='"+tareas[i].id+"' data-importe='"+tareas[i].importe+"' style='background-color:#82FA58' ondblClick='estado_tarea(this)' onclick='select_tarea(this)'>";
                          } else {continue;} 
                    }
                }
            }
              
          }
             
                
          
             
             
 
      
    var fecha_inicio = moment(tareas[i].fecha_inicio).format('YYYY-MM-DD');
    var hoy = moment(new Date()).format('YYYY-MM-DD');
   
    var aFecha1 = hoy.split('-'); 
    var aFecha2 = fecha_inicio.split('-'); 
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
    var dif = fFecha1 - fFecha2;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));//alert(fecha_inicio);
    
     
    if(tareas[i].tipo==null){
        myTable+="<td><p>Vacio</p></td>";
    }else{
        myTable+="<td><p>"+tareas[i].tipo+"</p></td>"; 
    }
             if(tareas[i].plaga==null){
        myTable+="<td><p>Vacio</p></td>";
    }else{
        myTable+="<td><p>"+tareas[i].plaga+"</p></td>"; 
    }
             if(tareas[i].cliente==null){
        myTable+="<td><p>Vacio</p></td>";
    }else{
        myTable+="<td><p>"+tareas[i].cliente+"</p></td>"; 
    }
             if(tareas[i].empleado==null){
        myTable+="<td><p>Vacio</p></td>";
    }else{
        myTable+="<td><p>"+tareas[i].empleado+"</p></td>"; 
    }
             
             
             
    myTable+="<td><p>$ "+tareas[i].importe+"</p></td>";
    myTable+="<td><p>"+dias+" dia(s)</p></td>";
             
      
             
     
    if(admin==1){//si es admin entonces puede eliminar tareas logicamente y cargarle insumos
        myTable+="<td><a data-id='"+tareas[i].id+"' onclick='eliminar_tarea(this)' href='#modal1_eliminar_tarea' class='btn-floating waves-effect waves-light black'><i class='material-icons'>cancel</i></a></td>";
        
        if(parseInt(tareas[i].estado)===2)
        {
           myTable+="<td>   </td>";
            myTable+="<td>   </td>";
        }
        else
        {
               //si la tarea nunca asocio un insumo entonces le agrego la clase pulse de materialize al boton
            if(tareas[i].insumo_cargado==null)
            {
                myTable+="<td><a data-id='"+tareas[i].id+"' onclick='agregar_insumo(this)' href='#modal_agregar_insumo' class='btn-floating waves-effect waves-light black pulse'><i class='material-icons'>add_box</i></a></td>";
            }
            else
            {
                myTable+="<td><a data-id='"+tareas[i].id+"' onclick='agregar_insumo(this)' href='#modal_agregar_insumo' class='btn-floating waves-effect waves-light black'><i class='material-icons'>add_box</i></a></td>";
            } 
            myTable+="<td><a data-id='"+tareas[i].id+"' onclick='detalle_tarea(this)' class='btn-floating waves-effect waves-light black'><i class='material-icons'>edit</i></a></td>";
            myTable+="</tr>";
            
        }  
        
    }
    else
    {
        if((parseInt(tareas[i].estado)===3) || (parseInt(tareas[i].estado)===1))
        {
            myTable+="<td><a data-id='"+tareas[i].id+"' onclick='detalle_tarea(this)' class='btn-floating waves-effect waves-light black'><i class='material-icons'>search</i></a></td>";
            myTable+="</tr>";
        }
        else
        {
            myTable+="<td>   </td>";
        }
   
        
    }
             
            
              
             
             
             
    
 
    
      
  }//FIN DEL FOR 

  myTable+="</tbody></table></div>";

   $("#cuerpo").html(myTable);

  var boton = "<a id='btn_nueva_tarea' class='btn-floating btn-large waves-effect waves-light black'><i class='material-icons'>add</i></a>";
         

         
         
         
         
         
  $('#radios').show();
   $("#panel_izquierdo").html(boton);

  cont_timer=cont_timer+1;
         
   function abrir_modal_tarea(){
    
    cargar_clientes();
    cargar_tipos();
    cargar_empleados();
    cargar_plagas();
    $('.modal-content #importe_tarea').val("");
    $('.modal-content #descripcion_tarea').val("");
    $('#modal1_cargar_tarea').modal('open');
                       
       
}


document.getElementById("btn_nueva_tarea").addEventListener("click", abrir_modal_tarea);

        
            
     
     }
 })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
});
    
    
    
  
    
}
