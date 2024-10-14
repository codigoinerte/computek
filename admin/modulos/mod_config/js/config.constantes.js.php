<script>
	function guardar_constante()
	{
		var nombre = document.getElementById("nombre");
		var constante = document.getElementById("constante");
		var valor = document.getElementById("valor");

		if(nombre.value=='')
		{
			alerta('Ingrese el nombre de la constante', nombre);
			return false;
		}
		if(constante.value=='')
		{
			alerta('Ingrese la constante', constante);
			return false;
		}
		if(valor.value=='')
		{
			alerta('Ingrese el valor de la constante', valor);
			return false;
		}
		
		document.forms[0].submit();
		return true;		
	}
</script>