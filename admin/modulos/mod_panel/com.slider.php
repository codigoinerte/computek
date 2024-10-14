<?php
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.com.pagina.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.php";

$datos_registro = new registro();
$datos_menu_principal = new menu_principal();
$datos_pagina = new pagina();

$array_menu_estado = $datos_menu->listar_menu_estado();
$array_paginas = $datos_pagina->listar_paginas();

$url_guardar = "guardar_slider();";
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/com.slider.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";
$tipo_registro=12;
$listado_registro = $datos_registro->registro_detalle($get_id);
#print_r($listado_registro);
if(count($listado_registro) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_nombre = "";
	$item_url = "";
	$item_alias = "";
	$item_imagen = "";
	$item_resumen = "";
	$item_descripcion = "";
	$item_orden = 0;
	$item_idtipo = 0;
	$item_idestado = 1;
	$item_iddestacado = 0;
	$item_idpagina = 0;
	$item_seo_titulo = "";
	$item_seo_keywords = "";
	$item_seo_descripcion = "";
	
	$item_usuario = "";
	$item_usuario_nombres = "";
	$item_fecha_creacion = fecha_castellano($fecha_ahora);
	$item_fecha_modificacion = fecha_castellano($fecha_ahora);
}
else
{
	$item_nombre = $listado_registro[0]["nombre"];
	$item_url = $listado_registro[0]["url"];
	$item_alias = $listado_registro[0]["alias"];
	$item_imagen = $listado_registro[0]["imagen"];
	$item_resumen = $listado_registro[0]["resumen"];
	$item_descripcion = $listado_registro[0]["descripcion"];
	$item_orden = $listado_registro[0]["orden"];
	$item_idtipo = $listado_registro[0]["idtipo"];
	$item_idestado = $listado_registro[0]["idestado"];
	$item_iddestacado = $listado_registro[0]["iddestacado"];
	$item_idpagina = $listado_registro[0]["id_pagina"];
	$item_seo_titulo = $listado_registro[0]["so_titulo"];
	$item_seo_keywords = $listado_registro[0]["seo_keywords"];
	$item_seo_descripcion = $listado_registro[0]["seo_descripcion"];
	
	$item_usuario = $listado_registro[0]["usuario"];
	$item_usuario_nombres = $listado_registro[0]["nombre_personal"];
	$item_fecha_creacion = fecha_castellano($listado_registro[0]["fecha_creacion"]);
	$item_fecha_modificacion = fecha_castellano($listado_registro[0]["fecha_modificacion"]);
	
}

$listado_iconos = $datos_registro->listado_iconos();
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Slider</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_panel/ajax/listado.com.slider.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	

      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		       
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Resumen</a></li>
			<li role="presentation"><a href="#block-2" aria-controls="block-2" role="tab" data-toggle="tab">Descripci&oacute;n</a></li>
			<li role="presentation"><a href="#block-3" aria-controls="block-3" role="tab" data-toggle="tab">Im&aacute;genes</a></li>			
			<li role="presentation"><a href="#block-5" aria-controls="block-5" role="tab" data-toggle="tab">Registro</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="block-1">
				
			<!---==============================================================--->

			  <div class="panel panel-default panel-form">
				<div class="bg-info panel-heading font-bold ">
				  Detalle
				</div>
				<div class="panel-body" >
					<?php 						
						layers(1, "Nombre", "nombre", "Ingrese el nombre de la categoría", "", $item_nombre);
						layers(1, "URL", "url", "Ingrese la url del registro", "", $item_url); 						
 						layers(1, "Orden", "orden", "Ingrese numero de orden del registro", "", $item_orden); 
						layers(2, "Estado", "estado", "Seleccione el estado del registro", $array_menu_estado, $item_idestado); 
						layers(13, "Solo Imagen", "destacado", "Seleccione si solo muestra la imagen", "", $item_iddestacado); 

						layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 

						#layers_action($url_cancelar);
					?> 	
					<input type="hidden" name="tipo_registro" id="tipo_registro" value="<?php echo $tipo_registro; ?>">
				</div>
			  </div>

			<!---==============================================================--->
			</div>
			<div role="tabpanel" class="tab-pane" id="block-2">
			<!---==============================================================--->
				    
			  <div class="panel panel-default panel-form">
				<div class="bg-info panel-heading font-bold ">
				  Descripci&oacute;n
				</div>
				<div class="panel-body">
					<?php layers(3, "Descripción", "descripcion", "Ingrese descripcion adicional", "", $item_descripcion); ?>  
				</div>
			  </div>

			<!---==============================================================--->					
			</div>
			<div role="tabpanel" class="tab-pane" id="block-3">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					  Im&aacute;genes
					</div>
					<div class="panel-body">
					 <?php layers(5, "Im&aacute;genes", "imagenes", "Ingrese imagenes", ""); ?>
					 <br>
						
						
					 <?php
 						$listado_imagenes = $datos_registro->listar_registro_relacionxtipo($get_id, 4);
 						$ruta = URL_WEB."images/media/";
 						listado_registro_galeria($listado_imagenes, $ruta, URL_WEB_ADMIN, $url_form_eliminar_imagen);	
 						#print_r($listado_imagenes);							
 					 ?>
					</div>
			  	</div>
			<!---==============================================================--->	  
			</div>			
			<div role="tabpanel" class="tab-pane" id="block-5">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					 Registro
					</div>
					<div class="panel-body">
					 <?php  layers_registro($item_usuario, $item_usuario_nombres, $item_fecha_creacion, $item_fecha_modificacion); ?>  	
					</div>
			  	</div>
			<!---==============================================================--->	  
			</div>
			  
		  </div>

		</div> 
		  
		  
      </form>
	 	
<!--SEGUNDO BLOQUE-->
<?php
}
?>
	
 	 
	
</div>

