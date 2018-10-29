function listar_clientes() {
  $('#radios').hide();
  $("#intro").fadeOut();
  $("#intro2").fadeOut();
  $("#intro3").fadeOut();

  var tabla = document.getElementById("tablita2");
  var botoncito = document.getElementById("btn_nuevo_cliente");
      if(tabla)
      {
        Materialize.toast('Actualizando tabla clientes', 4000);
        tabla.parentNode.removeChild(tabla);
        botoncito.parentNode.removeChild(botoncito); 

      }
      else
      {
        Materialize.toast('Se creara la tabla clientes por primera vez', 4000);
      }

	var myTable="";
  if (cont_timer2==0) 
  {
    myTable+="<div class='animated fadeInDown'><table id='tablita2' class='centered bordered highlight'>";
  }
  else
  {
    myTable+="<div><table id='tablita2' style='cursor:pointer' class='centered bordered'>";
  }
  myTable+="<thead><tr style:'border:solid black'><th>Nombre</th><th>Telefono</th><th>Zona</th><th>Localidad</th><th>Provincia</th><th>Tareas</th></tr></thead><tbody>";
    
    
    
  $.ajax({
    data: {},
    type: "GET",
    dataType: "json",
    url: "../controladores/listar_clientes.php",
})
 .done(function( data, textStatus, jqXHR ) {
     if ( console && console.log )
     {
             console.log( "La solicitud se ha completado correctamente." );
             var clientes = data;


            for (var i=0; i<clientes.length; i++)
            {
                myTable+="<tr>";  
                myTable+="<td><p>"+clientes[i].nombre+"</p></td>";
                myTable+="<td><p>"+clientes[i].tel+"</p></td>";
                myTable+="<td><p>"+clientes[i].zona+"</p></td>";
                myTable+="<td><p>"+clientes[i].localidad+"</p></td>";
                myTable+="<td><p>"+clientes[i].provincia+"</p></td>";
                myTable+="<td><p>"+clientes[i].Cant+"</p></td>";
                myTable+="</tr>";                  
            }//FIN DEL FOR 

            myTable+="</tbody></table></div>";

              $("#cuerpo").html(myTable);
             
              var boton = "<a id='btn_nuevo_cliente' class='btn-floating btn-large waves-effect waves-light black'><i class='material-icons'>add</i></a>";

              $("#panel_izquierdo").html(boton);

              cont_timer2=cont_timer2+1;
         
               function abrir_modal_cliente(){
                       
       
}

document.getElementById("btn_nuevo_cliente").addEventListener("click", abrir_modal_cliente);        
     
     }
 })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
});
    
}