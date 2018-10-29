<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT * FROM empleado";

$resultado = $link->query($consulta);
                    echo "<option value='' disabled selected>Seleccionar</option>";
                  while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
                  {
                    echo "<option value='".$filas_de_query['emp_id']."'>".$filas_de_query['emp_nombre']."</option>";
                  }

$link->close();
?>