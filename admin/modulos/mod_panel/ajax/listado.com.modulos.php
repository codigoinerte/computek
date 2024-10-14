<?php $array_listado = $datos_registro->listar_registro_tipo($tipo_registro); ?>

 
  <div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Listado modulos
    </div>
    <div class="panel-body">
	  <?php if(count($array_listado) >0){ ?>	
      <table id="listado_paginacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="30">#</th>
                <th>Nombre modulo</th>
                <th>Estado</th>
                <th>Orden</th>
                <th width="80">Acciones</th>
            </tr>
        </thead>
        <tbody>
			<?php
		$num=1;												
		foreach($array_listado as $item){
			$_item_id = isset($item["id"])?$item["id"]:0;
			$_item_orden = isset($item["orden"])?$item["orden"]:'';
			$_item_estado = isset($item["estado"])?$item["estado"]:'';
			$_item_nombre = isset($item["nombre"])?$item["nombre"]:'';
			$_item_pagina = isset($item["nombre_pagina"])?$item["nombre_pagina"]:'';
			
			
			$url_detalle = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=edit&ID=$_item_id";
			?>
            <tr>
                <td width="30"><?php echo $num; ?></td>
                <td><?php echo $_item_nombre; ?></td>
                <td width="70"><?php echo $_item_estado; ?></td>                               
                <td width="50"><?php echo $_item_orden; ?></td>                
                <td width="80">
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Accion <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo $url_detalle; ?>">Editar</a></li>
					<li><a style="cursor: pointer" onClick="javascript:eliminar(<?php echo $_item_id; ?>, '<?php echo $url_form_eliminar; ?>')">Eliminar</a>
				  </ul>
				</div>				
				</td>
            </tr>
			<?php $num++; } ?>
        </tbody>
    </table>
	<?php }else{ ?>	
		<h4 align="center">No se han encontrado registros</h4>
	<?php } ?>		
    </div>
 </div>

