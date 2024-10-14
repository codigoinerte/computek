  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <div class="col-sm-9">
        <div class="col-main">
          <div class="page-title">
            <h2><?php echo $nombre_registro; ?></h2>
          </div>
          <div class="blog-wrapper" id="main">
            <div class="site-content" id="primary">
              <div role="main" id="content">
               		<?php
				    $listado_relacionados = $datos_reg_home-> listar_registro_relacionados($id_registro, 3);
				  	if(count($listado_relacionados) > 0)
					{
						foreach($listado_relacionados as $item)
						{
							 $_item_alias = isset($item["alias"])?$item["alias"]:'';
							 $_item_nombre = isset($item["nombre"])?$item["nombre"]:'';
							 $_item_descripcion = isset($item["descripcion"])?$item["descripcion"]:'';
						?>
						<article class="blog_entry clearfix wow">
						  <header class="blog_entry-header clearfix">
							<div class="blog_entry-header-inner">
							  <h2 class="blog_entry-title">
								<a rel="bookmark" href="<?php echo URL_WEB.$_item_alias; ?>"><?php echo $_item_nombre; ?></a>
							  </h2>
							</div>
							<!--blog_entry-header-inner--> 
						  </header>
						  <div class="entry-content">						
							<div class="entry-content">						
							  <?php echo strip_tags(add3dots($_item_descripcion, 300)); ?>
							</div>
							<p> <a class="btn" href="blog_single_post.html">Read More</a> </p>
						  </div>					  
						</article>
						<?php
						}
					}
					?>	
              </div>
            </div>
            
          </div>
        </div></div>
        <div class="col-right sidebar col-sm-3 col-xs-12">
          <?php include ("lateral.php"); ?>
        </div>
      </div>
    </div>
  </div>
