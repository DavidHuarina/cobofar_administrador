<div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
         <th>Proceso</th>
         <th>Factura</th>
         <th>Fecha</th>
         <th>Monto</th>
         <th>Rs</th>
         <th>Nit</th>
         <th>Caja Anulación</th>
         <th></th>
      </tr>
      </thead>
      <tbody>
<?php
$estilosVenta=1;
require("../conexioncomercial.inc");
require("../funcionescomercial.php");

$proceso=$_GET['proceso'];
$factura=$_GET['factura'];
$sucursal=$_GET['sucursal'];
$querySucursal="";
if($sucursal>0){
	$almacen=obtenerCodigoAlmacenPorCiudad($sucursal);
	$querySucursal=" AND s.cod_almacen = '$almacen' ";
}





$consulta = "
    SELECT s.cod_salida_almacenes, s.fecha, s.hora_salida, ts.nombre_tiposalida, 
    (select a.nombre_almacen from almacenes a where a.`cod_almacen`=s.almacen_destino), s.observaciones, 
    s.estado_salida, s.nro_correlativo, s.salida_anulada, s.almacen_destino, 
    (select c.nombre_cliente from clientes c where c.cod_cliente = s.cod_cliente), s.cod_tipo_doc, razon_social, nit,s.cod_tipopago,s.monto_final,(SELECT count(*) from registro_depositos where cod_funcionario=s.cod_chofer and CONCAT(s.fecha,' ',s.hora_salida) BETWEEN CONCAT(fecha,' ',hora,':00') and CONCAT(fechaf,' ',horaf,':00') and cod_estadoreferencial=1)AS depositado,(SELECT cod_medico from recetas_salidas where cod_salida_almacen=s.cod_salida_almacenes LIMIT 1)cod_medico,monto_cancelado_usd
    FROM salida_almacenes s, tipos_salida ts 
    WHERE s.cod_tiposalida = ts.cod_tiposalida $querySucursal and s.cod_tiposalida=1001 ";

if($proceso>0){
  $consulta = $consulta."AND s.cod_salida_almacenes='$proceso' ";
}else{

if($factura!="")
   {$consulta = $consulta."AND s.nro_correlativo='$factura' ";
   }

}
$consulta = $consulta."ORDER BY s.fecha desc, s.nro_correlativo DESC";

//
$resp = mysqli_query($enlaceCon,$consulta);
//echo $consulta;
	
while ($dat = mysqli_fetch_array($resp)) {
    $codigo = $dat[0];
    $fecha_salida = $dat[1];
    $fecha_salida_mostrar = "$fecha_salida[8]$fecha_salida[9]-$fecha_salida[5]$fecha_salida[6]-$fecha_salida[0]$fecha_salida[1]$fecha_salida[2]$fecha_salida[3]";
    $hora_salida = $dat[2];
    $nombre_tiposalida = $dat[3];
    $nombre_almacen = $dat[4];
    $obs_salida = $dat[5];
    $estado_almacen = $dat[6];
    $nro_correlativo = $dat[7];
    $salida_anulada = $dat[8];
    $cod_almacen_destino = $dat[9];
    $nombreCliente=$dat[10];
    $codTipoDoc=$dat[11];
    $razonSocial=$dat[12];
    $nitCli=$dat[13];
    $depositado=$dat['depositado'];
    $codMedico=$dat['cod_medico'];
    $montoCanceladoUSD=$dat['monto_cancelado_usd'];
    $montoFactura=number_format($dat['monto_final'],1,'.',',')."0";
    $fechaValidacion=0;
    if($fechaValidacion){
        $fechaValidacion=1;
    }

    $fecha_actual = strtotime(date("Y-m-d H:i:00",time()));
    $fecha_entrada = strtotime($fecha_salida." ".$hora_salida." + 1 days");    
    if($fecha_actual > $fecha_entrada){
        $fechaValidacion=1;     
    }



    $anio_salida=intval("$fecha_salida[0]$fecha_salida[1]$fecha_salida[2]$fecha_salida[3]");
    if(!isset($_COOKIE["globalGestion"])){
      $globalGestionActual= date("Y");  
    }else{
      $globalGestionActual = intval($_COOKIE["globalGestion"]);    
    }
    
    echo "<input type='hidden' name='fecha_salida$nro_correlativo' value='$fecha_salida_mostrar'>";
    
    $sqlEstadoColor="select color from estados_salida where cod_estado='$estado_almacen'";
    $respEstadoColor=mysqli_query($enlaceCon,$sqlEstadoColor);
    $numFilasEstado=mysqli_num_rows($respEstadoColor);
    if($numFilasEstado>0){
        $color_fondo=mysqli_result($respEstadoColor,0,0);
    }else{
        $color_fondo="#ffffff";     
    }   
    $chk = "<input type='checkbox' name='codigo' value='$codigo'>";

    if ($anio_salida != $globalGestionActual) {
        $chk = "";
    }
    
     if(!isset($estado_preparado)){
      $estado_preparado= "";  
    }
    if($codTipoDoc==4){
        $nro_correlativo="<i class=\"text-danger\">M-$nro_correlativo</i>";
    }else{
        $nro_correlativo="F-$nro_correlativo";
    }
    $colorReceta="#14982C";
    if($codMedico==""){
      $codMedico=0;         
    }
    if($codMedico==0){
        $colorReceta="#652BE9"; 
    }
    
    echo "<input type='hidden' name='estado_preparado' value='$estado_preparado'>";
    echo "<tr>";
    echo "<td align='center'>P-$codigo</td>";
    echo "<td align='center'><b>$nro_correlativo</b></td>";
    echo "<td align='center'>$fecha_salida_mostrar $hora_salida</td>";
    echo "<td align='right'><b>$montoFactura</b></td>";
    echo "<td>&nbsp;$razonSocial</td><td>&nbsp;$nitCli</td><td>";
    echo "</td>";
    $codTarjeta=$dat['cod_tipopago'];
    if($codTarjeta==2){
        echo "<td class='text-primary'><b>Tarjeta</b></td>";
    }else{
        echo "<td class='text-success'><b>Efectivo</b></td>";
    }  
    $nroImpresiones=obtenerNumeroImpresiones($codigo);  
    if($codTipoDoc==1){
        $htmlTarjeta="";
        $htmlReceta="";
        $htmlImpresion="";
      $htmlImpresion="<a href='formatoFactura.php?codVenta=$codigo' target='_BLANK' title='<b>IMPRIMIR FACTURA</b><br>$nro_correlativo<br><img src=\"assets/images/print.png\" width=\"60\" border=\"0\"><span class=\"badge badge-secondary\">R: $nroImpresiones </span>' data-toggle='tooltip'><img src='assets/images/print.png' width='30' border='0'></a>";  
        echo "<td  bgcolor='$color_fondo'>$htmlReceta $htmlTarjeta $htmlImpresion <a href='dFactura.php?codigo_salida=$codigo' target='_BLANK' title='<b>DETALLE DE FACTURA</b><br>$nro_correlativo<br><img src=\"assets/images/fac_detalle.png\" width=\"60\" border=\"0\">' data-toggle='tooltip'><img src='assets/images/fac_detalle.png' width='30' border='0'></a>";
        echo "</td>";
        /*<a href='formatoFacturaExtendido.php?codVenta=$codigo' target='_BLANK'><img src='assets/images/factura1.jpg' width='30' border='0' title='Factura Extendida'></a>*/
    }
    
    
    echo "</tr>";
}
?> 
    </tbody>
  </table>
</div>