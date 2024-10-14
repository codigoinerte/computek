<section class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          
          <article >
            <h2 class="page-heading"> <span class="page-heading-title"><?php echo $nombre_registro; ?></span> </h2>
     
		<?php
        ########################################################################################
        #############################CONTROL DE PAGINACION######################################
        $contar_categorias = $datos_reg_home->contar_registros_productos($id_registro,1);
        $numeroRegistros = $contar_categorias[0]['count(*)'];
		$pag = isset($_GET["pag"])?$_GET["pag"]:'';

        $array = paginacion($numeroRegistros, $pag);    
		list($tamPag, $limitInf, $pagina, $numPags, $numeroRegistros)  = $array;

        ###########################################################################################
        $lproductos = $datos_reg_home->listar_registros_productos($id_registro,1,$limitInf,$tamPag);		
        ################################DISEÑO DE CATALOGO#########################################
        if($numeroRegistros > 0)
        {
        ?>
		<div class="category-products">
		  <ul class="products-grid">
			<?php				
			foreach($lproductos as $item)
			{
				?>
			  	<div class="item col-lg-3 col-md-4 col-sm-4 col-xs-6">
			  	<?php listado_item_producto($item); ?>
			  	</div>
			  	<?php
				
			}
			?>
		  </ul>
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