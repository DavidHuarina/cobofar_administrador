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


$(document).ready(function() {	
	//SUBMITS
	$("#cambioDestino").submit(function(e) {
      if($("#sucursal").val()>0){
        if($("#nro_salida").val()==""&&$("#nro_proceso").val()==""){
        	alert("Debe ingresar el nro de salida o proceso!");
        	//Swal.fire("Informativo!", "Debe ingresar el nro de salida o proceso!", "warning");
        	return false;
        }else{
        	if($("#destino").val()>0){

        	}else{
        		alert("Debe seleccionar la sucursal destino!");
        		//Swal.fire("Informativo!", "Debe seleccionar la sucursal destino", "warning");
        		return false;
        	}
        }	
      }else{
      	alert("Debe seleccionar la Sucursal!");
        //Swal.fire("Informativo!", "Debe seleccionar la Sucursal!", "warning");
        return false;
      }     
    });
  $("#cambioMontoFacturaManual").submit(function(e) {
      if($("#proceso").length>0){
        if($("#proceso").val()>0){
              
          }else{
            alert("No existe la Factura!");
            return false;
          }
      }else{
        alert("Factura invalida!");
        return false;
      }     
    });
});

function buscarSalidaDocumento(){
	//alert("hola");
      if($("#sucursal").val()>0){
        if($("#nro_salida").val()==""){
        	alert("Debe ingresar el nro de salida o proceso!");
        	//Swal.fire("Informativo!", "Debe ingresar el nro de salida o proceso!", "warning");
        	return false;
        }else{
        	buscarSalidaDocumentoAjax();
        }	
      }else{
      	alert("Debe seleccionar la Sucursal!");
        //Swal.fire("Informativo!", "Debe seleccionar la Sucursal!", "warning");
        return false;
      }
}

function buscarSalidaDocumentoAjax(){
	var cod_sucursal=$("#sucursal").val();
	var nro_salida=$("#nro_salida").val();
	var parametros={"cod_sucursal":cod_sucursal,"nro_salida":nro_salida};
  $.ajax({
        type: "GET",
        dataType: 'html',
        url: "opciones/ajaxBuscarDocumentoSalida.php",
        data: parametros,
        success:  function (resp) {
          $("#respuesta").html(resp);
        }
  });   

}

function buscarFacturaDestino(){
	var cod_sucursal=$("#sucursal").val();
	var nro_salida=$("#nro_salida").val();
	var nro_proceso=$("#nro_proceso").val();
	var parametros={"cod_sucursal":cod_sucursal,"nro_salida":nro_salida,"nro_proceso":nro_proceso};
  $.ajax({
        type: "GET",
        dataType: 'html',
        url: "opciones/ajaxBuscarFacturaManual.php",
        data: parametros,
        success:  function (resp) {
          $("#respuesta").html(resp);
        }
  });  
}