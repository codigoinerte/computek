<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
<?php  include "librerias/mod_seo/seo.php" ;  ?>
<!-- CSS Style --->

<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/font-awesome.min.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/jquery.mobile-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/revslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/jquery.fancybox.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/responsiveslides.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/estilo.css">

<style>
<?php 
	
/*
include ("css/compress.css.php");
$cache_file=URL_ROOT_ADMIN."cache/".md5(URL_WEB."cache_css_web_home").".php"; 
$cache_var='';
if(!file_exists($cache_file))
{	
	$files = glob(URL_ROOT.'css/*.css'); //obtenemos todos los nombres de los ficheros
	foreach($files as $file)
	{
		if(is_file($file))
		#unlink($file); //elimino el fichero
		$css_contenido = file_get_contents($file);
		$cache_var.=$css_contenido;
	}
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;	
}
else
{
	include $cache_file ;
}	
	*/
?>
</style>	
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
</head>

<body class="cms-index-index cms-home-page">
<div id="page"> 
	
	
  <!-- Header -->
<?php	
$cache_file=URL_ROOT_ADMIN."cache/".md5(URL_WEB."cache_header_web".$_alias).".php"; 
$cache_var='';
if(!file_exists($cache_file))
{
	
  $cache_var.='<header>
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 logo-block"> 
            <!-- Header Logo -->
            <div class="logo">
				<a title="Computek" href="'.URL_WEB.'">
					<img alt="Computek" src="'.URL_WEB.'images/logo.jpg">
				</a>
			</div>
			<div class="wspp_responsive hidden-sm hidden-md hidden-lg">';
					$cache_var.=contacto_empresa(4);
				$cache_var.='
			</div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-lg-4 col-md-3 col-sm-4 col-xs-3 hidden-xs category-search-form">
            <div class="search-box">
				<form action="'.URL_WEB.'buscador" method="post">
					<input id="search" type="text" name="buscar" placeholder="Ingrese su busqueda..." class="searchbox" maxlength="128">
					<button type="submit" title="Search" class="search-btn-bg">
						<span><i class="fa fa-search"></i></span>
					</button>
				</form>	
            </div>
          </div>
          <!-- Header Language -->
          <div class="col-xs-12 col-sm-6 col-md-7 col-lg-6 pull-right hidden-xs">
              <div class="col-xs-12 hidden-xs hidden-sm hidden-md col-lg-8">';
			  	$cache_var.=contacto_empresa(5);
			  $cache_var.='</div>
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 text-right">';
              	$cache_var.=contacto_empresa(4);
			  $cache_var.='</div>	  
          </div>
        </div>
      </div>
    </div>
  </header>
  <nav>
    <div class="container">
      <div class="mm-toggle-wrap">
        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
      </div>
	  <div class="clearfix"></div>
      <div class="nav-inner"> 
        <!-- BEGIN NAV -->
        <ul id="nav" class="hidden-xs">';
	
			$active1=$active2=$active3=$active5=$active6=$active7=$active8=$active99="";
			if($_alias=='index')
			{
				$active1='active';		
			}
			else if($_alias=='sobre-nosotros')
			{
				$active2='active';
			}
			else if($_alias=='contactenos')
			{
				$active99='active';
			}
		 
          $cache_var.='<li><a href="'.URL_WEB.'" class="'.$active1.'"><span>Inicio</span></a></li>
          <li><a href="'.URL_WEB.'sobre-nosotros" class="'.$active2.'"><span>Nosotros</span></a></li>';
	
		  $listado_menu = $datos_reg_home->listar_categoriasxpagina(2);
			if(count($listado_menu) > 0)
			{
				foreach($listado_menu as $item)
				{
					$item_nombre = isset($item["nombre"])?$item["nombre"]:'';
					$item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
					
          			$cache_var.='<li><a href="'.$item_alias.'" class="'.(($item["alias"]==$_alias)?"active":"").'"><span>'.$item_nombre.'</span></a></li>';
			  } 
		   } 
		  $cache_var.='<li><a href="'.URL_WEB.'contactenos" class="'.$active99.'"><span>Contactenos</span></a></li>';		
        $cache_var.='</ul>

      </div>
    </div>
  </nav>
  <div class="clearfix"></div>';
	
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;	
}
else
{
	include $cache_file ;
}	
