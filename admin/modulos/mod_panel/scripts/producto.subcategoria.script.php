<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.registro.php";
$datos_registro = new registro();

$_item_nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
$_item_url =  isset($_POST["url"])?$_POST["url"]:'';
$_item_pagina = isset($_POST["pagina"])?$_POST["pagina"]:0;
$_item_categoria = isset($_POST["categoria"])?$_POST["categoria"]:0;
$_item_alias = isset($_POST["alias"])?$_POST["alias"]:'';
$_item_orden = isset($_POST["orden"])?$_POST["orden"]:'';
$_item_estado = isset($_POST["estado"])?$_POST["estado"]:0;
$_item_descripcion = isset($_POST["descripcion"])?$_POST["descripcion"]:'';
$_item_titulo_seo = isset($_POST["titulo_seo"])?$_POST["titulo_seo"]:'';
$_item_descripcion_seo = isset($_POST["descripcion_seo"])?$_POST["descripcion_seo"]:'';
$_item_keywords_seo = isset($_POST["keywords_seo"])?$_POST["keywords_seo"]:'';
$_item_galeria = isset($_POST["galeria"])?$_POST["galeria"]:array();

$fecha_creacion = $fecha_ahora;
$ruta_destino = URL_ROOT."images/media/";			
$ruta_ftp = URL_ROOT."images/media/";	
$ruta_ftp_seo = $ruta_ftp; #URL_ROOT."admin/images/sistema/";
$myFile = isset($_FILES["imagenes"]) ? $_FILES["imagenes"] : ''; 	
$myFile_seo = isset($_FILES["imagen_seo"]) ? $_FILES["imagen_seo"] : ''; 	

#$cod_eli_confirm = isset($_GET["cod_eli_confirm"]) ?$_GET["cod_eli_confirm"] : '';			
			
#$tipo = "imagen";
#print_r($myFile);
#print_r($_POST);
#exit();

$url_retorno="";
switch ($get_action) {
    case 'new':    				
		$array_cant_alias = $datos_registro->listar_alias($_item_alias);
		$cant_alias = isset($array_cant_alias[0]["cant"])?$array_cant_alias[0]["cant"]:0;
		$_item_alias = $_item_alias.(($cant_alias>0)?"-".($cant_alias):'');
		
		$array_id = $datos_registro->insertar_registro($_item_nombre, $_item_url, "", "", $_item_descripcion, $_item_orden, 2, $_item_estado, 1, 0, $fecha_creacion, $fecha_creacion);
		$ID = isset($array_id[0]["id"])?$array_id[0]["id"]:'';
		
		if($_item_categoria > 0)			
		{
			$array_idrel = $datos_registro->insertar_relacion($_item_categoria,$ID);			
			$array_alias = $datos_registro->listar_aliasxidpagina($_item_categoria);	
			$_item_pagina = isset($array_alias[0]["id_pagina"])?$array_alias[0]["id_pagina"]:0;
		}		
		
		$datos_registro->insertar_alias($ID, $_item_pagina, $_item_alias, 2);
		
		#SEO		
		#insertar_registro($nombre, $url, $imagen, $resumen, $descripcion, $orden, $idtipo, $idestado, $idusuario, $iddestacado, $fecha_creacion, $fecha_modificacion)
		$array_seo = $datos_registro->insertar_registro($_item_titulo_seo, "", "", $_item_keywords_seo, $_item_descripcion_seo, 0, 10);
		$ID_SEO = isset($array_seo[0]["id"])?$array_seo[0]["id"]:0;
		$datos_registro->insertar_relacion($ID,$ID_SEO);
		upload_files(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile,$ruta_ftp,$ID);
		upload_files(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile_seo,$ruta_ftp_seo,$ID_SEO,2);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";
		
    break;
    case 'edit':
				
						#actualizar_registro($id, $nombre, $url, $imagen, $resumen, $descripcion, $orden, $idestado, $iddestacado, $fecha_modificacion)
    	$datos_registro->actualizar_registro($get_id, $_item_nombre, "","", "",$_item_descripcion,$_item_orden,$_item_estado,0,$fecha_creacion);
		$datos_registro->actualizar_alias($get_id, $_item_alias, $_item_pagina);
		$datos_registro->actualizar_relacionxnivel($get_id,$_item_categoria);
		if(count($_item_galeria) > 0)
		{
			foreach($_item_galeria as $item)
			{
				$_galeria_id = isset($item["id"])?$item["id"]:'';
				$_galeria_nombre = isset($item["nombre"])?$item["nombre"]:'';
				$_galeria_orden = isset($item["orden"])?$item["orden"]:0;
				$_galeria_destacado = isset($item["destacado"])?$item["destacado"]:0;				
				$datos_registro->actualizar_registro($_galeria_id, $_galeria_nombre, "","","","",$_galeria_orden,0,$_galeria_destacado);
			}
		}
		
		upload_files(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile,$ruta_ftp,$get_id);
		
		$listado_seo= $datos_registro-> listar_registro_relacionxtipo($get_id, 10);
		$id_seo = isset($listado_seo[0]["id"])?$listado_seo[0]["id"]:0;
		$datos_registro->actualizar_registro($id_seo, $_item_titulo_seo, "","", $_item_keywords_seo,$_item_descripcion_seo);
		upload_files(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile_seo,$ruta_ftp_seo,$id_seo,2);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";
		
    break;
    case 'delete':
		
		$listado_seo= $datos_registro-> listar_registro_relacionxtipo($cod_eli_confirm, 10);
		$item_imagen = isset($listado_seo[0]["imagen"])?$listado_seo[0]["imagen"]:'';
		if($item_imagen!=='')
		{
			delete_image_registros(URL_ROOT."images/media/$item_imagen");
			delete_image_registros(URL_ROOT."images/media/th/$item_imagen");
		}	
		
    	$datos_registro->eliminar_registro($cod_eli_confirm);
		$datos_registro->eliminar_alias($cod_eli_confirm);
		
		$listado_imagenes = $datos_registro->listar_registro_relacionxtipo($cod_eli_confirm, 4);
		if($listado_imagenes > 0)
		{
			foreach($listado_imagenes as $item)
			{
				$item_id = isset($item["id"])?$item["id"]:'';
				$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
				delete_image_registros(URL_ROOT."images/media/$item_imagen");
				delete_image_registros(URL_ROOT."images/media/th/$item_imagen");
				$datos_registro->eliminar_registro($item_id);
			}
		}
		
		#$datos_registro->eliminar_allrelacion($cod_eli_confirm);
		
		$listado_interelacion_padre = $datos_registro->listar_relacion_padre($cod_eli_confirm);
		$listado_interelacion_hijo = $datos_registro->listar_relacion_hijo($cod_eli_confirm);
		
		$cantidad1 = isset($listado_interelacion_padre[0]["cantidad"])?$listado_interelacion_padre[0]["cantidad"]:0;
		$cantidad2 = isset($listado_interelacion_hijo[0]["cantidad"])?$listado_interelacion_hijo[0]["cantidad"]:0;
		
		if($cantidad1>0)
		{
			$datos_registro->eliminar_relacion($cod_eli_confirm);	
		}
		if($cantidad2>0)
		{
			$datos_registro->eliminar_relacion_hijo($cod_eli_confirm);	
		}
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
	case 'delete_imagen':
		
		$array_registro = $datos_registro->registro_detalle($cod_eli_confirm);
		$item_imagen = isset($array_registro[0]["imagen"])?$array_registro[0]["imagen"]:'';
		if($item_imagen!=='')
		{
			delete_image_registros(URL_ROOT."images/media/$item_imagen");
			delete_image_registros(URL_ROOT."images/media/th/$item_imagen");
		}		
		$array_registro = $datos_registro->eliminar_imagen($cod_eli_confirm);
		$get_id = isset($array_registro[0]["id"])?$array_registro[0]["id"]:0;
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=3";
	break;	
	case 'delete_imagen_seo':
		$array_registro = $datos_registro->registro_detalle($cod_eli_confirm);
		$item_imagen = isset($array_registro[0]["imagen"])?$array_registro[0]["imagen"]:'';
		if($item_imagen!=='')
		{
			delete_image_registros(URL_ROOT."images/media/$item_imagen");
			delete_image_registros(URL_ROOT."images/media/th/$item_imagen");
		}	
		$array_registro = $datos_registro->actualizar_imagen($cod_eli_confirm);
		$get_id = isset($array_registro[0]["id"])?$array_registro[0]["id"]:0;
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=3";	
	break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>