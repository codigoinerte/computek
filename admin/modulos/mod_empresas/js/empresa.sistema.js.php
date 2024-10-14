<script>
function cargar_datos_info(selected_val, display_value, ruta, userid)	
{
		var cant = document.getElementById("num_datos").value;
		var value_tipo_info = document.getElementById("tipo_info").value;
	
		var selectable = document.getElementById("selectable");
		if(selectable.value=='')
		{			
			alerta('Seleccione un tipo de información', selectable);
			return false;
		}
	
		$.post(ruta, { idtipo: selectable.value, canti: cant, valor_tipo:value_tipo_info }, function(htmlexterno)
		{
			$(htmlexterno).appendTo( "#"+display_value );
		});	
		
		cant=parseInt(parseInt(cant)+1);
		document.getElementById("num_datos").value = cant;
}	
function eliminar_data_info(id)	
{
	$("#"+id).remove();
}
function guardar_empresa_sistema()
{
	var empresa = document.getElementById("empresa");
	var representante =  document.getElementById("representante");
	
	if(empresa.value=='')
	{
		alerta('Ingrese el nombre de la empresa', empresa);
		return false;
	}
	if(representante.value=='')
	{
		alerta('Seleccione el representante de la empresa', representante);
		return false;
	}

	
	document.forms[0].submit();
	return true;
	
}
</script>