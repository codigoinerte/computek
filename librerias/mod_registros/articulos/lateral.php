<div class="block block-company">
<div class="block-title">Articulos relacionados</div>
<div class="block-content">
  <ol id="recently-viewed-items">
	<?php
	  #echo "TIPO = $idtipo_archivo";
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
		  foreach($listado_relacionados as $item)
		  {
			  $_item_alias = isset($item["alias"])?$item["alias"]:'';
			  $_item_nombre = isset($item["nombre"])?$item["nombre"]:'';
			  if($_item_alias==$_alias)
			  {
				  ?>
					 <li class="item odd"><strong><?php echo $_item_nombre; ?></strong></li>
				  <?php		
			  }
			  else
			  {
				  ?>
					<li class="item even"><a href="<?php echo URL_WEB.$_item_alias; ?>"><?php echo $_item_nombre; ?></a></li>
				  <?php
			  }
		  }
	  }
	  ?>  

  </ol>
</div>
</div>