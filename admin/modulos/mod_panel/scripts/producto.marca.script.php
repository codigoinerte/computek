<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.registro.marca.php";
$datos_marca = new marca();

$_item_nombre = isset($_POST["marca"])?$_POST["marca"]:'';
$nombre_imagen = "";
$fecha_creacion = $fecha_ahora;
$ruta_destino = URL_ROOT."images/media/";			
$ruta_ftp = URL_ROOT."images/media/";				
$myFile = isset($_FILES["imagen"]) ? $_FILES["imagen"] : ''; 	
$allowedExts = array("gif", "jpeg", "jpg", "png");		
#$cod_eli_confirm = isset($_GET["cod_eli_confirm"]) ?$_GET["cod_eli_confirm"] : '';			
			
#$tipo = "imagen";
#print_r($myFile);
#print_r($_POST);
#exit();

$url_retorno="";
switch ($get_action) {
    case 'new':    	
		
		if(($myFile["size"][0] < 500000) && ($myFile["size"][0] > 0))
		{
			$tmpFilePath = $myFile["tmp_name"][0];  	
			$temp = explode(".", $myFile["name"][0]);
			$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
			$newFilePath = $ruta_destino. $newfilename;

			if(move_uploaded_file($tmpFilePath, $newFilePath))
			{					
				$nombre_imagen = $newfilename;	
			}
		}			
		
		$array_id = $datos_marca->insertar_marca($_item_nombre, $nombre_imagen);
		$ID = isset($array_id[0]["id"])?$array_id[0]["id"]:'';		
	
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";
		
    break;
    case 'edit':
		
		if(($myFile["size"][0] < 500000) && ($myFile["size"][0] > 0))
		{
			$tmpFilePath = $myFile["tmp_name"][0];  	
			$temp = explode(".", $myFile["name"][0]);
			$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
			$newFilePath = $ruta_destino. $newfilename;

			if(move_uploaded_file($tmpFilePath, $newFilePath))
			{					
				$nombre_imagen = $newfilename;	
			}
		}
		
		$datos_marca->actualizar_marca($get_id, $_item_nombre, $nombre_imagen);	
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";
		
    break;
    case 'delete':
    	$detalle_marca = $datos_marca->detalle_marca($cod_eli_confirm);				
		if($detalle_marca > 0)
		{
			foreach($detalle_marca as $item)
			{
				$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
				delete_image_registros(URL_ROOT."images/media/$item_imagen");				
				delete_image_registros(URL_ROOT."images/media/th/$item_imagen");				
			}
		}
		$datos_marca->eliminar_marca($cod_eli_confirm);		
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
	case 'delete_imagen':

		$detalle_marca = $datos_marca->detalle_marca($cod_eli_confirm);				
		if($detalle_marca > 0)
		{
			foreach($detalle_marca as $item)
			{
				$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
				
				delete_image_registros(URL_ROOT."images/media/$item_imagen");
				delete_image_registros(URL_ROOT."images/media/th/$item_imagen");
				$datos_marca->actualizar_marca_imagen($cod_eli_confirm);
			}
		}		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$cod_eli_confirm&action=edit&msg=3";
	break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>