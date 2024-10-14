<script>
function guardar_menu()
{
	var menu = document.getElementById("menu");
	var tipo =  document.getElementById("tipo");
	var menu_princ = document.getElementById("menu_princ");
	var categoria = document.getElementById("categoria");
	var subcategoria = document.getElementById("subcategoria");
	var estado = document.getElementById("estado");
	var ruta = document.getElementById("url");
	
	
	if(menu.value=='')
		{
			alerta('Ingrese el nombre del menú', menu);
			return false;
		}
	if(menu_princ.value=='' || menu_princ.value==0)
		{
			alerta('Seleccione el menú principal', menu_princ);
			return false;
		}
	if(tipo.value==3)
		{
			/*CATEGORIA*/
			if(categoria.value=='' || categoria.value==0)
			{
				alerta('Seleccione una categoria', categoria);
				return false;
			}
			/*SUBCATEGORIA*/
			if(subcategoria.value=='' || subcategoria.value==0)
			{
				alerta('Seleccione una subcategoria', subcategoria);
				return false;
			}		
		}
	if(tipo.value==4)
		{
			/*CATEGORIA*/
			if(categoria.value=='' || categoria.value==0)
			{
				alerta('Seleccione una categoria', categoria);
				return false;
			}				
		}
	if(tipo.value!=1)
		{
			if(ruta.value=='')
			{
				alerta('Seleccione una ruta', ruta);
				return false;			
			}
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