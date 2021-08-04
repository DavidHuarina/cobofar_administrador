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
                                          <p class="m-b-0">REPORTE CAMBIO DESTINO</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.php"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">OPCIONES</a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">CAMBIO DESTINO</a>
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
                                                        <h5>Formulario Cambio Destino - Traspasos</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <form action="opciones/cambioDestinoInv.php" method="POST" id="cambioDestino">
                                                    <div class="card-block form-material">
                                                          <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Sucursal</label>
                                                                <div class="col-sm-10">
                                                                    
                                                                
<?php
    echo "<select name='sucursal' id='sucursal' data-live-search='true' data-size='6' class='selectpicker form-control' required>";
    ?><option value="0">----SELECCIONE----</option><?php
$global_tipo_almacen=$_COOKIE["global_tipo_almacen"];
$sql3="select cod_almacen, nombre_almacen from almacenes where cod_tipoalmacen='$global_tipo_almacen' order by nombre_almacen";
    $resp3=mysqli_query($enlaceCon,$sql3);
    while($dat3=mysqli_fetch_array($resp3)){
        $cod_almacen=$dat3[0];
        $nombre_almacen="$dat3[1] $dat3[2] $dat3[3]";
?>
        <option value="<?php echo $cod_almacen?>"><?php echo $nombre_almacen?></option>
<?php       
    }
    echo "</select>";

?>                                                                
                                                           </div>
                                                        </div>
                                                        <div class="row">                                                                                                                            
                                                            <div class="form-group row col-sm-12">
                                                                <label class="col-sm-2 col-form-label">Nro Salida</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" id="nro_salida" name="nro_salida" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row col-sm-12">
                                                                <label class="col-sm-2 col-form-label">Proceso</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" readonly id="nro_proceso" name="nro_proceso" class="form-control">
                                                                </div>
                                                            </div>
                                                       </div>
                                                       <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Destino</label>
                                                                <div class="col-sm-10">
                                                                    
                                                                
<?php
    echo "<select name='destino' id='destino' data-live-search='true' data-size='6' class='selectpicker form-control' required>";
    ?><option value="0">----SELECCIONE----</option><?php
$global_tipo_almacen=$_COOKIE["global_tipo_almacen"];
$sql3="select cod_almacen, nombre_almacen from almacenes where cod_tipoalmacen='$global_tipo_almacen' order by nombre_almacen";
    $resp3=mysqli_query($enlaceCon,$sql3);
    while($dat3=mysqli_fetch_array($resp3)){
        $cod_almacen=$dat3[0];
        $nombre_almacen="$dat3[1] $dat3[2] $dat3[3]";
?>
        <option value="<?php echo $cod_almacen?>"><?php echo $nombre_almacen?></option>
<?php       
    }
    echo "</select>";

?>                                                                
                                                           </div>
                                                        </div>



                                                        
                                                        <a href="#" class="btn btn-success float-right" onclick="buscarSalidaDocumento()">BUSCAR DOCUMENTO</a>

                                                        <br><br>  
                                                        <div id="respuesta">
                                                            

                                                        </div>                                                                                                                      
                                                       </form>
                                                            
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