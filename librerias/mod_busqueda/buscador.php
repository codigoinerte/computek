<?php 
	#print_r($_POST);
	include_once ("clases/class.buscador.php");
	$datos_buscar = new busqueda();
	$busqueda='';
	$post = isset($_POST['buscar'])?$_POST['buscar']:'';
	$get = $_var;

	if($post!= '')
	{
		$busqueda = $post;
	}
	else if( $get != '')
	{
		$busqueda = $get;
	}
?>

<?php ##################################################################### ?>

<section class="container mx-auto px-4 sm:px-8 xl:px-4">
	<div class="mb-6 grid grid-cols-6 gap-7">
		<div class="order-1 col-span-12 lg:order-2 lg:col-span-6">

				<div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
					<h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
						<?php echo $nombre_registro; ?>
					</h2>
				</div>	

            	<?php if($busqueda!=''){ ?>
				<?php

				$contar_busqueda = $datos_buscar->contar_busqueda_productos_web($busqueda);

				$numeroRegistros = $contar_busqueda[0]['count(*)'];
				$tamPag=9; 

				if(!isset($_GET["pag"])) 
				{ 
				$pagina=1; 
				$inicio=1; 
				$final=$tamPag; 
				}else{ 
				$pagina = $_GET["pag"]; 
				} 
				$limitInf=($pagina-1)*$tamPag; 

				$numPags=ceil($numeroRegistros/$tamPag); 
				if(!isset($pagina)) 
				{ 
				$pagina=1; 
				$inicio=1; 
				$final=$tamPag; 
				}else{ 
				$seccionActual=intval(($pagina-1)/$tamPag);
				$Prod_Actual=ceil(($pagina-1)/$tamPag);  
				$inicio=($seccionActual*$tamPag)+1; 
				$inicio_prod=($Prod_Actual*$tamPag)+1; 

				if($pagina<$numPags) 
				{ 
					$final=$inicio+$tamPag-1;
					$final_prod=$inicio+$tamPag-1;
				}else{ 
					$final=$numPags;
					$final_prod=$numeroRegistros;
				} 

				if ($final>$numPags){ 
					$final=$numPags; 
				} 
				} 
				$lbusqueda = $datos_buscar->busqueda_productos_web($busqueda,$limitInf, $tamPag);
				if($busqueda!='')
				{
					$array_terminos = explode(" ",$busqueda);
					echo '<div class="row mt-10 mb-10"><div class="col-12">';
					echo '<ul class="terminos_de_busqueda">';
						if(count($array_terminos) > 1)
						{
							for($x=0;$x<count($array_terminos);$x++)
							{
								echo '<li><a href="'.URL_WEB.$_alias."/".$array_terminos[$x].'">'.$array_terminos[$x].'</a></li>';		
							}
						}
						echo '<li><a href="'.URL_WEB.$_alias."/".$busqueda.'">'.$busqueda.'</a></li>';
					echo '</ul>';
					echo '</div></div>';
				}

				if($numeroRegistros > 0)
				{
					?>
						<div class="grid grid-cols-md-6 grid-cols-8 gap-5">
							<?php				
								foreach($lbusqueda as $item)
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
						<div class="row margin-bottom-30">
							<div class="col-xs-12">
								<h3 align="center">No hay registros</h3>
							</div>
						</div>
					<?php
				}
				?> 
				<?php }else{ ?>
					<div class="row margin-bottom-30">
							<div class="col-xs-12">
								<h3 align="center">No hay registros</h3>
							</div>
						</div>
				<?php } ?>
            
      </div>
    </div>
  </section>			  