<script>
function guardar_subcategoria_articulo()
{
	var nombre = document.getElementById("nombre");
	var categoria = document.getElementById("categoria");
	var alias = document.getElementById("alias");	
	
	if(nombre.value=='')
	{
		alerta('Ingrese el nombre de la subcategoria', nombre);
		return false;
	}
	if(categoria.value=='')
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