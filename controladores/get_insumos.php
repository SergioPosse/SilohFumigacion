<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT * FROM insumo";

$resultado = $link->query($consulta);
                    echo "<option value='' disabled selected>Seleccionar Insumo</option>";
                  while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
                  {
                    echo "<option value='".$filas_de_query['ins_id']."'>".$filas_de_query['ins_nombre']."</option>";
                  }

$link->close();
?>