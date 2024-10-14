<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/general.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.permisos.php";
$datos_permisos= new config_permisos();

$tipo = isset($_POST["tipo"])?$_POST["tipo"]:'';
$menu = isset($_POST["menu"])?$_POST["menu"]:array();
$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new': 	
		$array_tpermisos = $datos_permisos->insertar_permiso($tipo);
		$ID = isset($array_tpermisos[0]["id"])?$array_tpermisos[0]["id"]:0;
		
		if(count($menu) > 0)
		{	
			foreach($menu as $item)
			{
				$idmenu = isset($item["id"])?$item["id"]:0;	
				if($idmenu!==0)
				{
					$datos_permisos->insertar_relacion_permisos($ID, 1, $idmenu);
				}
			}
		}
	
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";		
    break;
    case 'edit':    	
		$datos_permisos->actualizar_permiso($get_id, $tipo);
		if(count($menu) > 0)
		{
			$datos_permisos->eliminar_relacion_permisos($get_id, 1);
			foreach($menu as $item)
			{
				$idmenu = isset($item["id"])?$item["id"]:0;	
				if($idmenu!==0)
				{
					$datos_permisos->insertar_relacion_permisos($get_id, 1, $idmenu);
				}
			}
		}
					 		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";				
    break;
    case 'delete':
		
		$datos_permisos->eliminar_permiso($cod_eli_confirm);
		$datos_permisos->eliminar_relacion_permisos($cod_eli_confirm, 1);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";				
	break;

}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>