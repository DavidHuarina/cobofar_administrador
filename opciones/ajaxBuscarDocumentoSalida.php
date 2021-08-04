<?php
require_once '../conexioncomercial.inc';
$cod_sucursal=$_GET["cod_sucursal"];
$nro_salida=$_GET["nro_salida"];
$nro_proceso=0;
$almacen_destino=0;
$nombre_almacen_destino="";
$glosa="";
$sql1="SELECT s.cod_salida_almacenes,s.almacen_destino,a.nombre_almacen,s.observaciones FROM salida_almacenes s JOIN almacenes a on a.cod_almacen=s.almacen_destino where s.cod_almacen='$cod_sucursal' and s.nro_correlativo='$nro_salida' and s.cod_tiposalida!=1001";
     $respRepo=mysqli_query($enlaceCon,$sql1);
    // echo $sql1;
   while($dat1=mysqli_fetch_array($respRepo))
    { 
    	$nro_proceso=$dat1[0];
    	$almacen_destino=$dat1[1];
    	$nombre_almacen_destino=$dat1[2];
      $glosa=$dat1[3];
    }
if($nro_proceso>0){
  ?>
  <p class="text-muted">Documento enviado a la sucursal: <b>"<?=$nombre_almacen_destino?>"</b></p>
    <p class="text-success">Glosa: <b>"<?=$glosa?>"</b></p>
  <button type="submit" class="btn btn-danger float-center">GUARDAR</button>  <?php	
}
mysqli_close($enlaceCon);
?>
<script type="text/javascript">
	$("#nro_proceso").val(<?=$nro_proceso?>);
	$("#destino").val('<?=$almacen_destino?>');
	$(".selectpicker").selectpicker("refresh");
</script>