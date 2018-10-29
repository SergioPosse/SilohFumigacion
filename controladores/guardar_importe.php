<?php
require_once("mysql.php");
$id=$_POST["valor1"];
$importe = $_POST["valor2"];
$fecha= $_POST['valor3'];
$cli_id= intval($_POST['valor4']);
$emp_id= intval($_POST['valor5']);
$tipPla_id= intval($_POST['valor6']);
$tipTar_id= intval($_POST['valor7']);
$nueva_fecha_caducidad= date('Y-m-d', strtotime('+30 day')) ;

$link=connect();


$resultQuery = $link->query("SELECT * FROM tareainsumo WHERE tareainsumo.tar_id='$id'");
$insumosTarea = $resultQuery->fetch_array(MYSQLI_BOTH);
//$row = mysqli_fetch_array($resultado4);
if($insumosTarea)
{   
    $resultado2 = $link->query("UPDATE tarea SET tar_estado='2' WHERE tarea.tar_id='$id'");
    
    $resultado3 = $link->query("UPDATE tareainiciada SET fec_caducidad='$nueva_fecha_caducidad', fec_inicio='$fecha' WHERE tareainiciada.tar_id='$id'");
    
    $resultado = $link->query("INSERT INTO tareaimporte (tar_id, tarImp_importe, tarImp_fecha, cli_id, emp_id, tipTar_id, tipPla_id) VALUES ('".$id."', '".$importe."', '".$fecha."', '".$cli_id."', '".$emp_id."', '".$tipTar_id."', '".$tipPla_id."')");
    
    $tarImp_id= mysqli_insert_id($link);



while($filas_de_query=$resultQuery->fetch_array(MYSQLI_BOTH)) //NO ENTRA AL WHILE  
    {
        $tarIns_cantidad=$filas_de_query['tarIns_cantidad'];
        $ins_id=$filas_de_query['ins_id'];
        $med_id=$filas_de_query['med_id'];
    
        $resultado5 = $link->query("INSERT INTO tarimpinsumos (tarImp_id, ins_id, tarIns_cantidad, med_id) VALUES ('".$tarImp_id."', '".$ins_id."', '".$tarIns_cantidad."', '".$med_id."')");
    }
    
    if($resultado5===TRUE) //ERROR VARIABLE INDEFINIDA $RESULTADO5
   {
        echo "$".$importe." Recaudados";
    }
    else
    {
        echo "Error en el cobro de la tarea";
    }
    
    
    
}
else
{
    echo "CARGUE un insumo a la tarea por lo menos";
}
$link->close();
?>