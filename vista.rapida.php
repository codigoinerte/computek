<?php
require "admin/funciones/conecta.general.php";	
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT."librerias/mod_seo/clases/class.seo.php";
include URL_ROOT."librerias/mod_registros/mod.config.registro.php";
include URL_ROOT."librerias/mod_registros/panel.funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php  include URL_ROOT."librerias/mod_seo/seo.php" ;  ?>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/font-awesome.min.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/revslider.css" >
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/flexslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/jquery.mobile-menu.css">>
<link rel="stylesheet" type="text/css" href="<?php echo URL_WEB; ?>css/estilo.css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
</head>
<body class="cms-index-index">
<?php
$datos_registro = $datos_reg_home->detalle_registro($id_registro);

$_registro_titulo = isset($datos_registro[0]["nombre"])?$datos_registro[0]["nombre"]:'';
$_registro_descripcion = isset($datos_registro[0]["descripcion"])?$datos_registro[0]["descripcion"]:'';
$_registro_resumen = isset($datos_registro[0]["resumen"])?$datos_registro[0]["resumen"]:'';
$_registro_stock = isset($datos_registro[0]["stock"])?$datos_registro[0]["stock"]:'';
$_registro_estado = isset($datos_registro[0]["estado"])?$datos_registro[0]["estado"]:'';
$_registro_marca = isset($datos_registro[0]["marca"])?$datos_registro[0]["marca"]:'';

$_registro_precio = isset($datos_registro[0]["precio"])?$datos_registro[0]["precio"]:0;
$_registro_descuento = isset($datos_registro[0]["descuento"])?$datos_registro[0]["descuento"]:0;
	
if($_registro_resumen=='')	
{
	$_registro_resumen=$_registro_descripcion;
}
?>	
<section class="main-container col1-layout">
    <div class="main">
      <div class="container">
        <div class="row">
			
          <div class="col-main">
            <div class="product-view">
              <div class="product-essential">
                <form>                  
                  <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                    <div class="new-label new-top-left"> Nuevo </div>
					<?php if(count($datos_registro_galeria) > 0){ ?>  
                    <div class="product-image">
					  <?php
					  $_imagen_1 = isset($datos_registro_galeria[0]["imagen"])?URL_WEB."images/media/".$datos_registro_galeria[0]["imagen"]:'';	
					  ?>	
                      <div class="product-full">
						  <img id="product-zoom" src="<?php echo $_imagen_1; ?>" data-zoom-image="<?php echo $_imagen_1; ?>" alt="<?php echo $_registro_titulo ; ?>"/>
					  </div>
					  
                      <div class="more-views">
                        <div class="slider-items-products">
                          <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                            <div class="slider-items slider-width-col4 block-content">
							  <?php foreach($datos_registro_galeria as $item){
								$_imagen = isset($item["imagen"])?URL_WEB."images/media/".$item["imagen"]:'';	
								$_imagen_th = isset($item["imagen"])?URL_WEB."images/media/th/".$item["imagen"]:'';	
								?>	
                              <div class="more-views-items">
								  <a href="#" data-image="<?php echo $_imagen_th; ?>" data-zoom-image="<?php echo $_imagen; ?>">									  
								  	<img id="product-zoom"  src="<?php echo $_imagen_th; ?>" alt="<?php echo $_registro_titulo ; ?>"/>									  									  
								  </a>
							  </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
					  	
                    </div>
					<?php } ?>  
                    <!-- end: more-images --> 
                  </div>
                  <div class="product-shop col-lg-8 col-sm-7 col-xs-12">                    
                    <div class="product-name">
                      <h1><?php echo $_registro_titulo ; ?></h1>
                    </div>
                    <div class="ratings">
                      <div class="rating-box">
                        <div style="width:80%" class="rating"></div>
                      </div>                      
                    </div>
                    <div class="price-block">
                      <div class="price-box">
						<?php if($_registro_descuento > 0 ){
						  
						  		$_registro_precio_especial=$_registro_precio-(($_registro_precio*$_registro_descuento)/100);
						  ?>
						<p class="special-price">
							<span class="price-label">Precio especial</span>
							<span id="product-price-48" class="price"> <?php echo "S/ ".redondear_precio($_registro_precio_especial); ?> </span>
						</p>
						  
                        <p class="old-price">
							<span class="price-label">Precio original:</span>
							<span class="price"> <?php echo "S/ ".redondear_precio($_registro_precio); ?> </span>
						</p>						   
						<?php }else{ ?>  
						<p class="special-price">
							<span class="price-label">Precio especial</span>
							<span id="product-price-48" class="price"> <?php echo "S/ ".redondear_precio($_registro_precio); ?> </span>
						</p>						  
						<?php } ?>  
                        
							<?php if($_registro_stock > 0)
							{
								?>
						  		<p class="availability in-stock pull-right"><span>En Stock</span></p>
						  		<?php
							}
							else
							{
								?>
						  		
						  		<p class="availability out-of-stock pull-right"><span>Sin Stock</span></p>
						  		<?php
							}
						 	?>
						  
                        
                      </div>
                    </div>
                    <div class="short-description">
                      <h2>Vista rápida</h2>
                      <?php echo $_registro_resumen; ?>
                    </div>
                    <div class="add-to-box">
                      <div class="add-to-cart">                        
                        <?php echo compartir_producto_whatsapp($_alias); ?>  
						<a href="<?php echo URL_WEB."contactenos"; ?>" class="button btn-cart">Mayor informaci&oacute;n</a>
                      </div>
                      <?php # ?>
                    </div>
                    <div class="social">
                      <ul class="link">
                        <li class="fb"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL_WEB.$_alias; ?>"></a></li>
                        <li class="tw"><a style="cursor: pointer" onclick="javascript:window.open('https://twitter.com/intent/tweet?text=<?php echo $_registro_titulo; ?>&amp;url=<?php echo URL_WEB.$_alias; ?>&amp;counturl=<?php echo URL_WEB.$_alias; ?>','twitter','1277856388');" ></a></li>                                                
                        <li class="pintrest"><a href="https://pinterest.com/pin/create/button/?url=<?php echo URL_WEB.$_alias; ?>"></a></li>
                        <li class="linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=EasySocialShareButtons&amp;title=<?php echo $_registro_titulo; ?>&amp;url=<?php echo URL_WEB.$_alias; ?>"></a></li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>     

<!--product-view--> 

<!-- JavaScript --> 
<script src="<?php echo URL_WEB; ?>js/jquery.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/bootstrap.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/common.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.flexslider.js"></script> 
<script src="<?php echo URL_WEB; ?>js/owl.carousel.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.mobile-menu.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/cloud-zoom.js"></script>

</body>
</html>