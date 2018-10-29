function listar_recaudado() {
$('#radios').hide();
  $("#intro").fadeOut();
  $("#intro2").fadeOut();
  $("#intro3").fadeOut();

  var tabla = document.getElementById("tablita4");
      if(tabla)
      {
        Materialize.toast('Actualizando tabla recaudos', 4000);
        tabla.parentNode.removeChild(tabla);
        botoncito.parentNode.removeChild(botoncito);
      }
      else
      {
        Materialize.toast('Se creara la tabla recaudos por primera vez', 4000);
      }

	var myTable="";
  if (cont_timer4==0)
  {
    myTable+="<div class='animated fadeInDown'><table id='tablita4' class='centered bordered highlight'>";
  }
  else
  {
    myTable+="<div><table id='tablita4' style='cursor:pointer' class='centered bordered'>";
  }
  myTable+="<thead><tr style:'border:solid black'><th>Cliente</th><th>Empleado</th><th>Tarea</th><th>Plaga</th><th>Importe</th><th>Fecha</th></tr></thead><tbody>";
    
    
    
  $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    // URL a la que se enviará la solicitud Ajax
    url: "../controladores/listar_recaudado.php",
})
 .done(function( data, textStatus, jqXHR ) {
     if ( console && console.log )
     {
             console.log( "La solicitud se ha completado correctamente." );
             var rec = data;


            for (var i=0; i<rec.length; i++)
            {
                myTable+="<tr>";  
                myTable+="<td><p>"+rec[i].cliente+"</p></td>";
                myTable+="<td><p>"+rec[i].empleado+"</p></td>";
                myTable+="<td><p>"+rec[i].tipo+"</p></td>";
                myTable+="<td><p>"+rec[i].plaga+"</p></td>";
                myTable+="<td><p>$"+rec[i].importe+"</p></td>";
                myTable+="<td><p>"+rec[i].fecha+"</p></td>";
                myTable+="</tr>";                  
            }//FIN DEL FOR 

            myTable+="</tbody></table></div>";

              $("#cuerpo").html(myTable);
         

                        $.ajax({
                        data: {},
                        type: "GET",
                        dataType: "json",
                        url: "../controladores/sumas_recaudado.php",
                        })
                        .done(function( data, textStatus, jqXHR ) {
                             if ( console && console.log )
                             {
                                     console.log( "La solicitud se ha completado correctamente." );
                                     var sumas = data;
                                 var htmlsumas="<p style='background-color:black; color:white;'>TOP GANANCIA";
                                      for (var i=0; i<sumas.length; i++)
                                        { 
                                            htmlsumas+="<p class='card blue-grey darken-1'>"+sumas[i].suma;
                                            htmlsumas+="<p>$"+sumas[i].total+"</p></p>";
                                             
                                     }
                                 $("#panel_izquierdo").html(htmlsumas);
                                        
                             }
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) {
                             if ( console && console.log ) {
                                 console.log( "La solicitud a fallado: " +  textStatus);
                             }
                        });
         
         
         
         
         
         
         
         
         
           
            

              cont_timer4=cont_timer+1;   
     }
 })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
});
    
}