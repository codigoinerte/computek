<?php
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
$datos_menu_principal = new menu_principal();

$array_menu_estado = $datos_menu->listar_menu_estado();
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.menu.principal.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_guardar = "guardar_menu_principal();";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";;

$listado_menu = $datos_menu_principal->listado_menu_principal_detalle($get_id);
if(count($listado_menu) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_nombre = "";
	$item_orden = "";
	$item_descripcion = "";
	$item_idestado = "";
}
else
{
	$item_nombre = $listado_menu[0]["nombre"];
	$item_orden = $listado_menu[0]["orden"];
	$item_descripcion = $listado_menu[0]["observaciones"];
	$item_idestado = $listado_menu[0]["estado"];
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro Menús Principales</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_config/ajax/listado.config.menu.principal.php";
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
		 layers(1, "Orden", "orden", "Ingrese numero de orden del menú", "", $item_orden); 
		 layers(2, "Estado", "estado", "Seleccione el estado del menú", $array_menu_estado, $item_idestado); 
 		 layers(3, "Descripción", "descripcion", "Ingrese descripcion adicional", "", $item_descripcion); 
 
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

