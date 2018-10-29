<?php
require("mysql.php");
$link= connect();

$consulta = "SELECT cliente.cli_id, tipo_tarea.tipTar_id, tipo_plaga.tipPla_id, empleado.emp_id, tarea.tar_id,tipo_tarea.tipTar_descripcion,tipo_plaga.tipPla_descripcion,cliente.cli_nombre,empleado.emp_nombre,tarea.tar_importe,tarea.tar_estado,tareainiciada.fec_inicio,tareainiciada.fec_caducidad, tareaeliminada.tar_deleted_at, tareainsumo.tar_id AS insumo_cargado FROM tarea INNER JOIN tareainiciada ON tarea.tar_id=tareainiciada.tar_id  LEFT JOIN cliente ON tarea.cli_id=cliente.cli_id LEFT JOIN tipo_tarea ON tipo_tarea.tipTar_id=tarea.tipTar_id LEFT JOIN tipo_plaga ON tarea.tipPla_id=tipo_plaga.tipPla_id LEFT JOIN empleado ON tarea.emp_id=empleado.emp_id INNER JOIN estado_tarea ON tarea.tar_estado=estado_tarea.est_id LEFT JOIN tareaeliminada ON tarea.tar_id=tareaeliminada.tar_id LEFT JOIN tareainsumo ON tarea.tar_id=tareainsumo.tar_id GROUP BY tarea.tar_id";

$resultado = $link->query($consulta);

$data=array();

//if ($resultado){
 //   echo "select bueno";
//}else
//{
  //  echo "select malo";
//}
//CON UN LEFT JOIN A LA TABLA TAREAINSUMOS CARGO TODAS LAS TAREAS QUE TENGAN ASOCIADAS UN REGISTROS EN LA TABLA
//TAREAINSUMO COMO CAMPO CON EL VALOR DE UN NUMERO (GROUP BY TAR_ID PARA QUE NO SE REPITA LA TAREA) SI LA TAREA YA TIENE AL MENOS UN INSUMO ASOCIADO O CON NULL (GRACIAS AL LEFT JOIN) SI LA TABLA NUNCA ASOCIO UN INSUMO AUN
while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{
            if(is_null($filas_de_query['tar_deleted_at'])){
                
                array_push($data, array('id' => $filas_de_query['tar_id'],'tipo' => $filas_de_query['tipTar_descripcion'],'plaga' => $filas_de_query['tipPla_descripcion'],'cliente' => $filas_de_query['cli_nombre'],'empleado' => $filas_de_query['emp_nombre'],'importe' => $filas_de_query['tar_importe'],'estado' => $filas_de_query['tar_estado'],'fecha_inicio' => $filas_de_query['fec_inicio'],'fecha_caducidad' => $filas_de_query['fec_caducidad'],'eliminada' => $filas_de_query['tar_deleted_at'],'insumo_cargado' => $filas_de_query['insumo_cargado'], 'cli_id' => $filas_de_query['cli_id'], 'tipTar_id' => $filas_de_query['tipTar_id'], 'tipPla_id' => $filas_de_query['tipPla_id'], 'emp_id' => $filas_de_query['emp_id']));
                
            }
            else{
            
            
         }
               

}

$data = json_encode($data);

echo $data;
?>