<script>
function guardar_usuario()
{
	var nombre = document.getElementById("nombre");
	var usuario =  document.getElementById("usuario");
	
	if(nombre.value=='')
		{
			alerta('Ingrese el nombre del usuario', nombre);
			return false;
		}
	if(usuario.value=='')
		{
			alerta('Ingrese el nombre de usuario de login', usuario);
			return false;
		}

	
	document.forms[0].submit();
	return true;
}
function cargar_datos_info(selected_val, display_value, ruta, userid)	
{
		var cant = document.getElementById("num_datos").value;
		var value_tipo_info = document.getElementById("tipo_info").value;
	
		var selectable = document.getElementById("selectable");
		if(selectable.value=='')
		{			
			alerta('Seleccione un tipo de información', selectable);
			return false;
		}
	
		$.post(ruta, { idtipo: selectable.value, canti: cant, valor_tipo:value_tipo_info }, function(htmlexterno)
		{
			$(htmlexterno).appendTo( "#"+display_value );
		});	
		
		cant=parseInt(parseInt(cant)+1);
		document.getElementById("num_datos").value = cant;
}	
function eliminar_data_info(id)	
{
	$("#"+id).remove();
}
// toggle password visibility
$(document).ready(function() {
    $("#show_hide_password .input-group-addon").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>