<script>
function guardar_modulos()
{
	var nombre = document.getElementById("nombre");	
		
	if(nombre.value=='')
	{
		alerta('Ingrese el nombre de la página', nombre);
		return false;
	}
	
	document.forms[0].submit();
	return true;	
}
</script>