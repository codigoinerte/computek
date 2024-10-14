<?php 
#if(!defined('COD_SEG')) die( 'Acceso Restringido' );
if($_alias == "")
{
	$_alias = "index";
}

$cache_file = URL_ROOT_ADMIN."cache/".md5(URL_WEB."cache_seo_".$_alias).".php"; 
$cache_var = '';
if(!file_exists($cache_file))
{	
	$datos_seo = new seo();
	$detalle_empresa = $datos_seo->detalle_empresa(1);
	
	$titulo_empresa = isset($detalle_empresa[0]["titulo_seo"])?$detalle_empresa[0]["titulo_seo"]:'';
	$keyword_empresa = isset($detalle_empresa[0]["keyword_seo"])?$detalle_empresa[0]["keyword_seo"]:'';
	$descripcion_empresa = isset($detalle_empresa[0]["descripcion_seo"])?$detalle_empresa[0]["descripcion_seo"]:'';
	
	$favicon_empresa = isset($detalle_empresa[0]["favicon"])?$detalle_empresa[0]["favicon"]:'';
	$isotipo_empresa = isset($detalle_empresa[0]["isotipo"])?$detalle_empresa[0]["isotipo"]:'';
	$logo_empresa = isset($detalle_empresa[0]["logo"])?$detalle_empresa[0]["logo"]:'';
	
	if($_alias!=='' && $_alias!=='index')
	{
		$datos_alias = $datos_reg_home->identificador($_alias);
		$id_registro = isset($datos_alias[0]["id_registro"])?$datos_alias[0]["id_registro"]:0;
		
		$detalle_seo = $datos_reg_home->listar_registro_relacionados($id_registro, 10);
		$titulo_web = isset($detalle_seo[0]["nombre"])?$detalle_seo[0]["nombre"]:'';
		$metakeyword = isset($detalle_seo[0]["resumen"])?$detalle_seo[0]["resumen"]:'';
		$metadescripcion = isset($detalle_seo[0]["descripcion"])?$detalle_seo[0]["descripcion"]:'';

		$og_image = isset($detalle_seo[0]["imagen"]) ? $detalle_seo[0]["imagen"] : '';
		$url_og_image = "images/media/".$og_image;

		if($og_image=='')
		{
			$detalle_registro = $datos_reg_home->listar_registro_relacionados($id_registro, 4);
			if(count($detalle_registro) > 0)
			{
				$og_image = isset($detalle_registro[0]["imagen"]) ? $detalle_registro[0]["imagen"] : '';
				$url_og_image = "images/media/".$og_image;
			}
			else
			{
				$og_image = $logo_empresa;
				$url_og_image = "admin/images/sistema/".$og_image;
			}
		}
	}
	else
	{
		
		$titulo_web = $titulo_empresa;
		$metakeyword = $keyword_empresa;
		$metadescripcion = $descripcion_empresa;

		$og_image = $logo_empresa;
		$url_og_image = "images/media/".$og_image;
		
	}
	
	$url_seo = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	$url_favicon= URL_WEB."admin/images/sistema/$favicon_empresa";
	$url_favicon_root = URL_ROOT."admin/images/sistema/$favicon_empresa";
	if(!file_exists($url_favicon_root) or $favicon_empresa == NULL):
		$url_favicon= URL_WEB."admin/images/sistema/sistema-favicon.ico";		
		#$url_favicon= URL_WEB_TEMPLATE."web/images/".COD_PROD."/favicon.ico";		
	endif;		

	$cache_var .= '
	<title>'.$titulo_web.'</title>
	<meta name="description" content="'.$metadescripcion.'">
	<meta name="keywords" content="'.$metakeyword.'">
	<!-- Standard Favicon -->
	<link rel="icon" type="image/x-icon" href="'.$url_favicon.'" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="'.$titulo_web.'">
    <meta itemprop="description" content="'.$metadescripcion.'">';
 
	if(file_exists(URL_ROOT.$url_og_image) && $og_image != '')
	{ 
		$cache_var .= '<meta itemprop="image" content="'.URL_WEB.$url_og_image.'">';
	} 
	
	$cache_var .= ' 
	<!-- Twitter Card data -->
    <meta name="twitter:card" content="'. $_alias.'">
    <meta name="twitter:site" content="'. $url_seo.'">
    <meta name="twitter:title" content="'. $titulo_web.'">
    <meta name="twitter:description" content="'. $metadescripcion.'">';
	
	if(file_exists(URL_ROOT.$url_og_image) && $og_image != '')
	{ 
		$cache_var .= '<meta name="twitter:image:src" content="'. URL_WEB.$url_og_image.'">';
	} 

	$cache_var .= '
	<!-- Open Graph data -->
 	<meta property="og:title" content="'. $titulo_web.'"/>
    <meta property="og:url" content="'. $url_seo.'"/>
   	<meta property="og:type" content="article"/>';
	
	if(file_exists(URL_ROOT.$url_og_image) && $og_image != '')
	{
		$cache_var .= '<meta property="og:image" content="'. URL_WEB.$url_og_image.'"/>';
	} 
	
	
	$cache_var .= '
	<meta property="og:description" content="'. $metadescripcion.'"/>
    <meta property="og:site_name" content="'. $_alias.'" />
    <meta name="robots" content="index, follow"  />
	<meta name="googlebot" content="index, follow" />';
	
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;
	
}
else
{
	include $cache_file ;
}
?>
