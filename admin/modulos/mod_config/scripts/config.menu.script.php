<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."clases/class.menu.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.usuarios.php";
$datos_menu = new menu();
$datos_usuario = new config_usuarios();

$menu = isset($_POST["menu"])?$_POST["menu"]:'';
$tipo = isset($_POST["tipo"])?$_POST["tipo"]:'';
$menu_princ = isset($_POST["menu_princ"])?$_POST["menu_princ"]:'';
$categoria = isset($_POST["categoria"])?$_POST["categoria"]:'';
$subcategoria = isset($_POST["subcategoria"])?$_POST["subcategoria"]:'';
$estado = isset($_POST["estado"])?$_POST["estado"]:'';
$ruta = isset($_POST["url"])?$_POST["url"]:'';
$orden = isset($_POST["orden"])?$_POST["orden"]:'';
$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new':    		
		$array_menu=$datos_menu->insertar_menu($menu, $tipo, $menu_princ, $categoria, $subcategoria, $ruta, $estado, $orden);
		$get_id = isset($array_menu[0]["id"])?$array_menu[0]["id"]:0;
		
		$listado_usuarios = $datos_usuario->listar_usuario();
		
		if(count($listado_usuarios) > 0)
		{
			foreach($listado_usuarios as $item)
			{
				$idtipo_usuario = isset($item["idtipo_usuario"])?$item["idtipo_usuario"]:0;
				
				if($idtipo_usuario > 0)
				{
					$datos_usuario->insertar_usuario_permiso($SisID, 99, 1, $get_id);	
				}
				else
				{
					$datos_usuario->insertar_usuario_permiso(0, $idtipo_usuario, 1, $get_id);
				}
			}
		}		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=$get_action&msg=1";		
    break;
    case 'edit':
    	$datos_menu->actualizar_detalle_menu($get_id, $menu, $tipo, $menu_princ, $categoria, $subcategoria, $ruta, $estado, $orden);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=$get_action&msg=1";		
    break;
    case 'delete':
    	$datos_menu->eliminar_detalle_menu($cod_eli_confirm);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>