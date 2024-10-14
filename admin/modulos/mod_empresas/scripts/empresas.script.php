<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/general.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.empresa.php";
$datos_empresa= new empresa();

$empresa = isset($_POST["empresa"])?$_POST["empresa"]:'';
$ruc = isset($_POST["ruc"])?$_POST["ruc"]:'';
$representante = isset($_POST["representante"])?$_POST["representante"]:0;
$titulo_seo = isset($_POST["titulo_seo"])?$_POST["titulo_seo"]:'';
$keywords_seo = isset($_POST["keywords_seo"])?$_POST["keywords_seo"]:'';
$descripcion_seo = isset($_POST["descripcion_seo"])?$_POST["descripcion_seo"]:'';

$logo = isset($_FILES["logo"])?$_FILES["logo"]:array();
$isotipo = isset($_FILES["isotipo"])?$_FILES["isotipo"]:array();
$favicon = isset($_FILES["favicon"])?$_FILES["favicon"]:array();

$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';
$ruta_destino = URL_ROOT."admin/images/sistema/";			
$ruta_ftp = URL_ROOT."admin/images/sistema/";

$info_empresa = isset($_POST["data"])?$_POST["data"]:array();
$url_retorno="";
switch ($get_action) {
    case 'new': 	
			
    break;
    case 'edit':    	
		
		$datos_empresa->actualizar_empresa($get_id, $empresa, $ruc, $titulo_seo, $keywords_seo, $descripcion_seo, $representante);				
		$datos_empresa->eliminar_data_info($get_id, 'mod_empresa');
		
		if(count($info_empresa) > 0)
		{
			foreach($info_empresa as $item)
			{
				$item_value = isset($item["value"])?$item["value"]:'';
				$item_idtipo= isset($item["idtipo"])?$item["idtipo"]:0;				
				$item_principal= isset($item["principal"])?$item["principal"]:0;				
				$datos_empresa->insertar_info_empresa($item_value, $item_idtipo, $get_id, 'mod_empresa', $item_principal);
			}
		}
		
		$tmpFilePath = isset($logo['tmp_name'][0])?$logo['tmp_name'][0]:'';
		if($tmpFilePath !== "" && ($logo["size"][0] < 500000))
		{
			$temp = explode(".", $logo["name"][0]);
			$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
			$newFilePath = $ruta_ftp. $newfilename;			
			if(move_uploaded_file($tmpFilePath, $newFilePath))
			{
				//Handle other code here
				$datos_empresa->actualizar_logo($get_id, $newfilename);	

			}
		}			
		
		$tmpFilePath = isset($isotipo['tmp_name'][0])?$isotipo['tmp_name'][0]:'';
		if($tmpFilePath !== "" && ($isotipo["size"][0] < 500000))
		{
			$temp = explode(".", $isotipo["name"][0]);
			$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
			$newFilePath = $ruta_ftp. $newfilename;
			#exit();	
			if(move_uploaded_file($tmpFilePath, $newFilePath))
			{
				//Handle other code here
				$datos_empresa->actualizar_isotipo($get_id, $newfilename);	

			}
		}			
		
		$tmpFilePath = isset($favicon['tmp_name'][0])?$favicon['tmp_name'][0]:'';
		if($tmpFilePath !== "" && ($favicon["size"][0] < 500000))
		{
			$temp = explode(".", $favicon["name"][0]);
			$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
			$newFilePath = $ruta_ftp. $newfilename;
			#exit();	
			if(move_uploaded_file($tmpFilePath, $newFilePath))
			{
				//Handle other code here
				$datos_empresa->actualizar_favicon($get_id, $newfilename);	

			}
		}			
		
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";				
    break;
    case 'delete':
		
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";				
	break;
	case 'delete_imagen_logo':
		$detalle_empresa = $datos_empresa->detalle_empresa($cod_eli_confirm);
		$logo = isset($detalle_empresa[0]["logo"])?$detalle_empresa[0]["logo"]:'';
		if($logo!=='')
		{
			unlink($ruta_destino.$logo);			
			$datos_empresa->actualizar_logo($cod_eli_confirm);	
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$cod_eli_confirm&action=edit&msg=3";	
	break;	
	case 'delete_imagen_isotipo':
		$detalle_empresa = $datos_empresa->detalle_empresa($cod_eli_confirm);
		$isotipo = isset($detalle_empresa[0]["isotipo"])?$detalle_empresa[0]["isotipo"]:'';
		if($isotipo!=='')
		{
			unlink($ruta_destino.$isotipo);			
			$datos_empresa->actualizar_isotipo($cod_eli_confirm);	
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$cod_eli_confirm&action=edit&msg=3";	
		
	break;	
	case 'delete_imagen_favicon':
		$detalle_empresa = $datos_empresa->detalle_empresa($cod_eli_confirm);
		$favicon = isset($detalle_empresa[0]["isotipo"])?$detalle_empresa[0]["isotipo"]:'';
		if($favicon!=='')
		{
			unlink($ruta_destino.$favicon);			
			$datos_empresa->actualizar_favicon($cod_eli_confirm);	
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$cod_eli_confirm&action=edit&msg=3";	
		
	break;		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>