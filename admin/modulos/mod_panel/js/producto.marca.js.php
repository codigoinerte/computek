<script>
	function guardar_marca_producto()
	{
		var marca = document.getElementById("marca");

		if(marca.value=='')
		{
			alerta('Ingrese el nombre de la marca', marca);
			return false;
		}
		document.forms[0].submit();
		return true;		
	}
</script>