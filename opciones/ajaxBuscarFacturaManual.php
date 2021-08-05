<?php
require_once '../conexioncomercial.inc';
require_once '../functions.php';
$cod_sucursal=$_GET["cod_sucursal"];
$nro_salida=$_GET["nro_salida"];
$nro_proceso=$_GET["nro_proceso"];


$sql1="SELECT s.cod_salida_almacenes,s.nro_correlativo,s.monto_final,a.nombre_almacen,s.observaciones,s.cod_almacen,s.cod_chofer,s.salida_anulada,s.cod_tipo_doc,s.fecha FROM salida_almacenes s JOIN almacenes a on a.cod_almacen=s.cod_almacen where s.cod_tiposalida=1001 ";

if($nro_proceso>0){
   $sql1.=" AND s.cod_salida_almacenes='".$nro_proceso."' ";
}else{
   $sql1.=" AND s.cod_almacen='".$cod_sucursal."' and s.nro_correlativo='".$nro_salida."' ORDER BY s.fecha desc LIMIT 1";
}

//echo $sql1;
$respRepo=mysqli_query($enlaceCon,$sql1);
while($dat1=mysqli_fetch_array($respRepo)){ 
    	$nro_proceso=$dat1[0];
      $nro_salida=$dat1[1];
      $monto=number_format($dat1[2],1,'.','')."0";
    	$nombre_almacen_destino=$dat1[3];
      $cajero=nombreVisitador($dat1[6]);
      $estado=$dat1[7];
      $fecha=$dat1[9];
      $estiloEstado="text-success";
      $tituloSalida="FACTURA VIGENTE";
      $htmlBoton="";
      $tipoFactura="F";
      $estiloTipoFac="text-muted";
      if($dat1[8]==4){
        $htmlBoton='<table class="table table-bordered table-sm">
    <tr>
      <td><p>Monto: <input type="number" name="monto_modificado" id="monto_modificado" value="'.$monto.'" class="form-control-sm" style="background:#B0F9F4;" size="15" step="any"></p></td>
    </tr>
  </table>';
        $htmlBoton.="<button type='submit' class='btn btn-danger float-center'>GUARDAR</button>";        
        $tipoFactura="(MANUAL) M";
        $estiloTipoFac="text-info";
      }
      if($estado==1){
        $tituloSalida="FACTURA ANULADA";
        $estiloEstado="text-danger";      
        $htmlBoton="";
      }
      
  ?>
  <table class="table table-bordered table-sm col-sm-12">
    <tr>
      <td><p class="text-success">Monto Total: <b><?=$monto?></b></p></td>
      <td><p class="<?=$estiloTipoFac?>">Cajero(a): <b><?=$cajero?></b></p></td>
      <td><p class="<?=$estiloEstado?>">Estado: <b><?=$tituloSalida?></b></p></td>
      <td><p class="<?=$estiloTipoFac?>">Fecha: <?=$fecha?></p></td>
    </tr>
    <tr>
      <td><p class="<?=$estiloTipoFac?>">Sucursal: <input type="text" name="almacen_nombre" id="almacen_nombre" value="<?=$nombre_almacen_destino?>" class="form-control-sm" style="background: #F4A695;" readonly size="15"></p></td>
      <td><p class="<?=$estiloTipoFac?>">Factura: <input type="text" name="factura" id="factura" value="<?=$tipoFactura?> - <?=$nro_salida?>" class="form-control-sm" style="background: #F4A695;" readonly size="15"></p></td>
      <td><p class="<?=$estiloTipoFac?>">Proceso: <input type="text" name="proceso" id="proceso" value="<?=$nro_proceso?>" class="form-control-sm" style="background: #F4A695;" readonly size="15"></p></td>
      <td></td>
    </tr>
    
  </table>  
    <?php	
    echo $htmlBoton;
}

mysqli_close($enlaceCon);
?>
<script type="text/javascript">
	$(".selectpicker").selectpicker("refresh");
</script>





