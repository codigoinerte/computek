<?php $array_listado = $datos_mail->listado_mail(); ?>

  <div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Listado correos registrados
    </div>
    <div class="panel-body">
	  <?php if(count($array_listado) >0){ ?>	
      <table id="listado_paginacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="30">#</th>
                <th>Nombre</th>
				<th width="150">Tipo correo</th>
                <th width="150">correo</th>
                <th width="250">asunto</th>              
                <th width="250">Atenci&oacute;n</th>              
                <th width="80">Acciones</th>                
            </tr>
        </thead>
        <tbody>
			<?php
		$num=1;												
		foreach($array_listado as $item){
			$_item_id = isset($item["id"])?$item["id"]:0;
			$_item_nombre= isset($item["nombre"])?$item["nombre"]:'';			
			$_item_tipo_correo= isset($item["tipo_correo"])?$item["tipo_correo"]:'';			
			$_item_correo= isset($item["correo"])?$item["correo"]:'';			
			$_item_asunto= isset($item["asunto"])?$item["asunto"]:'';	
			
			$_item_usuario= isset($item["usuario"])?$item["usuario"]:'';			
			$_item_tipo= isset($item["tipo"])?$item["tipo"]:'';			
			
			$url_detalle = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=edit&ID=$_item_id";
			?>
            <tr>
                <td width="30"><?php echo $num; ?></td>
                <td><?php echo $_item_nombre; ?></td>                
                <td><?php echo $_item_tipo_correo; ?></td>                
                <td><a href="mailto:<?php echo $_item_correo; ?>"><?php echo $_item_correo; ?></a></td> 
                <td><?php echo $_item_asunto; ?></td> 
                <td><?php echo $_item_tipo; ?>
					<?php if($_item_usuario!=''): ?>
					<br>
					<span class="badge btn-primary"><?php echo $_item_usuario; ?></span>					
					<?php endif; ?>
				</td> 
				<td width="80">
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Accion <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo $url_detalle; ?>">Editar</a></li>					
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

