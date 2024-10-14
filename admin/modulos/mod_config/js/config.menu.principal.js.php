<script>
function guardar_menu_principal()
{
	var menu = document.getElementById("menu");
	var estado = document.getElementById("estado");
	
	if(menu.value=='')
		{
			alerta('Ingrese el nombre del menú', menu);
			return false;
		}
	if(estado.value=='' || estado.value==0)
		{
			alerta('Seleccione un estado', estado);
			return false;
		}
	document.forms[0].submit();
	return true;		
}
</script>