<?php
$codModulo=$_COOKIE['modulo'];
switch ($codModulo) {
  case 1:
   $nombreModulo="COMERCIAL";
   $cardTema="card-themes";
   $iconoTitulo="local_atm";
   $estiloHome="#DC5143";
   $fondoModulo="fondo-dashboard-recursoshumanos";
  break;
  case 2:
   $nombreModulo="ALMACENES";
   $cardTema="card-snippets";
   $iconoTitulo="home_work";
   $estiloHome="#DCB943";
   $fondoModulo="fondo-dashboard-activos";
  break;
  case 3:
   $nombreModulo="FINANCIERO";
   $cardTema="card-templates";
   $iconoTitulo="insert_chart_outlined";
   $estiloHome="#1B82DD";
   $fondoModulo="fondo-dashboard-contabilidad";
  break;
  case 4:
   $nombreModulo="PAGINA WEB";
   $cardTema="card-guides";
   $iconoTitulo="list_alt";
   $estiloHome="#4FA54F";
   $fondoModulo="fondo-dashboard-solicitudes";
  break;
}

?>
<section class="after-loop">
  <div class="container">
    <div class="div-center text-center">
      
     
     <img src="assets/images/farmacias_bolivia_loop.gif" width="500" height="150" alt="">
      
       <h3><b><FONT>Modulo <?=$nombreModulo?></FONT></b></h3>
       <p>Proveemos un servicio de calidad plasmado en trabajo Íntegro y de Honor hacia la sociedad.</p>
      <p>
        <a href="index.php" class="btn btn-lg" style="background-color: #FA5C3A;color:#fff; ">IR A LA PAGINA DE INICIO</a>
      </p>     
    </div>
  </div>
</section>