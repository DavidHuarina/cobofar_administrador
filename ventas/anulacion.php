<?php
require "conexioncomercial.inc";

?>
<div class="pcoded-content">
                      <!-- Page-header start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">COMERCIAL</h5>
                                          <p class="m-b-0">LISTADO DE FACTURAS</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.php"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">FACTURAS</a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">ANULACION DE FACTURAS</a>
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
                                                        <h5>Formulario Anulación Facturas</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <div class="card-block form-material">
                                                            <div class="form-group form-default">
<?php
    echo "<select name='sucursal' id='sucursal' data-live-search='true' data-size='6' class='selectpicker form-control' required>";
$globalAgencia=$_COOKIE["global_agencia"];
    if($_COOKIE["admin_central"]==1){
       $sql="select cod_ciudad, descripcion from ciudades where cod_ciudad>0 order by descripcion";    
    }else{
       
       $sql="select cod_ciudad, descripcion from ciudades where cod_ciudad>0 and cod_ciudad='$globalAgencia' order by descripcion";
    }
    echo "<option value='0'>Todas las Sucursales</option>"; 
    $resp=mysqli_query($enlaceCon,$sql);
    while($dat=mysqli_fetch_array($resp))
    {   $codigo_ciudad=$dat[0];
        $nombre_ciudad=$dat[1];
        echo "<option value='$codigo_ciudad'>$nombre_ciudad</option>";       
    }
    echo "</select>";

?>                                                                
                                                            </div>
                                                            <div class='row'>
                                                              <div class="form-group form-default col-sm-6">
                                                                <input type="text" name="nro_proceso" id="nro_proceso" class="form-control" required="">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Proceso</label>
                                                              </div>
                                                              <div class="form-group form-default col-sm-6">
                                                                <input type="text" id="nro_factura" name="nro_factura" class="form-control" required="">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Nro Factura</label>
                                                              </div> 
                                                              <?php
                                                              echo "<select name='rpt_personal$codigo' id='rpt_personal$codigo' class='selectpicker' data-live-search='true' data-size='4' data-style='btn btn-primary btn-sm'>"; 
$globalFuncionario=$_COOKIE["global_usuario"];
$globalCiudad=$_COOKIE["global_agencia"];
$sql="SELECT codigo_funcionario,CONCAT(nombres,' ',materno,' ',paterno)personal FROM funcionarios WHERE codigo_funcionario!='-1' order by nombres,materno,paterno";  
  $resp=mysqli_query($enlaceCon,$sql);
  echo "<option value='' selected>--SELECCIONE PERSONAL--</option>";
  while($dat=mysqli_fetch_array($resp))
  { $codigo_funcionario=$dat[0];
    $nombre_funcionario=$dat[1];
    $ci=$dat[2];
    if($globalFuncionario==$codigo_funcionario){
       echo "<option value='$codigo_funcionario' selected>$nombre_funcionario</option>";  
    }else{
      echo "<option value='$codigo_funcionario'>$nombre_funcionario</option>";        
    }
  }
  echo "</select>";
                                                              ?>                                                               
                                                            </div>
                                                            <a href='#' onclick="buscarFacturaVenta()" class="btn btn-info float-right">BUSCAR VENTA</a>

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