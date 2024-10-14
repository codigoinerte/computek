	
  <?php include("slider.php"); ?>
  <div class="promotion-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-4">
		  <?php echo mostrar_modulo_web(61, 1); ?>
		</div>
        <div class="col-lg-5 col-sm-5 last">
		  <?php echo mostrar_modulo_web(63, 1); ?>	  
		</div>
        <div class="col-lg-3 col-sm-3 last">
		  <?php echo mostrar_modulo_web(65, 1); ?>	
		</div>
      </div>
    </div>
  </div>

  <div class="content-page">
    <div class="container"> 
      <!-- featured category fashion -->
      <div class="category-product">
        <div class="navbar nav-menu">
          <div class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li>
                <div class="new_title">
                  <h2>Nuevos productos</h2>
                </div>
              </li>
			 <?php
				$listado_categorias = $datos_reg_home->listar_categoriasxpagina(2);
				if(count($listado_categorias) > 0)
				{
					$num=1;
					foreach($listado_categorias as $item)
					{
						$idcategoria = isset($item["id"])?$item["id"]:0;
						$categoria = isset($item["nombre"])?$item["nombre"]:'';
			 ?>	
              <li <?php echo ($num==1)?'class="active"':''; ?>>
				  <a data-toggle="tab" href="#tab-<?php echo $num; ?>"><?php echo $categoria; ?></a>
			  </li>
			 <?php
						$num++;
					}
				}
			  ?>	
            </ul>
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <div class="product-bestseller">
          <div class="product-bestseller-content">
            <div class="product-bestseller-list">
              <div class="tab-container"> 
                <!-- tab product -->
				<?php
				$listado_categorias = $datos_reg_home->listar_categoriasxpagina(2);
				if(count($listado_categorias) > 0)
				{  	$num=1;
					foreach($listado_categorias as $item)
					{
						$idcategoria = isset($item["id"])?$item["id"]:0;
					?>  
					<div class="tab-panel <?php echo ($num==1)?'active':''; ?>" id="tab-<?php echo $num; ?>">
					  <div class="category-products">
						<?php
							$listado_registros_nuevos = $datos_reg_home->listar_registros_nuevos($idcategoria, 3, 4);
							if(count($listado_registros_nuevos) > 0)
							{
						?>
							<ul class="products-grid">
								<?php foreach($listado_registros_nuevos as $item) { ?>
									<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<?php listado_item_producto($item); ?>
									</li>	
								<?php } ?>						  
							</ul>
						<?php
							}else{
						?>
							<h4 align="center">No hay productos nuevos</h4>
						<?php } ?> 
					  </div>
					</div>
					<?php
						$num++;
					}
				}
				?>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<section class="new-arrivals-pro">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 featured-pro-block">
          <div class="home-block-inner">
            <div class="block-title">
              <h2>Productos destacados</h2>
            </div>
          </div>
		  <?php $listado_productos_destacados = $datos_reg_home->listar_registros_destacados(3, 6); ?>	
			
          <div class="slider-items-products">
			<?php if(count($listado_productos_destacados) > 0){ ?>  
            <div class="new-arrivals-block">
              <div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid block-content">
				  <?php foreach($listado_productos_destacados as $item){ ?>		
                  <div class="item">
                    <?php listado_item_producto($item); ?>
                  </div>
                  <?php } ?>                  
                </div>
              </div>
            </div>
			<?php }else{ ?>  
			<h4 align="center">No hay productos nuevos</h4>  
			<?php } ?>  
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <div class="container">
    <div class="row">       		
      <div class="col-md-6 col-sm-12 custom-slider-wrap">
        <?php echo mostrar_modulo_web(83, 2); ?>
      </div>
      <div class="col-md-6 col-sm-12 custom-slider-wrap">
        <?php echo mostrar_modulo_web(87, 2); ?>
      </div>
    </div>
  </div>
  
  <div class="our-features-box">
    <div class="container">
      <div class="features-block">
        <div class="col-md-3 col-xs-12 col-sm-6">		 
		<?php echo mostrar_modulo_web(91, 3); ?>
        </div>
        <div class="col-md-3 col-xs-12 col-sm-6">
		<?php echo mostrar_modulo_web(92, 3); ?>	          
        </div>
        <div class="col-md-3 col-xs-12 col-sm-6">
        <?php echo mostrar_modulo_web(93, 3); ?>	   
        </div>
        <div class="col-md-3 col-xs-12 col-sm-6">
		<?php echo mostrar_modulo_web(94, 3); ?>	  	
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
