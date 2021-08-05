<?php
function obtenerValorConfiguracionComercial($id){
	$estilosVenta=1;
	require("conexioncomercial.inc");
	$sql = "SELECT valor_configuracion from configuraciones c where id_configuracion=$id";
	$resp=mysqli_query($enlaceCon,$sql);
	$codigo=0;
	while ($dat = mysqli_fetch_array($resp)) {
	  $codigo=$dat['valor_configuracion'];
	}
	return($codigo);
}

function obtenerNombreProveedor($id){
	$estilosVenta=1;
	require("conexioncomercial.inc");
	$sql = "SELECT nombre_proveedor from proveedores c where cod_proveedor=$id";
	$resp=mysqli_query($enlaceCon,$sql);
	$codigo=0;
	while ($dat = mysqli_fetch_array($resp)) {
	  $codigo=$dat['nombre_proveedor'];
	}
	return($codigo);
}
function nombreVisitador($codigo)
{	require("conexioncomercial.inc");
$sql="select concat(paterno,' ',nombres) from funcionarios where codigo_funcionario='$codigo'";
	$resp=mysqli_query($enlaceCon,$sql);
	$nombre=mysqli_result($resp,0,0);
	return($nombre);
}
