<?php
require("mysql.php");
$link= connect();
$id=intval($_POST['x']);
$consulta = "SELECT tarIns_id, ins_nombre, tarIns_cantidad, med_descripcion FROM tareainsumo INNER JOIN insumo ON tareainsumo.ins_id=insumo.ins_id INNER JOIN medida ON tareainsumo.med_id=medida.med_id WHERE tareainsumo.tar_id = '$id'";
$resultado = $link->query($consulta);
$data=array();
while($filas_de_query=$resultado->fetch_array(MYSQLI_BOTH))
{               
                array_push($data, array('id' => $filas_de_query['tarIns_id'], 'insumo' => $filas_de_query['ins_nombre'], 'cantidad' => $filas_de_query['tarIns_cantidad'], 'medida' => $filas_de_query['med_descripcion']));           
}
$data = json_encode($data);
echo $data;
?>