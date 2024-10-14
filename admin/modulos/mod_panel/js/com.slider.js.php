<script>
function guardar_slider()
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