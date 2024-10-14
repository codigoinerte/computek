    <!-- Main Container -->
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
								?>	
                              <div class="more-views-items">
								  <a href="#" data-image="<?php echo $_imagen; ?>" data-zoom-image="<?php echo $_imagen; ?>">
									  <div class="bg-contain" style="background: url('<?php echo $_imagen; ?>')">
								  	  	<img id="product-zoom"  src="<?php echo URL_WEB."images/bg-producto.png" ?>" alt="<?php echo $_registro_titulo ; ?>"/>
									  </div>
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
          <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
            <div class="add_info">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#product_tabs_description" data-toggle="tab">Descripci&oacute;n producto </a> </li>
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="product_tabs_description">
                  <div class="std">
                    <?php echo $_registro_descripcion; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
  
  <!-- Related Products Slider -->
  <?php
	$array_cat= $datos_reg_home->detalle_nivel_superior($id_registro);
	$idcat = isset($array_cat[0]["id"])?$array_cat[0]["id"]:'';
	
	$array_relacionados = $datos_reg_home->listar_registro_relacionados_detalle($idcat, 3, $id_registro);
	if(count($array_relacionados) > 0)
	{
  ?>	
  <div class="container">
  
   <!-- Related Slider -->
  <div class="related-pro">

      <div class="slider-items-products">
        <div class="related-block">
          <div id="related-products-slider" class="product-flexslider hidden-buttons">
			  
            <div class="home-block-inner">
              <div class="block-title">
                <h2>Productos relacionados</h2></div>
            </div>
            <div class="slider-items slider-width-col4 products-grid block-content">
				<?php foreach($array_relacionados as $item){ ?>
                <div class="item">
                  <?php listado_item_producto($item); ?>
                </div>
				<?php } ?>

              </div>
          </div>
        </div>
      </div>

  </div>
  <!-- End related products Slider --> 
  <?php } ?>
 
  
    
  </div>

