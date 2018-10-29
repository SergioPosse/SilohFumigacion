<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT empleado.emp_nombre, cliente.cli_nombre,tipo_tarea.tipTar_descripcion, tipo_plaga.tipPla_descripcion, tareaimporte.tarImp_importe, tareaimporte.tarImp_fecha FROM tareaimporte INNER JOIN empleado ON empleado.emp_id=tareaimporte.emp_id INNER JOIN cliente ON tareaimporte.cli_id=cliente.cli_id INNER JOIN tipo_tarea ON tareaimporte.tipTar_id=tipo_tarea.tipTar_id INNER JOIN tipo_plaga ON tareaimporte.tipPla_id=tipo_plaga.tipPla_id";

$resultado = $link->query($consulta);

$data=array();

while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{           
                array_push($data, array('empleado' => $filas_de_query['emp_nombre'], 'cliente' => $filas_de_query['cli_nombre'], 'tipo' => $filas_de_query['tipTar_descripcion'], 'plaga' => $filas_de_query['tipPla_descripcion'], 'importe' => $filas_de_query['tarImp_importe'], 'fecha' => $filas_de_query['tarImp_fecha']));
}

$data = json_encode($data);

echo $data;
?>