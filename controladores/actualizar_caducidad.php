<?php
require("mysql.php");
$link= connect();


$consulta = "SELECT tareaeliminada.tar_deleted_at, tarea.tar_id,tarea.tar_estado, tareainiciada.fec_caducidad FROM tarea INNER JOIN tareainiciada ON tarea.tar_id=tareainiciada.tar_id LEFT JOIN tareaeliminada ON tareainiciada.tar_id=tareaeliminada.tar_id";

$resultado = $link->query($consulta);


$hoy = date("Y-m-d");
$mensaje;
$contador_actualizados=0;

if($resultado){
    while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{
    $id = $filas_de_query['tar_id'];
    $fecha_caducidad = $filas_de_query['fec_caducidad'];
    $estado = intval($filas_de_query['tar_estado']);
    $eliminada=$filas_de_query['tar_deleted_at'];
    if( ($fecha_caducidad<=$hoy)&&($estado!=3)&&(is_null($eliminada)) )
    {
        $contador_actualizados=$contador_actualizados+1;
        $resultado2 = $link->query("UPDATE tarea SET tarea.tar_estado='3' WHERE tarea.tar_id='$id'");
        $mensaje= $contador_actualizados." Tareas Actualizada(s)";
    }else{
       $mensaje= $contador_actualizados." Tareas Actualizada(s)"; 
    }
   
}
    
}else
{
    
}

echo $mensaje;




$link->close();
?>