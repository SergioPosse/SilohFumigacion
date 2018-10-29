<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT * FROM usuario";

$resultado = $link->query($consulta);
                    echo "<option value='' disabled selected>Seleccionar Usuario</option>";
                  while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
                  {
                    echo "<option value='".$filas_de_query['usu_id']."'>".$filas_de_query['usu_nombre']."</option>";
                  }

$link->close();
?>