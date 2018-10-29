<?php
require_once("mysql.php");

$id_tipo=$_POST['s_tipo'];
$id_plaga=$_POST['s_plaga'];
$id_cliente=$_POST['s_cliente'];
$id_empleado=$_POST['s_empleado'];
$importe=$_POST['imp'];
$descripcion=$_POST['desc'];
$array = json_decode($_POST['array']);
$id = $_POST['id'];




$link=connect();

$resultado = $link->query("UPDATE tarea SET tar_importe='$importe', tar_descripcion='$descripcion', tipPla_id='$id_plaga', tipTar_id='$id_tipo', cli_id='$id_cliente', emp_id='$id_empleado' WHERE tarea.tar_id='$id'"); 



foreach($array as $d){
     $resultado2 = $link->query("DELETE FROM tareainsumo WHERE tareainsumo.tarIns_id='$d->id'");
  }
echo "Tarea actualizada";
$link->close();
?>