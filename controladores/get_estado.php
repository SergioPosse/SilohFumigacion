<?php
require("mysql.php");
$link= connect();
$id=intval($_POST['valor1']);

$consulta = "SELECT tar_estado,tar_id FROM tarea WHERE tar_id = '$id'";

$resultado = $link->query($consulta);
                   
                while ($fila = mysqli_fetch_assoc($resultado)) {
                $estado = $fila['tar_estado'];
                    }
echo $estado;
$link->close();
?>