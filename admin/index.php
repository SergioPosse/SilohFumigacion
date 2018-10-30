<?php session_start();
require_once("../controladores/check_login.php");
if (check_login())
{
if ($_SESSION['usuario']=='Administrador'){
$admin = true;
echo $admin;
}
else
{
$admin = false;
echo $admin; 
}
ob_start();
}
else{
//echo "<a href='../login.php'>Iniciar Sesion</a>";
}
?>
<html>
  <head>
    <title>SILOH CONTROL DE PLAGAS</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Acme|Shrikhand" rel="stylesheet"/>
    <link href="../fonts/bb.ttf" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/app.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/animate.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css">    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> 
    <script type=text/javascript>
        
        var fila_seleccionada;
        var filainsumo_seleccionada;
        var array_insumos_a_eliminar=new Array();
        var admin=0;
        
        function guardar_tarea()
        {
            var id = document.getElementById("tar_id_oculto3").innerHTML;
            var select_cliente = document.getElementById("lst_clienteE").value;
			var select_empleado = document.getElementById("lst_empleadoE").value;
			var select_tipo = document.getElementById("lst_tipoE").value;
			var select_plaga = document.getElementById("lst_plagaE").value;
			
            var importeconpeso = document.getElementById("importe_tareaE").value;
            var siz = importeconpeso.length;
            var importe = importeconpeso.substring(siz, 2);
			var descripcion = document.getElementById("descripcion_tareaE").value;
			var jsonString = JSON.stringify(array_insumos_a_eliminar);
			
			$.ajax({
                    data: {id: id, s_cliente: select_cliente, s_tipo: select_tipo, s_plaga: select_plaga, s_empleado: select_empleado, desc: descripcion, imp: importe, array: jsonString},
                    url:   '../controladores/guardar_tarea.php', 
                    type:  'post',
                    success:  function (response) 
                   { 
                        $('#modal_editar_tarea').modal('close');
                        clic();
                        
                    }
                });	  
        }
   
        function push_insumo(x){
            var id = x.dataset.id;    
            array_insumos_a_eliminar.push({
            id: id, 
            red: false});
            x.disabled = true;
        }
        
        function editar_insumo()
        {
            var id = document.getElementById("tar_id_oculto3").innerHTML;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function()
                    {
                            if (this.readyState == 4 && this.status == 200)
                            {
                                
                                    var myObj = JSON.parse(this.responseText);
                                    var htmltexto="<table id='tablitainsumos'><thead><tr><th>Insumo</th><th>Cant.</th><th>Eliminar</th></tr></thead><tbody>";
                                    for (var i=0; i<myObj.length; i++) {
                                        htmltexto+="<tr>";
                                        htmltexto+="<td>"+myObj[i].insumo+"</td>";
                                         htmltexto+="<td>"+myObj[i].cantidad+" "+myObj[i].medida+"</td>";
                                        if(admin){
                                            htmltexto+="<td><button data-id='"+myObj[i].id+"' onclick='push_insumo(this)'  class='btn-floating waves-effect waves-light black'><i class='material-icons'>cancel</i></button></td>";
                                        htmltexto+="</tr>";
                                        }
                                        
                                     }
                                htmltexto+="</tbody></table>";
                                    $('#cargar_insumos_aca').html(htmltexto);
                               
                            }
                    };

                    xmlhttp.open("POST", "../controladores/getInsTarea.php", true);
                    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp.send("x=" + id);
            
            
        }
        
         function detalle_tarea(x)
         {
                    array_insumos_a_eliminar.length=0;
                    cargar_clientes();
                    cargar_tipos();
                    cargar_empleados();
                    cargar_plagas();
                     $('.collapsible').collapsible('close',0);
                     $('.collapsible').collapsible('close',1);
                     $('.collapsible').collapsible('close',2);
                     $('.collapsible').collapsible('close',3);
                     $('.collapsible').collapsible('close',4);
                    var id = x.dataset.id;
              
              $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {x: id},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    // URL a la que se enviará la solicitud Ajax
    url: "../controladores/getOneTarea.php",
})
 .done(function( data, textStatus, jqXHR ) {
     if ( console && console.log ) {
     var s=data;
            
                                    var myObj = jQuery.parseJSON(JSON.stringify(s));
         
                                    $(".modal-content #tar_id_oculto3").html(myObj[0]['id']);                               
                                    $(".modal-content #importe_tareaE").val("$ "+myObj[0]['importe']);
                                    $(".modal-content #descripcion_tareaE").val(myObj[0]['descripcion']);
                          
                                
                                $('#modal_editar_tarea .modal-content #lst_clienteE').val(myObj[0]['cliente']);
                                $('.modal-content #lst_empleadoE').val(myObj[0]['empleado']);
                                $('#modal_editar_tarea .modal-content #lst_tipoE').val(myObj[0]['tipTar']);
                                $('#lst_plagaE').val(myObj[0]['tipPla']);
                                
                                // re-initialize material-select
                                $('#lst_clienteE').material_select();
                                $('#lst_empleadoE').material_select();
                                $('#lst_plagaE').material_select();
                                $('#lst_tipoE').material_select();
                                
                                $('#modal_editar_tarea').modal('open');
                                
                                if(admin){
                                    $(".modal-content #importe_tareaE").attr("disabled", false);
                                    $(".modal-content #descripcion_tareaE").attr("disabled", false);
                                    $('.modal-content #lst_clienteE').attr("disabled", false);
                                    $('.modal-content #lst_empleadoE').attr("disabled", false);
                                    $('.modal-content #lst_tipoE').attr("disabled", false);
                                    $('.modal-content #lst_plagaE').attr("disabled", false);
                                    $('.modal-content #btn_guardar_tarea').attr("disabled", false);
                                }
                                else{
                                    $(".modal-content #importe_tareaE").attr("disabled", true);
                                    $(".modal-content #descripcion_tareaE").attr("disabled", true);
                                    $('.modal-content #lst_clienteE').attr("disabled", true);
                                    $('.modal-content #lst_empleadoE').attr("disabled", true);
                                    $('.modal-content #lst_tipoE').attr("disabled", true);
                                    $('.modal-content #lst_plagaE').attr("disabled", true);
                                    $('.modal-content #btn_guardar_tarea').attr("disabled", true);
                                }
     
     
     
     }
                   })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
});
             
             
             
             
             
             
             
             
             
 
         }
        

        
        function select_tarea(x){
            //alert("click");
            fila_seleccionada=x.rowIndex;
            
         
            var tablarows = document.getElementById("tablita").rows;
            var tablacant = document.getElementById("tablita").rows.length;
            
               for ( var i = 1; i < tablacant; ++i )
               {
                   
                   if (tablarows[i].rowIndex==fila_seleccionada)
                {
                    tablarows[i].style.borderLeft="8px solid #9c27b0";
                }
                   else{
                      tablarows[i].style.borderLeft="0px"; 
                   }
                   
                   

               }

            
        }
        
        
        function peso(x){
            
           var importe = x.value;
        var siz = importe.length;
             var nuevaCadena = importe.substring(siz, 2);
            x.value="$ "+nuevaCadena;
            
            
        }
		function agregar_tarea(){
			
			var select_cliente = document.getElementById("lst_cliente").value;
			var select_empleado = document.getElementById("lst_empleado").value;
			var select_tipo = document.getElementById("lst_tipo").value;
			var select_plaga = document.getElementById("lst_plaga").value;
			
			var importeconpeso = document.getElementById("importe_tarea").value;
            var siz = importeconpeso.length;
            var importe = importeconpeso.substring(siz, 2);
			var descripcion = document.getElementById("descripcion_tarea").value;
			
			
			$.ajax({
                    data: {s_cliente: select_cliente, s_tipo: select_tipo, s_plaga: select_plaga, s_empleado: select_empleado, desc: descripcion, imp: importe},
                    url:   '../controladores/new_tarea.php', 
                    type:  'post',
                    success:  function (response) 
                   { 
                            $('#modal1_cargar_tarea').modal('close');
                            Materialize.toast("Nueva Tarea Agregada", 4000);
                            var radiobtn = document.getElementById("test3");
                            radiobtn.checked = true;
                            
                       
                            
							clic();
                      
                    }
                });		
		}	
			
        function cargar_tipos(){
                $.ajax({
                    data: {},
                    url:   '../controladores/get_tipos.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_tipo").html(response);
                        $("#lst_tipoE").html(response);
                            $('select').material_select();
                    }
                });
            }
            function cargar_empleados(){
                $.ajax({
                    data: {},
                    url:   '../controladores/get_empleados.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_empleado").html(response);
                        $("#lst_empleadoE").html(response);
                            $('select').material_select();
                    }
                });
            }
            function cargar_plagas(){
                $.ajax({
                    data: {},
                    url:   '../controladores/get_plagas.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_plaga").html(response);
                         $("#lst_plagaE").html(response);
                            $('select').material_select();
                    }
                });
            }
        function cargar_clientes(){
                $.ajax({
                    data: {},
                    url:   '../controladores/get_clientes.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_cliente").html(response);
                        $("#lst_clienteE").html(response);
                            $('select').material_select();
                    }
                });
            }
        
           
            function eliminar_tarea(x)
            {
                var id = x.dataset.id;
                
                
                var opcion = confirm("Seguro que desea eliminar la tarea?");
                            if (opcion == true)
                            {
                                $.ajax({
                                    data:{valor1: id},
                                    url: '../controladores/eliminar_tarea.php',
                                    type:  'post',
                                    success:  function (response) {
                                       Materialize.toast(response, 4000);
                                        
                                        clic();
                                                   }
                                 });
                             }
                             else
                             {
                                
                                    Materialize.toast("Cancelar eliminar", 4000);
                             }
                
                
            }
        
        
        
        
            function agregar_insumo(x)
            {
                var id = x.dataset.id;
                $(".modal-content #tar_id_oculto2").html(id);
                $('.modal-content #id_cantidad_insumo').val("");
                $.ajax({
                    data: {},
                    url:   '../controladores/get_insumos.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_insumo").html(response);
                            $('select').material_select();
                    }
                });
                $.ajax({
                    data: {},
                    url:   '../controladores/get_medidas.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $("#lst_medida").html(response);
                            $('select').material_select();
                    }
                });
                
            }
        
        function nuevo_insumo(){
            
            var id = document.getElementById("tar_id_oculto2").innerHTML;
            var select_insumo = document.getElementById("lst_insumo").value;
			var select_medida = document.getElementById("lst_medida").value;
			var cantidad = document.getElementById("id_cantidad_insumo").value;
			      
          $.ajax({
                    data: {id: id, s_insumo: select_insumo, s_medida: select_medida, cant: cantidad},
                    url:   '../controladores/nuevo_insumo.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                            $('#modal_agregar_insumo').modal('close');
                            Materialize.toast(response, 4000);
                            
							clic();
                    }
                });  
            
        }
        
        
       
        
        
        
        function reactivar_tarea(){
            
            
            if(admin){ 
                var id = document.getElementById("tar_id_oculto").innerHTML;
                var importeconpeso = document.getElementById("id_nuevo_importe").value;
                var siz = importeconpeso.length;
                var importe = importeconpeso.substring(siz, 2);
    
                var opcion = confirm("Seguro que desea reactivar la tarea?");
                            if (opcion == true)
                            {
                                $.ajax({
                                    data:{valor1: id, valor2: importe},
                                    url: '../controladores/reactivar_tarea.php',
                                    type:  'post',
                                    success:  function (response) {
                                       Materialize.toast(response, 4000);
                                        $('#modal_reactivar').modal('close');
                                        $("#modal_reactivar input").val("");
                                        clic();
                                                   }
                                 });
                             }
                             else
                             {
                                 $('#modal_reactivar').modal('close');
                                    Materialize.toast("Cancelar reactivar", 4000);
                             }
             }
    
}
        
        
        
        
        
        
        
        
        function estado_tarea(x)
            {
                if(admin){
                var id = x.dataset.id;
                var importe = x.dataset.importe;
                var cli_id=x.dataset.cli;
                
                var emp_id=x.dataset.emp;
                var tipTar_id=x.dataset.tar;
                var tipPla_id=x.dataset.pla;
            
                var fecha = moment(new Date()).format('YYYY-MM-DD');
           
                $('.modal-content #id_nuevo_importe').val("");
                $.ajax({
                    data: {valor1:id},
                    url:   '../controladores/get_estado.php', 
                    type:  'post',
                    success:  function (response) 
                    { 
                        var estado = parseInt(response);
                    
                        if(estado==3){
                            $(".modal-content #tar_id_oculto").html(id);
                            $('#modal_reactivar').modal('open');
                        }
                        if(estado==2){
                            alert("Espere mas dias para realizar de nuevo la tarea");
                        }
                        if(estado==1){
                            var opcion = confirm("Seguro que desea finalizar la tarea y guardar importe?");
                            if (opcion == true)
                            {
                                $.ajax({
                                    data:{valor1: id, valor2: importe, valor3: fecha, valor4: cli_id, valor5: emp_id, valor6: tipTar_id, valor7: tipPla_id},
                                    url: '../controladores/guardar_importe.php',
                                    type:  'post',
                                    success:  function (response) {
                                       Materialize.toast(response, 4000);
                                        clic();
                                                   }
                                 });
                             }
                             else
                             {
                                    Materialize.toast("Cancelar finalizar", 4000);
                             }
                        }
                    }
                });
             }
                
                
            }
    </script>
  </head>
  <body>
      
    <div class="container">
        
        
          <div class="row">
              
            <div class="col l12 s12 m12">
              <nav>
                <!-- el menu en escritorio-->
                <div class="nav-wrapper">
                        <div class="col l2 s1 m1">
                            <a href="index.php" class="brand-logo"><p class="flow-text">SILOH</p></a>
                        </div>
                        <div class="col l8 m8 s8">
                            <ul id="nav-mobile">
                                <?php
                                require_once("../controladores/check_login.php");
                                if (check_login())
                                {
                                    echo "<li><a id='actualizar' class='miboton1' href='#' class='btn tooltipped' data-position='bottom' data-delay='50' data-tooltip='Listar Tareas'>Tareas</a></li>";
                                }
                                else{
                                    echo "";
                                }
                                require_once("../controladores/check_admin.php");
                                if(check_admin()){
                                    echo "<li><a id='clientes' class='miboton2' href='#' class='btn tooltipped' data-position='bottom' data-delay='50' data-tooltip='Listar Clientes'>Clientes</a></li>";
                                    echo "<li><a id='empleados' href='#' class='miboton2' href='#' class='btn tooltipped' data-position='bottom' data-delay='50' data-tooltip='Listar Empleados'>Empleaados</a></li>";
                                    echo "<li><a id='recaudado' href='#' class='miboton2' href='#' class='btn tooltipped' data-position='bottom' data-delay='50' data-tooltip='Recaudado'>Recaudado</a></li>";
                                }
                                ?> 
                            </ul>
                        </div>
                        <div class="col s2 m2 l2">
                                <p id="cuenta">
                                <?php
                                require_once("../controladores/check_login.php");
                                if (check_login())
                                {
                                    echo $_SESSION['usuario'];
                                }
                                else{
                                    echo "<a href='../index.php'>Iniciar Sesion</a>";
                                }
                               ?>
                               </p>
                        </div>
                        <div>
                                <!-- el menu en mobiles-->
                                <ul id="slide-out" class="side-nav hide-on-med-and-large">
                                <li><a href="#!"><i class="miboton1 material-icons">config</i><p class="flow-text">TAREAS</p></a></li>
                                <li><a href="#!"><i class="miboton2 material-icons">user</i><p class="flow-text">CLIENTES</p></a></li>
                                </ul><a href="#" data-activates="slide-out" class="button-collapse left"><i class="material-icons">menu</i></a>
                        </div>
                </div> <!-- FIN DEL NAV WRAPPER -->
              </nav>
            </div><!-- FIN COLUMNA DEL NAV -->
          </div><!-- PRIMER FILA MENU -->
        
         <div class="row">
                        <div class="col l12 center centered">
                                <form action="#" id="radios">
                                  <input name="group1" type="radio" id="test1" />
                                  <label for="test1">Todas</label>
                                  <input name="group1" type="radio" id="test2" />
                                  <label for="test2">Reactivables</label>
                                  <input name="group1" type="radio" id="test3"  />
                                  <label for="test3">Nuevas</label>
                                  <input name="group1" type="radio" id="test4"  />
                                  <label for="test4">Terminadas</label>
                                </form>
                        </div>
              
                </div>
          <div class="row">
                <div class="row">
                    <div id="panel_izquierdo" class="col l2 center centered">
                    </div>
                    <div id="cuerpo" class="col l10 center centered">
                        <h1 id="intro" class="animated fadeIn retraso1">Control de plagas</h1>
                        <p id="intro2" class="animated fadeIn retraso2">Administración de tareas</p>
                        <p id="intro3" class="animated fadeIn retraso3">y administración de clientes</p>
                    </div>
                </div>
  
            </div>
                
          <!-- segunda FILA boton tabla-->
          <div class="row">
                <div class="col l12 s12 m12">
                      <div class="site-footer">
                        <!-- COLUMNA B DEL FOOTER--><p><a href='../controladores/logout.php'>Cerrar Sesion</a></p>
                      </div>
                </div>
          </div><!-- tercer fila footer -->
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- VENTANAS MODALES ------------------------------------------------------------------------------------>
                        <div id="modal1_cargar_tarea" class="flow-text modal">
                                    
                            <div class="modal-content">
                                    <div class="row">
                                        <div class="col l12 centered center">
                                            <h1>TAREAS</h1>
                                        </div>
                            </div>
                                    <div class="row">
                                            <div class="col l3">
                                              <divider/>
                                              <label for="Tipo">Tipo</label>
                                              <select id="lst_tipo" name="lst_tipo">
                                              </select>
                                            </div>
                                            <div class="col l3">
                                              <divider/>
                                              <label for="Plaga">Plaga</label>
                                              <select id="lst_plaga" name="lst_plaga">
                                              </select>
                                            </div>
                                   
                            
                        
                                            <div class="col l3">
                                                    <divider/>
                                                    <label for="Cliente">Cliente</label>
                                                    <select id="lst_cliente" name="lst_cliente">
                                                    </select>
                                            </div>
                                            <div class="col l3">
                                                    <divider/>
                                                    <label for="Empleado">Empleado</label>
                                                    <select id="lst_empleado" name="lst_empleado">
                                                    </select>
                                            </div>
                                    </div>
                            
                            
                                    
                            <div class="row">
                            
                                    <div class="col l6">
                                      <label class="input-field inline" for="Descripcion">Descripcion</label>
                                      <textarea placeholder="Descripcion" id="descripcion_tarea"></textarea>
                                      <divider/>
                                    </div> 
                                    <div class="col l6">
                                      <label for="Importe">Importe</label>
                                      <input onkeypress="peso(this)" type="text" min="0" max="9" name="importe" placeholder="Escriba el importe" id="importe_tarea"/>
                                    </div>
                            </div>
                                    <div class="row">
                                        <div class="col l12 centered center">
                                             <button id="btn_agregar_tarea" class="b">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                          </div> <!-- FIN MODAL NUEVA TAREA -->
        
        
        <!-- MODAL REACTIVAR TAREA -->
        <div id="modal_reactivar" class="flow-text modal modalchico">
            <div class="modal-content">
                <h4 class="center centered">REACTIVAR TAREA</h4>
                <p id="tar_id_oculto"></p>
                
                <div class="row">
                    <div class="col l12">
                        <label for="importe" class="center centered">Importe</label>
                        <input onkeypress="peso(this)" type="text" name="nuevo_importe" placeholder="Escriba el nuevo importe" id="id_nuevo_importe" />
                    
                    </div>
                
                </div>
                
                <div class="row">
                                        <div class="col l12 centered center">
                                             <button class="black text-darken-2 waves-effect waves-light btn-large" class="center centered" id="btn_reactivar_tarea" class="b">Reactivar</button>
                                        </div>
                                    </div>
            
            
            </div>
       </div> <!-- FIN MODAL NUEVA TAREA -->
        
        
        <!-- MODAL AGREGAR INSUMO -->
        <div id="modal_agregar_insumo" class="flow-text modal">
            <div class="modal-content">
                <h4 class="centered center">AGREGAR INSUMO A LA TAREA</h4>
                <p id="tar_id_oculto2" class="hide"></p>
                
                <divider/>
                
                
                
                <div class="row">
                
                    <div class="col l2">
                    </div>               

                    <div class="col l4">
                        <label for="insumo" class="center centered">Insumo</label>
                                                    <select id="lst_insumo" name="lst_insumo">
                                                    </select>
                    </div>               
                    <div class="col l1">
                        <label for="importe" class="center centered">Cantidad</label>
                <input type="text" name="nuevo_insumo" placeholder="Cantidad" id="id_cantidad_insumo" />
                    </div>               
                    <div class="col l2">
                        <label for="medida" class="center centered">Medida</label>
                                                    <select id="lst_medida" name="lst_medida">
                                                    </select>
                    </div>               
                </div>

                <div class="row">
                                        <div class="col l12 centered center">
                                             <button class="black text-darken-2 waves-effect waves-light btn-large" id="btn_nuevo_insumo" class="b">Agregar</button>
                                        </div>
                                    </div>
            
            
            </div>
       </div> <!-- FIN MODAL NUEVA TAREA -->
                                        
                                        
                                        
                                        
           <!-- MODAL EDITAR INSUMO -->
        <div id="modal_editar_tarea" class="modal flow-text">
            <div class="modal-content">
                
                <h4 class="centered center">
                 EDITAR TAREA
                </h4>
                <p id="tar_id_oculto3" class="hide"></p>
                
                <divider/>                                  
                <div class="row">
                                           
                                                
                                          
                                            
                    
                    
                    
                    
                    <ul class="collapsible" data-collapsible="expandable">
    <li>
      <div class="collapsible-header">TAREA</div>
        <p id="tar_id_oculto3" class="hide"></p>
      <div class="collapsible-body col l12">
          <div class="col l12" class="collapsible-body">
              <form>
                  <div class="input-field">
              <Table class="responsive-table centered highlight">
                  <thead>
                    <tr>
                      <th>Tipo</th><td><select class="browser-default" id="lst_tipoE" name="lst_tipoE">
                                                </select></td>
                      </tr>
                      <tr>
                        <th>Plaga</th><td><select class="browser-default" id="lst_plagaE" name="lst_plagaE"></select></td>
                      </tr>
                      <tr>
                        <th>Cliente</th>
                          <td><select class="browser-default" id="lst_clienteE" name="lst_clienteE">
                                                </select></td>
                      </tr>
                      <tr>
                        <th>Empleado</th><td><select class="browser-default" id="lst_empleadoE" name="lst_empleadoE">
                                                </select></td>
                      </tr>
                  
                  </thead>
                  <tbody>

                  </tbody>
              
              </Table>
                       </div>
        </form>
        </div>                             
        </div>
    </li>
                        <li>
                  <div class="collapsible-header">IMPORTE</div>
                            <div class="collapsible-body">
                                <input id="importe_tareaE" onkeypress="peso()" type="text" min="0" max="9" name="importe"/></div>
    </li>
                        <li>
      <div  class="collapsible-header">DESCRIPCION</div>
      <div class="collapsible-body">
                                      <textarea style="height:217px;" placeholder="Descripcion" id="descripcion_tareaE"></textarea></div>
    </li>
    <li>
      <div id="editar_insumos" class="collapsible-header">INSUMOS USADOS</div>
        <div class="collapsible-body"><div style="font-size:small;" id="cargar_insumos_aca"></div></div>
    </li>
  </ul>
                
                
                                    <div class="row">
                                        <div class="col l12 centered center">
                                             <button onclick="guardar_tarea()" id="btn_guardar_tarea" class="b">Guardar</button>
                                        </div>
                                    </div>
                                                
                                                
                                                
                                </div>
                </div>
                    
       </div> <!-- FIN MODAL EDITAR TAREA -->                                
                                       
  </div><!-- END main container -->

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/moment.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/modulos.js"></script>
<script type="text/javascript" src="../js/listar_tareas.js"></script>
<script type="text/javascript" src="../js/listar_clientes.js"></script>
<script type="text/javascript" src="../js/listar_empleados.js"></script> 
<script type="text/javascript" src="../js/listar_recaudado.js"></script> 
<script type="text/javascript" src="../js/logica.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>
