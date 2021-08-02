function buscarFacturaVenta(){
	var proceso=$("#nro_proceso").val();
	var factura=$("#nro_factura").val();
	var sucursal=$("#sucursal").val();
	if(proceso==''&&factura==''){
		alert("Ingresar parametros de busqueda!");	
	}else{
		var parametros={"proceso":proceso,"factura":factura,"sucursal":sucursal};
		$.ajax({
        	type: "GET",
        	dataType: 'html',
        	url: "ventas/ajaxBuscarVentasAnulacion.php",
        	data: parametros,
        	success:  function (resp) { 
           		$("#datosFacturaEnvio").html(resp);            		    	   
           		$('[data-toggle="tooltip"]').tooltip({
              		animated: 'swing', //swing expand
              		placement: 'right',
              		html: true,
              		trigger : 'hover'
         		 });
           		$(".selectpicker").selectpicker("refresh");
        	}
    	});	
	}
}