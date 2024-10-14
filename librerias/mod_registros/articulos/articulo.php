<?php
$datos_registro = $datos_reg_home->detalle_registro($id_registro);
$_titulo_ = isset($datos_registro[0]["nombre"])?$datos_registro[0]["nombre"]:'';
$_descripcion_ = isset($datos_registro[0]["descripcion"])?$datos_registro[0]["descripcion"]:'';


?>
  <!-- main-container -->
<div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow">
        <div class="col-main">
          <div class="page-title">
            <h2><?php echo $_titulo_; ?></h2>
          </div>
		  <?php if(count($datos_registro_galeria) > 0){ ?>	
		  <div class="featured-thumb">
			  <ul class="rslides">
				 <?php foreach($datos_registro_galeria as $item){ 
				  $_imagen = isset($item["imagen"])?URL_WEB."images/media/".$item["imagen"]:'';				  
				  ?> 
				  <li><a data-fancybox="gallery" href="<?php echo $_imagen; ?>"><img src="<?php echo $_imagen; ?>" alt="<?php echo $_titulo_; ?>"></a></li>
				  <?php } ?>
				</ul>
		  </div>	   		
		  <?php } ?>	
          <div class="static-contain">
            <?php echo $_descripcion_; ?>
          </div></div>
        </section>
        <aside class="col-right sidebar col-sm-3 col-xs-12 wow">
          <?php include("lateral.php"); ?>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container -->
