<?php
require "conexioncomercial.inc";
$desde=date("Y-m", strtotime('-1 month'));
$desde.="-01";
$hasta= date("Y-m-t", strtotime($desde));
?>
<div class="pcoded-content">
                      <!-- Page-header start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">COMERCIAL</h5>
                                          <p class="m-b-0">REPORTE VENTAS CANELAS</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.php"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">REPORTES</a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">VENTAS CANELAS</a>
                                          </li>
                                      </ul>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Formulario Ventas Canelas</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <form action="reportes/ventasCanelasInv.php" method="POST" target="_blank">
                                                    <div class="card-block form-material">
                                                          <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Proveedor</label>
                                                                <div class="col-sm-10">
                                                                    
                                                                
<?php
    echo "<select name='proveedor' id='proveedor' data-live-search='true' data-size='6' class='selectpicker form-control' required>";
$globalAgencia=$_COOKIE["global_agencia"];
if($_COOKIE["global_tipo_almacen"]==1){
    $sql1="select DISTINCT p.cod_proveedor, p.nombre_proveedor, pl.margen_precio from proveedores p, proveedores_lineas pl 
      where p.cod_proveedor=pl.cod_proveedor and pl.estado=1 and p.estado_activo=1 and p.cod_proveedor>0 order by 2";
}else{
    $sql1="select DISTINCT p.cod_proveedor, p.nombre_proveedor, pl.margen_precio from proveedores p, proveedores_lineas pl 
      where p.cod_proveedor=pl.cod_proveedor and p.cod_proveedor<0 order by 2";
}

    $resp=mysqli_query($enlaceCon,$sql1);
    while($dat1=mysqli_fetch_array($resp))
{   $codigo=$dat1[0];
    $nombre=$dat1[1];
  $margenPrecio=$dat1[2];//  -  ($margenPrecio)
  ?>
     <option value="<?=$codigo;?>"><?=$nombre?></option>
    <?php
}
    echo "</select>";

?>                                                                
                                                           </div>
                                                        </div>
                                                        <div class="row">                                                                                                                            
                                                            <div class="form-group row col-sm-6">
                                                                <label class="col-sm-2 col-form-label">Desde</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" id="desde" name="desde" value="<?=$desde?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row col-sm-6">
                                                                <label class="col-sm-2 col-form-label">Hasta</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" id="hasta" name="hasta" value="<?=$hasta?>"class="form-control">
                                                                </div>
                                                            </div>
                                                       </div>
                                                            <button type="submit" class="btn btn-success float-right">GENERAR REPORTE</button>                                                                                                                            
                                                       </form>
                                                            <br><br>
                                                            <div id="datosFacturaEnvio"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>