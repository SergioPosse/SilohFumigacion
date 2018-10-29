<?php
require("mysql.php");
$link= connect();
$id=intval($_GET['x']);
$consulta = "SELECT * FROM tarea WHERE tar_id = '$id'";
$resultado = $link->query($consulta);
$MyObj = new stdClass();
$i=0;
while ($fila = mysqli_fetch_assoc($resultado)){
$myObj[$i] = new stdClass;
$myObj[$i]->importe=$fila['tar_importe'];
$myObj[$i]->descripcion=$fila['tar_descripcion'];
$myObj[$i]->id=$fila['tar_id'];
$myObj[$i]->tipTar=$fila['tipTar_id'];
$myObj[$i]->cliente=$fila['cli_id'];
$myObj[$i]->empleado=$fila['emp_id'];
$myObj[$i]->tipPla=$fila['tipPla_id'];
$i=$i+1;
}
$myJSON=json_encode($myObj);
echo $myJSON;
?>
