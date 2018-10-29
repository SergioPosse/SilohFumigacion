<?php
$id_tipo=$_POST['s_tipo'];
$id_plaga=$_POST['s_plaga'];
$id_cliente=$_POST['s_cliente'];
$id_empleado=$_POST['s_empleado'];
$importe=$_POST['imp'];
$descripcion=$_POST['desc'];

$hoy = date('Y-m-d', strtotime('-1 day'));

$fecha_caducidad = date('Y-m-d', strtotime('+30 day'));

$estado = 1;


require_once("mysql.php");

$link= connect();

$resultado = $link->query("INSERT INTO tarea (tar_descripcion, tar_estado, cli_id, tipPla_id, tipTar_id, emp_id, tar_importe) VALUES ('".$descripcion."', '".$estado."', '".$id_cliente."', '".$id_plaga."', '".$id_tipo."', '".$id_empleado."', '".$importe."')");

$id = mysqli_insert_id($link);
					  
$resultado2 = $link->query("INSERT INTO tareainiciada (tar_id, fec_inicio, fec_caducidad) VALUES('".$id."', '".$hoy."','".$fecha_caducidad."')");
					  
if ($resultado2)
{
	echo "Nueva Tarea Agregada"; 
}
else
{
	echo "error al cargar tareainiciada";
}

$link->close();
?>