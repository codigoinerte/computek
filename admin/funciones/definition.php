<?php
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.general.php";
include URL_ROOT_ADMIN."modulos/mod_estadisticas/clases/class.estadisticas.php";

$datos_estadisticas = new estadisticas();
$datos_general= new config_general();

$get_modulo = isset($_REQUEST["modulo"])?$_REQUEST["modulo"]:'';
$get_option = isset($_REQUEST["option"])?$_REQUEST["option"]:'';
$get_token = isset($_REQUEST["token"])?$_REQUEST["token"]:'';
$get_action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
$get_id=isset($_REQUEST["ID"])?$_REQUEST["ID"]:'';
$get_error=isset($_REQUEST['error'])?$_REQUEST['error'] : '';
$get_home=isset($_REQUEST['home'])?$_REQUEST['home'] : '';
$get_msg = isset($_REQUEST["msg"])?$_REQUEST["msg"]:'';
$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';


$detalle_visitas = $datos_estadisticas->visitas_totales(date("Y"));
$total_visitas = isset($detalle_visitas[0]["cantidad"])?$detalle_visitas[0]["cantidad"]:'';

$array_usuario_acceso = isset($_SESSION["acceso"])?$_SESSION["acceso"]:array();
$SisERP =  isset($array_usuario_acceso['usuario']['idempresa'])?$array_usuario_acceso['usuario']['idempresa']:0;
$SisID = isset($array_usuario_acceso['usuario']['idusuario'])?$array_usuario_acceso['usuario']['idusuario']:0;
$Siskey = isset($array_usuario_acceso['sKey'])?$array_usuario_acceso['sKey']:0;

if(count($array_usuario_acceso)==0 || $SisERP==0 || $SisID==0 || $get_token=='' || $get_token!==$Siskey)
{
	if($SisID>0)
	{
		$datos_definition->actualizar_estado_sesion($SisID, 0);	
	}
	if (isset($_SESSION)) { session_unset(); session_destroy(); }		
}

$datos_definition->actualizar_estado_sesion($SisID, 1);
$array_usuario = $datos_definition->usuario_activo($SisID);
$listado_usuarios = $datos_definition->listar_usuarios();
$detalle_empresa = $datos_definition->detalle_empresa(1);
$cant_mail_pendiente = $datos_definition->mail_pendientes();
$cmp = isset($cant_mail_pendiente[0]["cant"])?$cant_mail_pendiente[0]["cant"]:0;
define("CANTIDAD_MAIL_PENDIENTES","$cmp");

$user_nombre = isset($array_usuario[0]["nombre_usuario"])?$array_usuario[0]["nombre_usuario"]:'';
$user_tipo = isset($array_usuario[0]["tipo"])?$array_usuario[0]["tipo"]:'';
$user_ruid= isset($array_usuario[0]["id"])?$array_usuario[0]["id"]:0;
$user_imagen = isset($array_usuario[0]["imagen"])?URL_WEB_ADMIN."images/th/".$array_usuario[0]["imagen"]:URL_WEB_ADMIN."images/user.png";

$sistema_title = isset($detalle_empresa[0]["titulo_seo"])?$detalle_empresa[0]["titulo_seo"]:'Sistema de administaci&oacute;n web';
$sistema_keyword = isset($detalle_empresa[0]["keyword_seo"])?$detalle_empresa[0]["keyword_seo"]:'';
$sistema_descripcion = isset($detalle_empresa[0]["descripcion_seo"])?$detalle_empresa[0]["descripcion_seo"]:'';
$sistema_logo = isset($detalle_empresa[0]["logo"])?URL_WEB_ADMIN."images/sistema/".$detalle_empresa[0]["logo"]:URL_WEB_ADMIN."images/sistema/logo-2.svg";
$sistema_favicon = isset($detalle_empresa[0]["favicon"])?URL_WEB_ADMIN."images/sistema/".$detalle_empresa[0]["favicon"]:'';

$url_logout = URL_WEB_ADMIN."modulos/mod_config/scripts/config.login.script.php?action=logout";
$token_link_externo = ($get_token=='')?$Siskey:$get_token;
$url_perfil_usuario = (URL_WEB_ADMIN."?modulo=mod_config&option=config.usuario&token=$token_link_externo&ID=$user_ruid&action=edit"); 

?>