<?php
if(isset($_GET['opcion'])){
		//PLAN DE CUENTAS
		if ($_GET['opcion']=='listadoFacturas') {
			require_once('ventas/list.php');
		}
		if ($_GET['opcion']=='anulacionFacturas') {
			require_once('ventas/anulacion.php');
		}
		if ($_GET['opcion']=='facturasManuales') {
			require_once('ventas/manual.php');
		}
}		