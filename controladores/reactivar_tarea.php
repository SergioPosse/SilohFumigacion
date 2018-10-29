<?php

      require_once("mysql.php");

      $id= intval($_POST["valor1"]);
      $importe = floatval($_POST["valor2"]);
      $hoy = date("Y-m-d");

      $nueva_fecha_caducidad= date('Y-m-d', strtotime('+30 day')) ;    


      $link=connect();


        $resultado = $link->query("UPDATE tarea SET tar_estado='1', tar_importe='$importe' WHERE tarea.tar_id='$id'");  

        $resultado2 = $link->query("UPDATE tareainiciada SET fec_caducidad='$nueva_fecha_caducidad', fec_inicio='$hoy' WHERE tareainiciada.tar_id='$id'");

      if ($resultado2 === TRUE)
      {
          echo "Tarea reactivada";
      }
      else
      {
          echo "Error en reactivar";
      }

      $link->close();

?>