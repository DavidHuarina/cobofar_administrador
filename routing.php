<?php
if(isset($_GET['opcion'])){
	    if ($_GET['opcion']=='pageStart') {
			require_once('layouts/homeModulo.php');
		}

		//COMERCIAL
		if ($_GET['opcion']=='listadoFacturas') {
			require_once('ventas/list.php');
		}
		if ($_GET['opcion']=='anulacionFacturas') {
			require_once('ventas/anulacion.php');
		}
		if ($_GET['opcion']=='facturasManuales') {
			require_once('ventas/manual.php');
		}
		if ($_GET['opcion']=='ventasCanelas') {
			require_once('reportes/ventasCanelas.php');
		}
}		