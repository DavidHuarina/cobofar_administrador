<?php
require_once '../conexioncomercial.inc';
$nro_proceso=$_POST["nro_proceso"];
$destino=$_POST["destino"];
$glosa="TRASPASO A SUC. ";
$sql1="SELECT a.nombre_almacen FROM  almacenes a where a.cod_almacen='$destino'";
$respRepo=mysqli_query($enlaceCon,$sql1);
$nombre_almacen_destino="";
while($dat1=mysqli_fetch_array($respRepo)){ 
      $nombre_almacen_destino=$dat1[0];
}
$glosa.=" - ".$nombre_almacen_destino;

$sql1="UPDATE salida_almacenes SET almacen_destino='$destino',observaciones='$glosa' where cod_salida_almacenes='$nro_proceso'";
$respRepo=mysqli_query($enlaceCon,$sql1);
if($respRepo==1){
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
  window.location.href='../index.php?opcion=cambioDestino';
</script>
<?php
mysqli_close($enlaceCon);
?>
