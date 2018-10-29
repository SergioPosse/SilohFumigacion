<?php
      require("mysql.php");
      $link= connect();

      $loginID = $_POST['lst_usr'];
      $loginPassword =$_POST["password"];

      $consulta = "SELECT * FROM usuario WHERE usu_id='$loginID' AND usu_password='$loginPassword'";

      $resultado = $link->query($consulta);


      if($resultado)
      {
              $array_assoc=$resultado->fetch_assoc();
              $user=$array_assoc["usu_nombre"];
              $pass =$array_assoc["usu_password"];;
              $id=$array_assoc["usu_id"];
              $rango=$array_assoc["ran_id"];
              $resultado->close();
      }
      else
      {

          echo "Error de consulta";
      }
      $link->close();

      if(isset($loginID) && isset($loginPassword))
      {
            if($loginID == $id && $loginPassword == $pass)
            {
                session_start();
                $_SESSION['logueado'] = true;
                $_SESSION['usuario'] = $user;
                $_SESSION['id']=$id;
                $_SESSION['rango']=$rango;
                echo "Iniciando sesion por favor espere...";
			          header( "refresh:2; url=../admin/index.php" );
            }
            else
            {   
                echo "Error de sesion";
                
            }
      }
?>
