<script>
function guardar_categoria_articulo()
{
	var nombre = document.getElementById("nombre");
	var pagina = document.getElementById("pagina");
	var alias = document.getElementById("alias");	
	
	if(nombre.value=='')
	{
		alerta('Ingrese el nombre de la categoria', nombre);
		return false;
	}
	if(pagina.value=='')
	{
		alerta('Seleccione la pagina del registro', pagina);
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