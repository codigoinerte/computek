<script>
function guardar_pagina()
{
	var nombre = document.getElementById("nombre");
	var pagina =  document.getElementById("pagina");
		
	if(nombre.value=='')
	{
		alerta('Ingrese el nombre de la página', nombre);
		return false;
	}
	if(pagina.value=='')
	{
		alerta('Ingrese el nombre del archivo', pagina);
		return false;
	}
	document.forms[0].submit();
	return true;	
}
</script>