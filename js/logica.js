$(document).ready(function(){
    $('.modal').modal();
    $('.modal').modal({
          dismissible: true, // Modal can be dismissed by clicking outside of the modal
          opacity: .5, // Opacity of modal background
          inDuration: 300, // Transition in duration
          outDuration: 200, // Transition out duration
          startingTop: '40%', // Starting top style attribute
          endingTop: '10px'
    });    
    
    $('#tar_id_oculto').hide();
    $('#radios').hide();

    //efectos prediseñados de loading
    $('#snipper').hide();
    $('#snipper2').hide();

    $('#btn_login').click(function(){
        $('#snipper').show();
        $('#form1').hide();
        $('#btn_login').hide();
    });
    
    $('select').material_select();
  
    $(".button-collapse").sideNav();
    
    
    $('.tooltipped').tooltip({delay: 50});
    
     $(document).ready(function(){
    $('.collapsible').collapsible();
  });

    
    //SETEO POR DEFECTO EL RADIO TODAS
         $(function() {
            var $radios = $('input:radio[name=group1]');
            if($radios.is(':checked') === false) {
                $radios.filter('[id=test1]').prop('checked', true);
            }
         });
    
    
         //CUANDO CAMBIO EL GRUPO DE RADIOBUTTONS ACTUALIZO LA TABLA
         $('#radios input').on('change', function() {
            clic();
         });

    
});

        //CREO EL OBJETO XML PARA LAS REQUEST DE AJAX A PHP
         var xhr;
         if (window.XMLHttpRequest)
         { // Mozilla, Safari, ...
            xhr = new XMLHttpRequest();
         }
         else if (window.ActiveXObject)
         { // IE 8 and older
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
         }

        //actualizar la caducidad de las tareas
            var cont_timer = 0; //VARIABLE PARA SABER SI SE RENDERIZA POR PRIMERA VEZ LA TABLA PARA APLICAR EFECTO
            var cont_timer2 = 0;
            var cont_timer3 = 0;
            var cont_timer4 = 0;
         $.ajax({
                data: {},
                url:   '../controladores/actualizar_caducidad.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                success:  function (response)
                {
                    Materialize.toast(response, 5000);
                }
          });

        $.ajax({
                        data: {call:0},
                        url:   '../admin/index.php', //archivo que recibe la peticion
                        type:  'post', //método de envio
                        success:  function (response) {
                        admin=parseInt(response);
                        alert(admin);
                        }
                }); 

        //BOTONES
        document.getElementById("actualizar").addEventListener("click", clic);
        document.getElementById("btn_reactivar_tarea").addEventListener("click", reactivar_tarea);
        document.getElementById("btn_agregar_tarea").addEventListener("click", agregar_tarea);
        document.getElementById("btn_nuevo_insumo").addEventListener("click", nuevo_insumo);
        document.getElementById("editar_insumos").addEventListener("click", editar_insumo);
        document.getElementById("clientes").addEventListener("click", listar_clientes);
        document.getElementById("empleados").addEventListener("click", listar_empleados);
        document.getElementById("recaudado").addEventListener("click", listar_recaudado);