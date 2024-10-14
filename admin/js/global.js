function eliminar(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea eliminar el registro?");
}
function eliminar_imagen(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea eliminar la imagen?");
}
function eliminar_empresa(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea eliminar la Empresa?\n<strong>Advertencia: Se perder\u00E1 todo el registro enlazado con esta empresa.</strong>");
}
function vaciar_cache(url_envio)
{
	URLVar = url_envio 
	custom_confirm("\u00BFDesea vaciar la cache del sistema?");
}
function eliminar_adelanto(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea eliminar el adelanto de pago?");
}

function desconectar(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea desconectar al usuario?");
}
function restaurar(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;		
	custom_confirm("\u00BFDesea restaurar la copia de seguridad?\nAdvertencia: Se perder\u00E1 todo registro generado\ndespu\u00E9s de la fecha del backup.");
}
function FixScreen(accion, idelemento, incremento)
{
	if(document.getElementById(idelemento))
	{
		var obj=document.getElementById(idelemento); 
	/*	var max = 300 
		var min = 70 */
	
		if (obj.style.fontSize=="")
		{ obj.style.fontSize="100%"; 
		}
		
		actual=parseInt(obj.style.fontSize); 
	
		if( accion=='inicio' )
		{
			obj.style.fontSize="100%" ;
		}
	
		if( accion=='mas' && (actual+incremento))
		{
			value=actual+incremento;
			obj.style.fontSize=value+"%"
		}
		
		if( accion=='menos' && (actual+incremento))
		{
			value=actual-incremento;
			obj.style.fontSize=value+"%"
		}
	}
} 
function resolucion_pantalla()
{
	//alert(screen.width);
	if (screen.width<=1400) 
	{
		FixScreen('actual', 'element-box', 0);
		FixScreen('actual', 'header-box', 0);
		FixScreen('actual', 'ui-datepicker-div', 0);
	}
	else
	{
		FixScreen('mas', 'element-box', 15);		
		FixScreen('mas', 'header-box', 15);
		FixScreen('mas', 'ui-datepicker-div', 15);
	}
}
function mostrarOcultarDIV(id)
{
	var elem = document.getElementById(id);
	
	if(elem.style.display=='block')
	{
		elem.style.display='none';
	}
	else if(elem.style.display=='none')
	{
		elem.style.display='block';
	}
}
function DIVmore(id, url_template)
{
	var elem = document.getElementById(id);
	var img = document.getElementById('imagen_'+id);
	
	if(elem.style.display=='block')
	{
		elem.style.display='none';
		img.src = url_template+"images/iconos/mas.png"; 
		img.title = "Mostrar";
		img.alt = "Mostrar";
		
	}
	else if(elem.style.display=='none')
	{
		elem.style.display='block';
		img.src = url_template+"images/iconos/menos.png"; 
		img.title = "Ocultar";
		img.alt = "Ocultar";
		
	}
}
function oclick(url)
{
	window.location = url;	
}
function checkAll() {
	var nodoCheck = document.getElementsByTagName("input");
	var varCheck = document.getElementById("checkall").checked;
	for (i=0; i<nodoCheck.length; i++){
		if (nodoCheck[i].type == "checkbox" && nodoCheck[i].name != "checkall" && nodoCheck[i].disabled == false) {
			nodoCheck[i].checked = varCheck;
		}
	}
}
function fade_init(szDivID) {
	
	if(document.getElementById(szDivID))
	{
		var element = document.getElementById(szDivID);
		var op = 5;  // initial opacity
		var h = 30;
		
		var timer = setInterval(function () {
										  
			element.style.opacity = op;
			element.style.filter = 'alpha(opacity=' + op * 100 + ")";
			op -= op * 0.1;
			
				if (op <= 0.1){

					var timer2 = setInterval(function() {
											if (h <= 0.1)
											{
												clearInterval(timer2);
												element.style.maxHeight = 0;
												clearInterval(timer);
												//element.style.display = 'none';
											}
											h -= h * 0.2;
											element.style.filter = 'alpha(opacity=' + op * 100 + ")";
											element.style.maxHeight = h+"px";
											element.style.overflowY = 'hidden';
					},80);
					/**/
					op = 0;
				}
			
			}, 50);
	}
}
function fade(szDivID)
{
	window.setTimeout(function(){fade_init(szDivID)}, 3000);
}
function checkSubmit(e)
{
   if(e && e.keyCode == 13)
   {
		document.forms[0].submit();
   }
}
function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
	{
		custom_alert("La dirección de correo " + email + " es incorrecta.");
		return false;
	}	
}

function loading_form() // loading_form(formulario = 0)
{
	//var loader = document.getElementById('loader'); 
	//loader.innerHTML = '<div class="loader"></div>';
	/*if(formulario == 0)
	{
		capture();
	}
	else if(formulario == 1)
	{
		capture2();		
	}*/
	if( $('#guardar').length ) 
	{
		$("#guardar").attr("disabled", true);
	}
	capture();
}

function type_number()
{
	return event.charCode >= 48 && event.charCode <= 57;
}

function show_pass(url_web)
{
	if(document.getElementById('usuario_password').type == 'password')
	{
		document.getElementById('usuario_password').type = 'text';
		document.getElementById('system').innerHTML = '<i class="fa fa-eye-slash fa-lg" aria-hidden="true"></i>'; 
	}
	else
	{
		document.getElementById('usuario_password').type = 'password';
		document.getElementById('system').innerHTML = '<i class="fa fa-eye fa-lg" aria-hidden="true"></i>'; 
	}
}

/*TABS*/
function tipo_reporte(tipo)
{
	var idtipo = document.getElementById("tipo_reporte");
	idtipo.value = tipo;
	return true;
}

function tabs_switch(num_tab, operacion = 'edit', btn_funcion = '')
{
	var tabs = document.getElementById("idtab");
	var evento = document.getElementById("evento");

	tabs.value = num_tab;
	evento.value = operacion;
	if(btn_funcion != '')
	{
		if(document.getElementById("guardar"))
		{
			var funcion = document.getElementById("guardar");
			funcion.value = funcion.setAttribute( "onClick", btn_funcion );
		}
	}
	return true;
}

/*ALIAS*/

var amigable 	= 
(
	function() 
	{
		var tildes = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç&+¿?!¡.*(),_{}[]/",
			conver = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc-",
			cuerpo 	= {};
		for (var i=0, j=tildes.length; i<j; i++ )
		{
			cuerpo[tildes.charAt(i)] = conver.charAt(i);
		}
		return function(str) 
				{	
					var salida = [];
					for( var i = 0, j = str.length; i < j; i++)
					{
						var c = str.charAt( i );
						if(cuerpo.hasOwnProperty(str.charAt(i)))
						{				
							salida.push(cuerpo[c]);
						} 
						else
						{
							salida.push(c);	
						}	
					}		
					return salida.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
				}
	}
)();

function url_amigable_seo(texto, id_destino)
{
	if(document.getElementById(id_destino))
	{
		var new_alias = document.getElementById(id_destino);			
		seo = amigable(texto);
		/*custom_alert(seo);*/
		new_alias.value = seo;	
	}
}

function titulo_registro(titulo, alias = '')
{
	if(document.getElementById('titulo_registro'))
	{
		document.getElementById('titulo_registro').innerHTML = titulo.value;	
	}
	
	if(document.getElementById(alias) && alias != '')
	{
		url_amigable_seo(titulo.value, alias );
	}
}

function url_get_form(idregistro)
{
	if(document.getElementById("url_action"))
	{
		var frm = document.getElementById("form_search");
		var url_form = document.getElementById("url_action").value;
		var new_url = url_form + "/"+idregistro;
		frm.action = new_url;
	}
}
