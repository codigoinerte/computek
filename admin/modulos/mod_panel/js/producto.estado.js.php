<script>
	function guardar_estado_producto()
	{
		var estado = document.getElementById("estado");

		if(estado.value=='')
		{
			alerta('Ingrese el nombre del estado', estado);
			return false;
		}
		document.forms[0].submit();
		return true;		
	}
</script>