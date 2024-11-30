<?php
$type = 0;
if($_alias == "oficina"){
    $type = 1;
}else if($_alias == "gamer"){
    $type = 2;
}else if($_alias == "empresarial"){
    $type = 3;
}
?>
<nav
	class="container mx-auto my-10 flex flex-wrap items-center gap-2 px-4 sm:px-8 xl:px-4 breadcrumb">
	<div class="flex items-center gap-2">
	<a href="<?php echo URL_WEB; ?>">
		<svg class="h-5 w-5 text-primary-500" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
		<path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path>
		</svg>
	</a>
	<svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-slate-500" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		<polyline points="9 18 15 12 9 6"></polyline>
	</svg>
	</div>
	<div class="flex items-center gap-2">
	<a class="pointer-events-none text-slate-400" href="#"><?php echo ucwords($_alias); ?></a>
	</div>
</nav>
<section class="container mx-auto px-4 sm:px-8 xl:px-4">
	<div class="mb-6 grid grid-cols-6 gap-7">
		<div class="order-1 col-span-12 lg:order-2 lg:col-span-6">

		<?php
        ########################################################################################
        #############################CONTROL DE PAGINACION######################################
        $contar_categorias = $datos_reg_home->contar_especiales($type);
        $numeroRegistros = $contar_categorias[0]['count(*)'];
		$pag = isset($_GET["pag"])?$_GET["pag"]:'';

        $array = paginacion($numeroRegistros, $pag);    
		list($tamPag, $limitInf, $pagina, $numPags, $numeroRegistros, $inicio, $final)  = $array;

        ###########################################################################################
        $lproductos = $datos_reg_home->listar_especiales($type, $limitInf,$tamPag);		
        ################################DISEÑO DE CATALOGO#########################################
        if($numeroRegistros > 0)
        {
        ?>
		<div class="grid grid-cols-md-6 grid-cols-8 gap-5">
			<?php				
			foreach($lproductos as $item)
			{
				?>
			  	<div class="col-span-6 sm:col-span-3 lg:col-span-2">
			  		<?php listado_item_producto($item); ?>
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