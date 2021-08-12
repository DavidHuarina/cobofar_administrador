<?php
require "conexioncomercial.inc";
$sql="select count(*) from salida_almacenes where cod_tiposalida=1001;";
$resp=mysqli_query($enlaceCon,$sql);
$total_ventas=mysqli_result($resp,0,0);

$sql="select count(*) from salida_almacenes where cod_tiposalida=1001 and cod_tipopago=1;";
$resp=mysqli_query($enlaceCon,$sql);
$total_efectivo=mysqli_result($resp,0,0);

$sql="select count(*) from salida_almacenes where cod_tiposalida=1001 and cod_tipopago!=1;";
$resp=mysqli_query($enlaceCon,$sql);
$total_tarjeta=mysqli_result($resp,0,0);

$sql="select count(*) from salida_almacenes where cod_tiposalida=1001 and salida_anulada=1;";
$resp=mysqli_query($enlaceCon,$sql);
$total_anuladas=mysqli_result($resp,0,0);




$por_total_efectivo=($total_efectivo*100)/$total_ventas;
$por_total_tarjeta=($total_tarjeta*100)/$total_ventas;
$por_total_anuladas=($total_anuladas*100)/$total_ventas;


$por_total_efectivo=number_format($por_total_efectivo,0,'','');
$por_total_tarjeta=number_format($por_total_tarjeta,0,'','');
$por_total_anuladas=number_format($por_total_anuladas,0,'','');
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
                                          <li class="breadcrumb-item"><a href="#!">LISTADO DE FACTURAS</a>
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
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-purple"><?=$total_ventas?></h4>
                                                                <h6 class="text-muted m-b-0">Total Ventas</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-bar-chart f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">100%</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-line-chart text-white f-16"></i>
                                                            </div>
                                                        </div>
            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green"><?=$total_efectivo?></h4>
                                                                <h6 class="text-muted m-b-0">Ventas Efectivo</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-money f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0"><?=$por_total_efectivo?>%</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-line-chart text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-red"><?=$total_anuladas?></h4>
                                                                <h6 class="text-muted m-b-0">Ventas Anuladas</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-trash f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0"><?=$por_total_anuladas?>%</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-line-chart text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?=$total_tarjeta?></h4>
                                                                <h6 class="text-muted m-b-0">Ventas Con Tarjeta</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-credit-card f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0"><?=$por_total_tarjeta?>%</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-card text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                    <p>Estamos trabajando en ello</p>
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>