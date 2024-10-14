<section class="main-container col2-left-layout">

    <div class="container">

      <div class="row">

        <div class="col-sm-12">
          <article >

            <h2 class="page-heading"> <span class="page-heading-title"><?php echo $nombre_registro; ?></span> </h2>


		<?php

        ########################################################################################

        #############################CONTROL DE PAGINACION######################################

        $contar_categorias = $datos_reg_home->contar_registros_productos($id_registro,2);

        $numeroRegistros = $contar_categorias[0]['count(*)'];

		$pag = isset($_GET["pag"])?$_GET["pag"]:'';



        $array = paginacion($numeroRegistros, $pag);    

		list($tamPag, $limitInf, $pagina, $numPags, $numeroRegistros)  = $array;



        ###########################################################################################

        $lproductos = $datos_reg_home->listar_registros_productos($id_registro,2,$limitInf,$tamPag);		

        ################################DISEÑO DE CATALOGO#########################################

        if($numeroRegistros > 0)

        {

        ?>

		<div class="row">
			<?php				

			foreach($lproductos as $item)
			{
				$item_subcategoria = isset($item["nombre"])?$item["nombre"]:'';
				$item_alias = isset($item["alias"])?$item["alias"]:'';
				$item_id = isset($item["id"])?$item["id"]:'';
				
				$url_subcategoria = URL_WEB.$item_alias;
				?>
				<?php #listado_item_producto($item); ?>
				<div class="col-md-12 col-sm-12 col-xs-12 featured-pro-block">
					  <div class="home-block-inner">
						<div class="block-title">
						  <h2><a href="<?php echo $url_subcategoria; ?>"><?php echo $item_subcategoria; ?></a></h2>
						</div>
					  </div>
					  <?php $listado_productos_destacados = $datos_reg_home->listar_registros_destacadosxpadre(3, 6, $item_id);
				#listar_registros_destacados(3, 6); ?>	

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
						  <div class="clearfix"></div>
						  <div class="row">
						  	<div class="col-xs-12 text-center">
							  <a class="btn btn-lg link" href="<?php echo $url_subcategoria; ?>">Ver m&aacute;s</a>
							</div>
						  </div>
						<?php }else{ ?>  
						<h4 align="center">No hay productos nuevos</h4>  
						<?php } ?>  
					  </div>
					</div>


			  	<?php

				

			}

			?>
		</div>

        <?php



        ###########################################################################################





        ###############################DISEÑO DE PAGINACION########################################



        ?>

		<div class="toolbar">	

			<div class="row">

				<div class="col-xs-12">

			<?php 

			if($numeroRegistros > 9):

				$_alias_registro = $_alias."_";

				echo '<nav aria-label="Page navigation">';

				echo '<div class="pager"><div class="pages"><ul class="pagination ">';

				if($pagina>1) 

				{ 

				   echo '<li><a href="'.URL_WEB.$_alias_registro.($pagina-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';

				} 

				for($i=$inicio;$i<=$final;$i++) 

				{ 

				   if($i==$pagina) 

				   { 

					  echo '<li class="active"><a href="#">'.$i.'<span class="sr-only">(current)</span></a></li>';

				   }

				   else

				   { 

					  echo '<li><a href="'.URL_WEB.$_alias_registro.$i.'">'.$i.'</a></li>';

				   } 

				} 

				if($pagina<$numPags) 

				{ 

				   echo '<li><a href="'.URL_WEB.$_alias_registro.($pagina+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';

				} 

				echo '</ul></div></div>';

				echo '</nav>';

			endif;   

			?>

			</div>	

			</div>

		</div>	

        <?php

        }

        else

        {

        ?>

        <div class="row margin-bottom-30">

        <div class="col-xs-12">

	        <h3 align="center">No hay registros</h3>

        </div>

        </div>

        <?php

        }

        ?> 

            

          </article>

          <!--	///*///======    End article  ========= //*/// --> 

        </div>

        

      </div>

    </div>

  </section>			  