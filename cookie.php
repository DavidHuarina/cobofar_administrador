<?php
$estilosVenta=0; //para no ejecutar las librerias js css
require("conexioncomercial.inc");
$usuario_adm = $_POST["usuario"];
$contrasena = $_POST["contrasena"];
//$contrasena = str_replace("'", "''", $contrasena);
$sql = "
    SELECT f.cod_cargo, f.cod_ciudad,u.codigo_funcionario
    FROM funcionarios f, usuarios_sistema u
    WHERE u.codigo_funcionario=f.codigo_funcionario AND u.usuario='$usuario_adm' AND u.contrasena='$contrasena' ";
$resp = mysqli_query($enlaceCon,$sql);
$num_filas = mysqli_num_rows($resp);
if ($num_filas != 0) {
    $dat = mysqli_fetch_array($resp);
    $cod_cargo = $dat[0];
    $cod_ciudad = $dat[1];
    $usuario = $dat[2];

    setcookie("global_usuario", $usuario,time()+3600*24*30, '/');
    setcookie("global_agencia", $cod_ciudad,time()+3600*24*30, '/');
    setcookie("global_tipo_almacen", 1,time()+3600*24*30, '/');

    if(isset($_POST["mac_pc"])){
       if($_POST["mac_pc"]!="0"&&$_POST["mac_pc"]!=""){
       	setcookie("global_mac_pc", $_POST["mac_pc"],time()+3600*24*30, '/');
       }	
    }
    

	//sacamos la gestion activa
	$sqlGestion="select cod_gestion, nombre_gestion from gestiones where estado=1";
	$respGestion=mysqli_query($enlaceCon,$sqlGestion);
	$globalGestion=mysqli_result($respGestion,0,0);
	$nombreG=mysqli_result($respGestion, 0, 1);
	
	//almacen
	$sql_almacen="select cod_almacen, nombre_almacen from almacenes where cod_ciudad='$cod_ciudad' and cod_tipoalmacen=1"; //ALMACEN MEDICAMENTOS
	//echo $sql_almacen;
	$resp_almacen=mysqli_query($enlaceCon,$sql_almacen);
	$dat_almacen=mysqli_fetch_array($resp_almacen);
	$global_almacen=$dat_almacen[0];

	setcookie("global_almacen",$global_almacen,time()+3600*24*30, '/');
	setcookie("globalGestion", $nombreG,time()+3600*24*30, '/');
	

	if($cod_ciudad==-1){ //PARA REPORTES DE ALMACEN
       setcookie("admin_central",1,time()+3600*24*30, '/');
	}else{
	   setcookie("admin_central",0,time()+3600*24*30, '/');	
	}

    $sqlAgencias = "SELECT count(cod_ciudad) FROM `funcionarios_agencias` where codigo_funcionario='$usuario';";
	$respAgencias = mysqli_query($enlaceCon,$sqlAgencias);
	$cuid = mysqli_fetch_array($respAgencias);
	header("location:index.php");
} else {
	?><script type="text/javascript">window.location.href='login.php?q=1'</script><?php
     /*echo "<link href='stilos.css' rel='stylesheet' type='text/css'>
        <form action='problemas_ingreso.php' method='post' name='formulario'>
        <h1>Sus datos de acceso no son correctos.</h1>
        <a href='index.html' class='boton'>Volver</a>
        </form>";*/
}
?>
