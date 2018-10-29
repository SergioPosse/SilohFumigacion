function listar_empleados() {
$('#radios').hide();
  $("#intro").fadeOut();
  $("#intro2").fadeOut();
  $("#intro3").fadeOut();

  var tabla = document.getElementById("tablita3");
  var botoncito = document.getElementById("btn_nuevo_empleado");
      if(tabla)
      {
        Materialize.toast('Actualizando tabla empleados', 4000);
        tabla.parentNode.removeChild(tabla);
        botoncito.parentNode.removeChild(botoncito);
      }
      else
      {
        Materialize.toast('Se creara la tabla empleados por primera vez', 4000);
      }

	var myTable="";
  if (cont_timer3==0)
  {
    myTable+="<div class='animated fadeInDown'><table id='tablita3' class='centered bordered highlight'>";
  }
  else
  {
    myTable+="<div><table id='tablita3' style='cursor:pointer' class='centered bordered'>";
  }
  myTable+="<thead><tr style:'border:solid black'><th>Nombre</th><th>Telefono</th><th>Tareas que realizo</th></tr></thead><tbody>";
    
    
    
  $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    // URL a la que se enviará la solicitud Ajax
    url: "../controladores/listar_empleados.php",
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
                myTable+="<td><p>"+clientes[i].cant+"</p></td>";
                myTable+="</tr>";                  
            }//FIN DEL FOR 

            myTable+="</tbody></table></div>";

              $("#cuerpo").html(myTable);
             
              var boton = "<a id='btn_nuevo_empleado' class='btn-floating btn-large waves-effect waves-light black'><i class='material-icons'>add</i></a>";

              $("#panel_izquierdo").html(boton);

              cont_timer3=cont_timer+1;   
     }
 })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
});
    
}