<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT * FROM tipo_plaga";

$resultado = $link->query($consulta);
                    echo "<option value='' disabled selected>Seleccionar</option>";
                  while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
                  {
                    echo "<option value='".$filas_de_query['tipPla_id']."'>".$filas_de_query['tipPla_descripcion']."</option>";
                  }

$link->close();
?>