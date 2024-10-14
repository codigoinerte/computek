<?php
$array_menu_tipo = $datos_menu->listar_menu_tipo();
$array_menu_principal = $datos_menu->listar_menu_principal();
$array_menu_estado = $datos_menu->listar_menu_estado();

$array_menu_categoria = $datos_menu->listar_menu_nivel(1,1);
$array_menu_subcategoria = $datos_menu->listar_menu_nivel(1);

$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.menu.script.php";
$url_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_guardar = "guardar_menu();";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";


$listado_menu = $datos_menu->listar_detalle_menu($get_id);
if(count($listado_menu) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_nombre = '';
	$item_idtipo = 0;
	$item_idmenu = 0;
	$item_idcat = 0;
	$item_idscat = 0;
	$item_ruta = '';
	$item_idestado = 0;
	$item_orden = 0;
}
else
{
	$item_nombre = $listado_menu[0]["nombre"];
	$item_idtipo = $listado_menu[0]["idtipo"];
	$item_idmenu = $listado_menu[0]["idmenu"];
	$item_idcat = $listado_menu[0]["idcategoria"];
	$item_idscat = $listado_menu[0]["idsubcategoria"];
	$item_ruta = $listado_menu[0]["ruta"];
	$item_idestado = $listado_menu[0]["idestado"];
	$item_orden = $listado_menu[0]["orden"];	
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro Menús</h1>
</div>
<?php
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>
<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_config/ajax/listado.config.menu.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	
  <div class="col-xs-12 col-md-12">
  <div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Detalle
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>">        
		<?php
		
		 layers(1, "Nombre", "menu", "Ingrese el nombre del menú", "", $item_nombre); 
		 layers(2, "Tipo", "tipo", "Seleccione el tipo de menú", $array_menu_tipo, $item_idtipo); 
		 layers(2, "Menu principal", "menu_princ", "Seleccione el menú principal", $array_menu_principal, $item_idmenu); 
		 layers(2, "Categoria", "categoria", "Seleccione la categoria del menú", $array_menu_categoria, $item_idcat); 
		 layers(2, "Sub Categoria", "subcategoria", "Seleccione la Sub categoria del menú", $array_menu_subcategoria, $item_idscat); 
		 layers(2, "Estado", "estado", "Seleccione el estado del menú", $array_menu_estado, $item_idestado); 
		 layers(1, "Ruta", "url", "Ingrese la ruta del menú","", $item_ruta); 
		 layers(1, "Orden", "orden", "Ingrese numero de orden del menú", "", $item_orden); 
		 layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 

 		 #layers_action($url_cancelar);
		?>        
		  
      </form>
    </div>
 </div>
 </div> 	 	
<!--SEGUNDO BLOQUE-->
<?php
}
?>
	
 	 
	
</div>

