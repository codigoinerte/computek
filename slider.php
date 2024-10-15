<!-- slider -->
<?php

	$listado_slider = $datos_reg_home->listar_registroxtipo(12);
	if(count($listado_slider) > 0)
	{		
		?>
			<div class="my-5 overflow-hidden">
			<div class="container mx-auto px-4 sm:px-8 xl:px-4">
				<div
				class="swiper swiper-hero group relative flex items-center rounded-lg">
				<div class="swiper-wrapper">

					<?php
					foreach($listado_slider as $item){
						$titulo = isset($item["nombre"])?$item["nombre"]:'';
						$descripcion = isset($item["descripcion"])? strip_tags($item["descripcion"]):'';
						$url = isset($item["url"])?$item["url"]:'';
						$iddestacado = isset($item["iddestacado"])?$item["iddestacado"]:0;
						$imagen = isset($item["imagen_principal"])?URL_WEB."images/media/".$item["imagen_principal"]:'';
						?>
							<div class="swiper-slide">
								<div class="block">
									<a href="<?php echo $url; ?>" target="_blank">
										<img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" />
									</a>
								</div>
							</div>
						<?php
					}
					?>
				</div>
				<div class="swiper-pagination"></div>
				<div
					class="button-prev absolute -left-[999px] z-[1] hidden select-none rounded-xl bg-primary-500 px-4 py-2 text-white transition-all duration-300 hover:bg-primary-600 group-hover:left-3 sm:block">
					&#10094;
				</div>
				<div
					class="button-next absolute -right-[999px] z-[1] hidden select-none rounded-xl bg-primary-500 px-4 py-2 text-white transition-all duration-300 hover:bg-primary-600 group-hover:right-3 sm:block">
					&#10095;
				</div>
				</div>
			</div>
			</div>
		<?php
	}
?>