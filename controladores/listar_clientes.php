<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT count(cliente.cli_id) AS Cant, cliente.cli_id, cliente.cli_nombre, cliente.cli_tel AS tel, zona.zon_id, zona.zon_nombre, localidad.loc_nombre, provincia.pro_nombre FROM cliente INNER JOIN zona ON cliente.zon_id=zona.zon_id INNER JOIN localidad ON zona.loc_id=localidad.loc_id INNER JOIN provincia ON localidad.pro_id=provincia.pro_id INNER JOIN tareaimporte ON cliente.cli_id=tareaimporte.cli_id GROUP BY cliente.cli_id";

$resultado = $link->query($consulta);

$data=array();

while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{           
                array_push($data, array('id' => $filas_de_query['cli_id'], 'nombre' => $filas_de_query['cli_nombre'], 'zona' => $filas_de_query['zon_nombre'], 'localidad' => $filas_de_query['loc_nombre'], 'provincia' => $filas_de_query['pro_nombre'], 'Cant' => $filas_de_query['Cant'], 'tel' => $filas_de_query['tel']));
}

$data = json_encode($data);

echo $data;
?>