<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT empleado.emp_id, count(empleado.emp_id) AS Cant, empleado.emp_nombre, empleado.emp_telefono FROM empleado INNER JOIN tareaimporte ON empleado.emp_id=tareaimporte.emp_id GROUP BY empleado.emp_id";

$resultado = $link->query($consulta);

$data=array();

while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{           
                array_push($data, array('id' => $filas_de_query['emp_id'], 'nombre' => $filas_de_query['emp_nombre'], 'tel' => $filas_de_query['emp_telefono'], 'cant' => $filas_de_query['Cant']));
}

$data = json_encode($data);

echo $data;
?>