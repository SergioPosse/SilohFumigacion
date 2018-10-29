<?php

      require_once("mysql.php");

      $id= $_POST["valor1"];

      $hoy = date("Y-m-d"); 

      $link=connect();

      $resultado = $link->query("INSERT INTO tareaeliminada (tar_id, tar_deleted_at) VALUES ('".$id."', '".$hoy."')");

        

      if ($resultado === TRUE)
      {
          echo "Tarea eliminada";
      }
      else
      {
          echo "Error en eliminar tarea";
      }

      $link->close();

?>