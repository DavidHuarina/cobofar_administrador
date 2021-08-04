<?php
require_once '../layouts/bodylogin2.php';
require_once '../conexioncomercial.inc';
require_once '../functions.php';

$tituloReporte="Ventas Canelas";
$desde=$_POST["desde"];
$hasta=$_POST["hasta"];
$proveedor=$_POST["proveedor"];
$nombreProv=obtenerNombreProveedor($proveedor);
?>
<div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
    
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <div class="">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><?=$tituloReporte?></h5>
                                            <p class="m-b-0">Proveedor : <?=$nombreProv?></p>
                                            <p class="m-b-0">Desde : <?=$desde?></p>
                                            <p class="m-b-0">Hasta : <?=$hasta?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Basic table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?=$tituloReporte?></h5>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-sm small table-bordered">
                                                        <thead>
                                                            <tr class='bg-primary'>
                                                                <th>PASO</th>
                                                                <th>NOMBRE</th>
                                                                <th>CPROD</th>
                                                                <th>DES</th>
                                                                <th>CAJAS</th>
                                                                <th>SUELTAS</th>
                                                                <th>MONTO</th>
                                                                <th>SUCURSAL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	<?php
$sql1="SELECT s.cod_chofer,f.nombres,sd.cod_material,m.descripcion_material,sum(sd.cantidad_envase),sum(sd.cantidad_unitaria),sum(sd.monto_unitario),a.nombre_almacen 
FROM salida_detalle_almacenes sd
JOIN salida_almacenes s on s.cod_salida_almacenes=sd.cod_salida_almacen
join material_apoyo m on m.codigo_material=sd.cod_material
join almacenes a on a.cod_almacen=s.cod_almacen
join funcionarios f on f.codigo_funcionario=s.cod_chofer
where s.salida_anulada!=1 and s.cod_tiposalida='1001'
and s.fecha BETWEEN '$desde' AND '$hasta' and m.cod_linea_proveedor in (SELECT cod_linea_proveedor from proveedores_lineas where cod_proveedor='$proveedor')
GROUP BY s.cod_chofer, f.nombres, sd.cod_material, m.descripcion_material, a.nombre_almacen;
";
     $respRepo=mysqli_query($enlaceCon,$sql1);
   while($dat1=mysqli_fetch_array($respRepo))
    {  

    	$cod_chofer=$dat1[0];
    	$nombres=$dat1[1];
    	$cod_material=$dat1[2];
    	$descripcion_material=$dat1[3];
    	$cantidad_envase=$dat1[4];
    	$cantidad_unitaria=$dat1[5];
    	$monto_unitario=$dat1[6];
    	$nombre_almacen=$dat1[7];
      ?>
      <tr>
      	<td><?=$cod_chofer?></td>
      	<td><?=$nombres?></td>
      	<td><?=$cod_material?></td>
      	<td><?=$descripcion_material?></td>
      	<td><?=$cantidad_envase?></td>
      	<td><?=$cantidad_unitaria?></td>
      	<td><?=$monto_unitario?></td>
      	<td><?=$nombre_almacen?></td>
      </tr>
      <?php
    }


                                                        	?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>