<script>
	function cargar_categoria(value_categoria, idsubcategoria, ruta, value_active)
	{
		$.post(ruta, { idcat: value_categoria, value: value_active }, function(htmlexterno)
		{
			$("#"+idsubcategoria+" option").remove();
			$("#"+idsubcategoria).append(htmlexterno);
			
		});
	}
	function guardar_articulo()
	{
		var nombre = document.getElementById("nombre");
		var categoria = document.getElementById("categoria");
		var alias = document.getElementById("alias");	

		if(nombre.value=='')
		{
			alerta('Ingrese el nombre del registro', nombre);
			return false;
		}
		if(categoria.value=='' || categoria.value==0)
		{
			alerta('Seleccione la categoria del registro', categoria);
			return false;
		}
		if(alias.value=='')
		{
			alerta('Ingrese el alias del registro', alias);
			return false;
		}
		document.forms[0].submit();
		return true;		
	}
</script>