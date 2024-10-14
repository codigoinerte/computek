<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
$datos_menu_principal = new menu_principal();

$menu = isset($_POST["menu"])?$_POST["menu"]:'';
$orden = isset($_POST["orden"])?$_POST["orden"]:'';
$estado = isset($_POST["estado"])?$_POST["estado"]:'';
$descripcion = isset($_POST["descripcion"])?$_POST["descripcion"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new':    
			
		$array_menu_principal = $datos_menu_principal->insertar_menu_principal($menu, $orden, $descripcion, $estado );
		$ID = $array_menu_principal[0]["id"];
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=$get_action&msg=1";
		
    break;
    case 'edit':
    	$datos_menu_principal->actualizar_menu_principal($get_id, $menu, $orden, $descripcion, $estado);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=$get_action&msg=1";
		
    break;
    case 'delete':
    	$datos_menu_principal->eliminar_menu_principal($cod_eli_confirm);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>