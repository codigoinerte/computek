  <section class="container mx-auto px-4 sm:px-8 xl:px-4">
	<div class="mb-6 grid grid-cols-8 gap-7">
		<div class="order-2 col-span-8 lg:order-1 lg:col-span-2">
			<?php include ("lateral.php"); ?>
		</div>
		<div class="order-1 col-span-8 lg:order-2 lg:col-span-6">
			<div class="grid grid-cols-6 gap-5">
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
						<div class="group col-span-6 overflow-hidden rounded-lg bg-white shadow-[0_2px_10px_rgba(131,125,125,.12)] sm:col-span-3 lg:col-span-2">
							<div class="px-5 pb-5 pt-6">
								<a href="<?php echo URL_WEB.$_item_alias; ?>" class="line-clamp-2 text-base font-bold text-default-600 transition-all duration-300 hover:text-primary-500">
									<?php echo $_item_nombre; ?>
								</a>
								<p class="my-2 line-clamp-3 break-all">
									<?php echo strip_tags(add3dots($_item_descripcion, 300)); ?>
								</p>
								<a class="mt-2 inline-block text-primary-500 underline transition-all duration-300 hover:no-underline" href="<?php echo URL_WEB.$_item_alias; ?>">
									Leer m&aacute;s
								</a>
							</div>
						</div>
						<?php
						}
					}
				?>	
			</div>
		</div>
	</div>
  </section>