<section class="container mx-auto px-4 sm:px-8 xl:px-4">
	<div class="mb-6 grid grid-cols-6 gap-7">
		<div class="order-1 col-span-12 lg:order-2 lg:col-span-6">

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
			
			foreach($lproductos as $item)
			{
				$item_subcategoria = isset($item["nombre"])?$item["nombre"]:'';
				$item_alias = isset($item["alias"])?$item["alias"]:'';
				$item_id = isset($item["id"])?$item["id"]:'';
				
				$url_subcategoria = URL_WEB.$item_alias;

				$listado_productos_destacados = $datos_reg_home->listar_registros_destacadosxpadre(3, 6, $item_id);
				?>
				
						
					
								<div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
									<h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
										<a href="<?php echo $url_subcategoria; ?>"><?php echo $item_subcategoria; ?></a>
									</h2>
								</div>								
																						
								<?php if(count($listado_productos_destacados) > 0){ ?>  
								
								<div class="grid grid-cols-md-6 grid-cols-8 gap-5">
								<?php foreach($listado_productos_destacados as $item){ ?>		
									<div class="col-span-6 sm:col-span-3 lg:col-span-2">
										<?php listado_item_producto($item); ?>
									</div>
								<?php } ?>                  
								</div>
								
								<div class="clearfix"></div>

								<div class="flex justify-center align-center">
									<a class="btn-show-more" href="<?php echo $url_subcategoria; ?>">Ver m&aacute;s</a>									
								</div>
								<?php }else{ ?>  
								<h4 align="center">No hay productos nuevos</h4>  
								<?php } ?>  


							
						
							
				<?php
			}

        ###########################################################################################
        ###############################DISEÑO DE PAGINACION########################################

        ?>
		
		<div class="toolbar">	
			<div class="row">
				<div class="col-xs-12">
					<?php 
					if($numeroRegistros > 9):
						$_alias_registro = $_alias."_";						
						echo '<div class="my-8 flex items-center justify-between"><ul class="flex items-center">';
						if($pagina>1) 
						{ 					
							echo '<li class="px-3 py-2 text-gray-400">
									<a href="'.URL_WEB.$_alias_registro.($pagina-1).'" aria-label="Previous">
										<svg
											class="h-5 w-5"
											stroke="currentColor"
											fill="none"
											stroke-width="2"
											viewBox="0 0 24 24"
											stroke-linecap="round"
											stroke-linejoin="round"
											height="200px"
											width="200px"
											xmlns="http://www.w3.org/2000/svg">
											<line x1="19" y1="12" x2="5" y2="12"></line>
											<polyline points="12 19 5 12 12 5"></polyline>
										</svg>
									</a>
								</li>';
						} 
						for($i=$inicio;$i<=$final;$i++) 
						{ 
							if($i==$pagina) 
							{ 
								echo '<li class="cursor-pointer rounded-lg bg-primary-500 px-3 py-2 text-white">'.$i.'</li>';
							}
							else
							{ 
								echo '<li class="cursor-pointer rounded-lg px-3 py-2"><a href="'.URL_WEB.$_alias_registro.$i.'">'.$i.'</a></li>';
							} 
						} 
						if($pagina<$numPags) 
						{ 
							echo '<li class="cursor-pointer rounded-lg px-3 py-2 text-primary-500">
									<a href="'.URL_WEB.$_alias_registro.($pagina+1).'" aria-label="Next">
										<svg
											class="h-5 w-5"
											stroke="currentColor"
											fill="none"
											stroke-width="2"
											viewBox="0 0 24 24"
											stroke-linecap="round"
											stroke-linejoin="round"
											height="200px"
											width="200px"
											xmlns="http://www.w3.org/2000/svg">
											<line x1="5" y1="12" x2="19" y2="12"></line>
											<polyline points="12 5 19 12 12 19"></polyline>
										</svg>
									</a>
								</li>';
						} 
						echo '</ul></div>';			
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


			<div class="grid grid-cols-6 gap-5">
				<div class="col-span-6 sm:col-span-3 lg:col-span-2">

					<h3 align="center">No hay registros</h3>

				</div>
			</div>

			<?php

        }

        ?> 

		</div>
	</div>
</section>
