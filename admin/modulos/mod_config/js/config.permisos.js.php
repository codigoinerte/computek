<script>
function guardar_permiso()
{	
	var tipo =  document.getElementById("tipo");	
	
	if(tipo.value=='')
	{
		alerta('Ingrese el nombre del tipo de permiso', tipo);
		return false;
	}
	
	document.forms[0].submit();
	return true;
}
</script>