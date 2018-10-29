<?php
require("mysql.php");
$data2=array();
$link= connect();

$consulta1 = "SELECT sum(tarImp_importe) AS Suma, cli_nombre FROM tareaimporte INNER JOIN cliente ON tareaimporte.cli_id=cliente.cli_id GROUP BY tareaimporte.cli_id LIMIT 1";

$resultado1 = $link->query($consulta1);



while($filas_de_query=$resultado1->fetch_array(MYSQLI_BOTH))
{           
                array_push($data2, array('suma' => $filas_de_query['cli_nombre'], 'total' => $filas_de_query['Suma']));
}

$consulta2 = "SELECT sum(tarImp_importe) AS Suma, emp_nombre FROM tareaimporte INNER JOIN empleado ON tareaimporte.emp_id=empleado.emp_id GROUP BY tareaimporte.emp_id LIMIT 1";

$resultado2 = $link->query($consulta2);



while($filas_de_query=$resultado2->fetch_array(MYSQLI_BOTH))
{           
                array_push($data2, array('suma' => $filas_de_query['emp_nombre'], 'total' => $filas_de_query['Suma']));
}

$consulta3 = "SELECT sum(tarImp_importe) AS Suma, tipTar_descripcion FROM tareaimporte INNER JOIN tipo_tarea ON tareaimporte.tipTar_id=tipo_tarea.tipTar_id GROUP BY tareaimporte.tipTar_id LIMIT 1";

$resultado3 = $link->query($consulta3);



while($filas_de_query=$resultado3->fetch_array(MYSQLI_BOTH))
{           
                array_push($data2, array('suma' => $filas_de_query['tipTar_descripcion'], 'total' => $filas_de_query['Suma']));
}

$consulta4 = "SELECT sum(tarImp_importe) AS Suma, tipPla_descripcion FROM tareaimporte INNER JOIN tipo_plaga ON tareaimporte.tipPla_id=tipo_plaga.tipPla_id GROUP BY tareaimporte.tipPla_id LIMIT 1";

$resultado4 = $link->query($consulta4);



while($filas_de_query=$resultado4->fetch_array(MYSQLI_BOTH))
{           
                array_push($data2, array('suma' => $filas_de_query['tipPla_descripcion'], 'total' => $filas_de_query['Suma']));
}

$data2 = json_encode($data2);

echo $data2;
?>