<?php
$id=$_POST['id'];
$id_insumo=$_POST['s_insumo'];
$id_medida=$_POST['s_medida'];
$cantidad=$_POST['cant'];

require_once("mysql.php");

$link= connect();

$resultado = $link->query("INSERT INTO tareainsumo (tar_id, ins_id, tarIns_cantidad, med_id) VALUES ('".$id."', '".$id_insumo."', '".$cantidad."', '".$id_medida."')");
				  
if ($resultado)
{
	echo "Tarea: ".$id.", insumo agregado"; 
}
else
{
	echo "error al cargar insumo";
}

$link->close();
?>