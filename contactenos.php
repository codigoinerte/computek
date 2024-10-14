 <?php 
$_SESSION['secure'] = md5(COD_SEG); 
$_SESSION['token'] = $token = uniqid();
/*CODIFICACION VARIABLES*/
$campo_nombres = "nombres".md5($token.'nombres');
$campo_correo = "correo".md5($token.'correo');
$campo_telefono = "telefono".md5($token.'telefono');
$campo_empresa = "empresa".md5($token.'empresa');
$campo_asunto = "asunto".md5($token.'asunto');
$campo_mensaje = "mensaje".md5($token.'mensaje'); 
$campo_producto= "producto".md5($token.'producto'); 

$_info = isset($_GET["var"])?$_GET["var"]:'';
#echo $_GET["info"];
if($_info!='')
{
	if($_info==1)
	{
		$mensaje='Su mensaje fue enviado satisfactoriamente, gracias por contactarte con nosotros';
		$class='alert-success';
		$icono='<i class="fa fa-check fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==2)
	{
		$mensaje='Debe completar todos los campos requeridos para poder registrarse';
		$class='alert-danger';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==3)
	{
		$mensaje='Por favor, revise el campo de captcha';
		$class='alert-danger';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==4)
	{
		$mensaje='Ah ocurrido un error vuelva a intentarlo mas tarde';
		$class='alert-danger';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}	
	else
	{
		$mensaje='Verifique los campos ingresados y vuelva a intentarlo';
		$class='alert-danger';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
}
?>
<div class="breadcrumbs">
<div class="container">
  <div class="row">
	<div class="col-xs-12">
	  <ul>
		<li class="home"> <a title="Ir a la página de inicio" href="<?php echo URL_WEB; ?>">Inicio</a> <span>/</span> </li>
		<li class="category1601"> <strong>Contactenos</strong> </li>
	  </ul>
	</div>
  </div>
</div>
</div>

<!-- main-container -->
<div class="main-container col2-right-layout">
<div class="main container">
  <div class="row">
	<div class="col-xs-12">
		<?php
		if($_info!='')
		{
			?>
			<div class="alert <?php echo $class; ?> alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong><?php echo $mensaje; ?></strong>
			</div>
			<?php
		}
		?>	  
	</div>	
  </div>	
  <div class="row">
	<section class="col-sm-9 wow">
	<div class="col-main">
	  <div class="page-title">
		<h2>Contactenos</h2>
	  </div>
	  <div class="static-contain">
		<form class="group-select" action="<?php echo URL_WEB; ?>librerias/mod_contactenos/parse.php" method="post">
		  <ul>
			<li>
			  <fieldset>				
				<ul>
				  <li>
					<div class="customer-name">
					  <div class="input-box name-firstname">
						<label for="billing:firstname">Nombres<span class="required">*</span></label>
						<br>
						<input type="text" name="<?php echo $campo_nombres; ?>" title="Nombres" class="input-text">
					  </div>
					  <div class="input-box name-lastname">
						<label for="billing:lastname">Correo<span class="required">*</span> </label>
						<br>
						<input type="email" name="<?php echo $campo_correo; ?>" title="Correo" class="input-text">
					  </div>
					</div>
				  </li>
				  <li>
					<div class="input-box">
					  <label>Empresa</label>
					  <br>
					  <input type="text" name="<?php echo $campo_empresa; ?>" title="Company" class="input-text">
					</div>
					<div class="input-box">
					  <label>Tel&eacute;fono <span class="required">*</span></label>
					  <br>
					  <input type="text" name="<?php echo $campo_telefono; ?>" title="Telefono" class="input-text">
					</div>
				  </li>
				  <li>
					<label>Asunto <span class="required">*</span></label>
					<br>
					<select class="input-text" name="<?php echo $campo_asunto; ?>">
						<option value="Solicitar coitzación">Solicitar coitzaci&oacute;n</option>
						<option value="Consulta">Consulta</option>
					</select>  
				  </li>
				  <li class="">
					<label for="comment">Mensaje<em class="required">*</em></label>
					<br>
					<div style="float:none" class="">
					  <textarea name="<?php echo $campo_mensaje; ?>" title="Mensaje" class="required-entry input-text" cols="5" rows="3" required></textarea>
					</div>
				  </li>
				</ul>
			  </fieldset>
			</li>						
			<div class="buttons-set">
			  <button type="submit" title="Submit" class="button submit"> <span> Enviar mensaje </span> </button>
			</div>
		  </ul>
		</form>
	  </div>
	</div>
	</section>
	<aside class="col-right sidebar col-sm-3 col-xs-12 wow">
	  <div class="block block-company info-contactenos">
		<div class="block-title">Informaci&oacute;n</div>
		<div class="block-content">
		  <?php
			echo contacto_empresa_listado(5);
			echo contacto_empresa_listado(1);
			echo contacto_empresa_listado(2);
			echo contacto_empresa_listado(4);
		  ?>		
		</div>
	  </div>
	</aside>
  </div>
</div>
</div>
<!--End main-container -->
<div class="mapa">
<?php echo modulo_mapa(127); ?>
</div>