<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT * FROM medida";

$resultado = $link->query($consulta);
                    echo "<option value='' disabled selected>Medida</option>";
                  while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
                  {
                    echo "<option value='".$filas_de_query['med_id']."'>".$filas_de_query['med_descripcion']."</option>";
                  }

$link->close();
?>