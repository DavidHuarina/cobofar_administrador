<?php
require_once '../conexioncomercial.inc';
$proceso=$_POST["proceso"];
$monto_modificado=$_POST["monto_modificado"];


  $montoCabecera=0;
  $sqlMonto="SELECT s.monto_final FROM salida_almacenes s where s.cod_salida_almacenes='".$proceso."'";
  $respMonto=mysqli_query($enlaceCon,$sqlMonto);
  while($dat1=mysqli_fetch_array($respMonto)){ 
      $montoCabecera=$dat1[0];
  }

$sql1="UPDATE salida_almacenes SET  monto_total='$monto_modificado',monto_final='$monto_modificado',descuento='0',monto_efectivo='$monto_modificado',monto_cancelado_bs='$monto_modificado',monto_cancelado_usd='0' where cod_salida_almacenes='$proceso'";
$respRepo=mysqli_query($enlaceCon,$sql1);
if($respRepo==1){
  $montoMax=0;
  $cod_material=0;

$montoQuitar=($montoCabecera-$monto_modificado);
 
  $sqlDet="SELECT monto_unitario,cod_material,cantidad_unitaria FROM  salida_detalle_almacenes where cod_salida_almacen='".$proceso."' order by monto_unitario desc limit 1;";
  $respDet=mysqli_query($enlaceCon,$sqlDet);
  while($dat1=mysqli_fetch_array($respDet)){ 
      $montoMax=$dat1[0];
      $cod_material=$dat1[1];
      $cantidad_unitaria=$dat1[2];
      $montoProd=$montoMax-$montoQuitar;
      $montoPrecio=$montoProd/$cantidad_unitaria;
      
      $sqlDetalle="UPDATE salida_detalle_almacenes SET precio_unitario='".$montoPrecio."',monto_unitario='".$montoProd."' where cod_salida_almacen='".$proceso."' and cod_material='".$cod_material."';";
      $respDetalle=mysqli_query($enlaceCon,$sqlDetalle);
  }

//echo $montoQuitar."_".$montoMax."_".$sqlDetalle;
  ?>
  <script type="text/javascript">
  alert("Se guardo el cambio correctamente.");
</script><?php	
}else{
  ?>
  <script type="text/javascript">
  alert("Hubo un error en la transacción!");
</script><?php  
}?>
<script type="text/javascript">
  window.location.href='../index.php?opcion=montoManual';
</script>
<?php
mysqli_close($enlaceCon);
?>
