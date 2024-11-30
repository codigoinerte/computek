<?php
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.producto.estado.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.marca.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.com.pagina.php";
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.php";

$datos_estado_producto = new producto_estado();
$datos_menu_principal = new menu_principal();
$datos_registro = new registro();
$datos_pagina = new pagina();
$datos_marca = new marca();

$array_estado_producto = $datos_estado_producto->listado_estado();
$array_menu_estado = $datos_menu->listar_menu_estado();
$array_paginas = $datos_pagina->listar_paginas();
$array_marca = $datos_marca->listado_marcas();

$url_guardar = "guardar_articulo();";
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/producto.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";

$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";
$tipo_registro=3;
$tipo_pagina = 2;
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
	$item_idoficina = 0;
	$item_idgamer = 0;
	$item_idproductividad = 0;
	$item_idpagina = 0;
	
	$item_idmoneda=1;
	$item_precio = 0;
	$item_descuento = 0;
	$item_stock = 1;
	$item_marca = 0;
	$item_estado = 1;
	
	$item_seo_titulo = "";
	$item_seo_keywords = "";
	$item_seo_descripcion = "";
	$item_seo_imagen = "";
	$item_seo_id = 0;
	
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
	$item_idoficina = $listado_registro[0]["idoficina"];
	$item_idgamer = $listado_registro[0]["idgamer"];
	$item_idproductividad = $listado_registro[0]["idproductividad"];
	$item_idpagina = $listado_registro[0]["id_pagina"];
	
	$item_idmoneda=$listado_registro[0]["idmoneda"];
	$item_precio = $listado_registro[0]["precio"];
	$item_descuento = $listado_registro[0]["descuento"];
	$item_stock = $listado_registro[0]["stock"];
	$item_marca = $listado_registro[0]["idmarca"];
	$item_estado_producto = $listado_registro[0]["estado_producto"];
	
	$item_seo_titulo = $listado_registro[0]["so_titulo"];
	$item_seo_keywords = $listado_registro[0]["seo_keywords"];
	$item_seo_descripcion = $listado_registro[0]["seo_descripcion"];
	$item_seo_imagen = $listado_registro[0]["seo_imagen"];
	$item_seo_id = $listado_registro[0]["seo_id"];
	
	$item_usuario = $listado_registro[0]["usuario"];
	$item_usuario_nombres = $listado_registro[0]["nombre_personal"];
	$item_fecha_creacion = fecha_castellano($listado_registro[0]["fecha_creacion"]);
	$item_fecha_modificacion = fecha_castellano($listado_registro[0]["fecha_modificacion"]);
	
}

$item_idcategoria = 0;
$array_catpadre = $datos_registro->listar_registroxnivel($get_id,2);
$item_id_subcategoria = isset($array_catpadre[0]["id1"])?$array_catpadre[0]["id1"]:0;

if($item_id_subcategoria > 0)
{
	$array_catpadre = $datos_registro->listar_registroxnivel($item_id_subcategoria,1);
	$item_idcategoria = isset($array_catpadre[0]["id1"])?$array_catpadre[0]["id1"]:0;	
}
else
{
	$array_catpadre = $datos_registro->listar_registroxnivel($get_id,1);
	$item_idcategoria = isset($array_catpadre[0]["id1"])?$array_catpadre[0]["id1"]:0;		
}
$array_subcategoria = array();

if($item_idcategoria > 0)
{
	$array_subcategoria = $datos_registro->listar_registro_relacionxtipo($item_idcategoria, 2);
}
$listado_categorias = $datos_registro->listar_registro_tipo(1, $tipo_pagina);
#$listado_subcategorias = $datos_registro->listar_registro_tipo(1);
$idsubcategoria=0;
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Productos</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_panel/ajax/listado.producto.php";
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
			<li role="presentation"><a href="#block-4" aria-controls="block-4" role="tab" data-toggle="tab">Posicionamiento web</a></li>
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
 						$ruta = URL_WEB_ADMIN."modulos/mod_panel/ajax/ajax.articulo.php?token=$get_token";
 						$onclick1 = 'onkeyup="javascript:titulo_registro(this, \'alias\' );javascript:titulo_registro_seo(this.value, \'titulo_seo\');"';
 						$onclick2 = 'onclick="javascript:cargar_categoria(this.value,\'subcategoria\',\''.$ruta.'\',\''.$idsubcategoria.'\');"';	
 
						layers(1, "Nombre", "nombre", "Ingrese el nombre de la subcategoría", "", $item_nombre, $onclick1);
 						layers(1, "Alias", "alias", "Ingrese el alias del registro", "", $item_alias, ""); 
						layers(2, "Categoría", "categoria", "Seleccione la categoría", $listado_categorias, $item_idcategoria, $onclick2); 
						layers(2, "Sub categoría", "subcategoria", "Seleccione la subcategoría", $array_subcategoria, $item_id_subcategoria); 
						layers(1, "Orden", "orden", "Ingrese numero de orden de la categoria", "", $item_orden); 
						layers(2, "Estado", "estado", "Seleccione el estado de la categoria", $array_menu_estado, $item_idestado); 
						layers(13, "Destacado", "destacado", "Seleccione si el producto es destacado o no", "", $item_iddestacado); 
						
						layers(17, "Oficina", "oficina", "Seleccione si el producto es gamer o no", "", $item_idoficina); 
						layers(17, "Gamer", "gamer", "Seleccione si el producto es gamer o no", "", $item_idgamer); 
						layers(17, "Productividad", "productividad", "Seleccione si el producto es de productividad o no", "", $item_idproductividad); 

						layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 

						#layers_action($url_cancelar);
					?> 							
				</div>
				<div class="bg-info panel-heading font-bold ">
				  Detalle
				</div>
				<div class="panel-body" >  
					<?php
 						layers(14, "Moneda", "moneda", "Ingrese el tipo de moneda", "", $item_idmoneda);
 						layers(11, "Precio", "precio", "Ingrese el precio del producto", "", $item_precio);
 						layers(12, "Descuento", "descuento", "Ingrese el descuento del producto", "", $item_descuento);
 						layers(12, "Stock", "stock", "Ingrese el stock del producto", "", $item_stock);
 						layers(2, "Marca", "marca", "Seleccione la marca del producto", $array_marca, $item_marca );
 						layers(2, "Estado", "estado_producto", "Seleccione el estado del producto", $array_estado_producto, $item_estado_producto );
 					?>
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
					 <?php layers(4, "Im&aacute;genes", "imagenes", "Ingrese imagenes", ""); ?>
					 <br>
						
						
					 <?php
 						$ruta = URL_WEB."images/media/";
 						$listado_imagenes = $datos_registro->listar_registro_relacionxtipo($get_id, 4);
 						listado_registro_galeria($listado_imagenes, $ruta, URL_WEB_ADMIN, $url_form_eliminar_imagen);	
 						#print_r($listado_imagenes);							
 					 ?>
					</div>
			  	</div>
			<!---==============================================================--->	  
			</div>
			<div role="tabpanel" class="tab-pane" id="block-4">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					 Posicionamiento web
					</div>
					<div class="panel-body">
					 <?php  
					 layers(1, "Titulo seo", "titulo_seo", "Ingrese el titulo seo del registro", "", $item_seo_titulo, ""); 	
					 layers(1, "Titulo descripción", "descripcion_seo", "Ingrese la descripcion seo del registro", "", $item_seo_descripcion, ""); 	
					 layers(1, "Titulo keywords", "keywords_seo", "Ingrese las palabras claves del seo del registro", "", $item_seo_keywords, ""); 	
  					 layers(5, "Im&aacute;gen seo", "imagen_seo", "Ingrese la imagen del seo", "");
 					 
 					 imagen_seo_box($item_seo_imagen, $item_seo_id, $url_form_eliminar_imagen_seo);	
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

