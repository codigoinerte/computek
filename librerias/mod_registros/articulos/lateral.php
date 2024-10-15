<?php  
	if($idtipo_archivo==1)
	{
		$listado_relacionados = $datos_reg_home-> listar_registro_relacionados($id_registro, 3);  
	}
	else
	{
		$listado_relacionados = $datos_reg_home-> listar_registro_relacionados($na_id, 3);	  
	}
	if(count($listado_relacionados) > 0)
	{
	?>
	<div class="mb-5 rounded-lg bg-white p-4">
		<div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
			<h2 class="relative text-xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
				Articulos relacionados
			</h2>
		</div>
		<ul>

			<?php
			foreach($listado_relacionados as $item)
			{
				$_item_alias = isset($item["alias"])?$item["alias"]:'';
				$_item_nombre = isset($item["nombre"])?$item["nombre"]:'';
				if($_item_alias==$_alias)
				{
					?>
						<li>
							<div class="group flex items-center cursor-pointer">
								<div class="flex items-center gap-2">
								<svg class="h-3 w-3 transition-all duration-300 group-hover:text-primary-500" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A.998.998 0 0 0 5 3v18a1 1 0 0 0 .536.886zM7 4.909 17.243 12 7 19.091V4.909z"></path>
								</svg>
								<span class="transition-all duration-300 group-hover:translate-x-2 group-hover:text-primary-500">
								<?php echo $_item_nombre; ?>
								</span>
								</div>
							</div>
						</li>
					<?php		
				}
				else
				{
					?>
						<li>
							<a class="group flex items-center" href="<?php echo URL_WEB.$_item_alias; ?>">
								<div class="flex items-center gap-2">
								<svg class="h-3 w-3 transition-all duration-300 group-hover:text-primary-500" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A.998.998 0 0 0 5 3v18a1 1 0 0 0 .536.886zM7 4.909 17.243 12 7 19.091V4.909z"></path>
								</svg>
								<span class="transition-all duration-300 group-hover:translate-x-2 group-hover:text-primary-500">
								<?php echo $_item_nombre; ?>
								</span>
								</div>
							</a>
						</li>				  
					<?php
				}
			}
			?>


		</ul>
	</div>
	<?php
	}
?>