<html>
<head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <script type=text/javascript>
                                            function cargar_usuarios(){
                                                $.ajax({
                                                    data: {},
                                                    url:   'controladores/get_usuarios.php', //archivo que recibe la peticion
                                                    type:  'post', //método de envio
                                                    success:  function (response) { //una vez que el archivo recibe el 
                                            
                                                        $("#lst_usr").html(response);
                                                        $('select').material_select();
                                                    }
                                                    });
                                                }
      </script>

	    <title>PROYECTO SILOH LOGIN</title>
</head>

<body onload="cargar_usuarios()">


<div class="container">
            
                      <div class="col l12 s12 m12">
                          <h1>Inicie Sesion Administrador/Empleado</h1>
                      </div> 
                        
     
                                <form class="col l12" id="form1" method="post" action="controladores/login.php">
                                	<div class="row">
                                            
                                        
                                        <select id="lst_usr" name="lst_usr">
                                        
                                    
                                        </select>
                                        
                                  		<div class="input-field">
                                         <i class="material-icons prefix  red-text">lock</i>
                                  	    	<input placeholder="Ingresa tu password" id="password" name="password" class="password " type="password">
                                  		</div>
                                	</div>
                        <div class="spinner" id="snipper">
                                <div class="rect1"></div>
                                <div class="rect2"></div>
                                <div class="rect3"></div>
                                <div class="rect4"></div>
                                <div class="rect5"></div>
                                <div class="rect6"></div>
                                <div class="rect7"></div>
                        </div>
                        <div class="col l5 center-align">
                           <button class="btn waves-effect waves-light blue" type="submit" name="submit" id="btn_login">Iniciar Sesion</button>

                        </div>
                     </form>

</div><!-- fin del container principal-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/logica.js"></script>
    
</body>
</html>
