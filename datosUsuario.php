<?php
	require("conexioncomercial.inc");
	$global_usuario=$_COOKIE['global_usuario'];
	$global_agencia=$_COOKIE['global_agencia'];
	$sql = "select paterno, materno, nombres, cod_ciudad from funcionarios where codigo_funcionario=$global_usuario";
	$resp = mysqli_query($enlaceCon,$sql);
	$dat = mysqli_fetch_array( $resp );
	$paterno = $dat[ 0 ];
	$materno = $dat[ 1 ];
	$nombre = $dat[ 2 ];	
	$nombreUsuarioSesion = "$paterno $nombre";

	$sql = "select descripcion from ciudades where cod_ciudad=$global_agencia";
	$resp = mysqli_query($enlaceCon,$sql);
	$dat = mysqli_fetch_array( $resp );
	$nombreAgenciaSesion = $dat[ 0 ];
	
	$sql_almacen="select cod_almacen, nombre_almacen from almacenes where cod_almacen='$global_almacen'";
	$resp_almacen=mysqli_query($enlaceCon,$sql_almacen);
	$dat_almacen=mysqli_fetch_array($resp_almacen);
	$nombreAlmacenSesion=$dat_almacen[1];
	
	
	$sqlNombreEmpresa="select nombre from datos_empresa where cod_empresa=1";
	$respNombreEmpresa=mysqli_query($enlaceCon,$sqlNombreEmpresa);
	$datNombreEmpresa=mysqli_fetch_array($respNombreEmpresa);
	$nombreEmpresa=$datNombreEmpresa[0];

	$sql_tipo_almacen="select codigo, abreviatura from tipos_almacenes where codigo='$global_tipo_almacen'";
	$resp_tipo_almacen=mysqli_query($enlaceCon,$sql_tipo_almacen);
	$dat_tipo_almacen=mysqli_fetch_array($resp_tipo_almacen);
	$nombreTipoAlmacen=$dat_tipo_almacen[1];

	date_default_timezone_set('America/La_Paz');
	$fechaSistemaSesion = date( "d-m-Y" );
	$horaSistemaSesion = date( "H:i" );


	$sqlImagen = "select imagen from usuarios_sistema where codigo_funcionario=$global_usuario";
	$respImagen = mysqli_query($enlaceCon,$sqlImagen);
	$datImagen = mysqli_fetch_array( $respImagen );
	$imagenLogin = $datImagen[ 0 ];
	if($imagenLogin==""){
        $imagenLogin="assets/images/user.png";
	}

?>
