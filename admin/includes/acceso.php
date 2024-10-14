<!DOCTYPE html>
<html lang="es" class="">
<head>
  <meta charset="utf-8" />
 <title><?php echo $sistema_title; ?></title>
  <meta name="description" content="<?php echo $sistema_descripcion; ?>" />
  <meta name="keywords" content="<?php echo $sistema_keyword; ?>" />
  <meta name="author" content="Fredy Jhoel Martinez Bustamante">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" href="<?php echo $sistema_favicon; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo $sistema_favicon; ?>" type="image/x-icon">		
  <?php include("header.css.php"); ?>
</head>
<body class="bg-black">
<div class="app app-header-fixed bg-black">
<?php
	$result=isset($_GET["result"])?$_GET["result"]:0;
	$mensaje=$clase="";
	if($result==2)
	{
		$mensaje="Contraseña incorrecta";
		$clase ="alert-warning";
	}
	else if($result==3)
	{
		$mensaje="Usuario incorrecto";
		$clase ="alert-warning";
	}
	else if($result==4)
	{
		$mensaje="Usuario y contraseña incorrecto";	
		$clase ="alert-warning";
	}
	else if($result==5)
	{
		$mensaje="Se restauro correctamente su contraseña, verifique su correo";	
		$clase ="alert-success";
	}
	else if($result==6)
	{
		$mensaje="Usuario no verificado";
		$clase ="alert-warning";
	}
	else
	{
		$mensaje="Ah ocurrido un error vuelva a intentarlo mas tarde";
		$clase ="alert-danger";
	}
	
?>	

    <div class="container w-xxl w-auto-xs " ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href="<?php echo URL_WEB_ADMIN; ?>" class="navbar-brand block m-t">
	<img src="<?php echo $sistema_logo; ?>"  height="150" alt="">	
  </a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong><?php echo $sistema_title; ?></strong>
    </div>
	  	<div class="row">
	  		<div class="col-xs-12">
				<?php if($result > 0){ ?>
				<div class="alert <?php echo $clase; ?> alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong><?php echo $mensaje; ?></strong>
				</div>				
				<?php } ?>
			</div>
	  	</div>
	  	<div id="login_acceso">
		<form method="post"  action="<?php echo URL_WEB_ADMIN."modulos/mod_config/scripts/config.login.script.php"; ?>">
		  <div class="text-danger wrapper text-center">          
		  </div>
		  <div class="list-group list-group-sm">
			<div class="list-group-item">
			  <input type="text" placeholder="Usuario" name="usuario" class="form-control no-border" required>
			</div>
			<div class="list-group-item">
			   <input type="password" placeholder="contraseña" name="password" class="form-control no-border" required>
			</div>
		  </div>
		  <input type="hidden" name="action" id="action" value="acceso">		
		  <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>         
		</form>	  
		<div class="text-center m-t m-b"><a style="cursor: pointer" onClick="javascript:tog('login_acceso','recuperar_acceso');">Recuperar contrase&ntilde;a</a></div>
		</div>
	  
	    <div id="recuperar_acceso" style="display: none">
		<form method="post"  action="<?php echo URL_WEB_ADMIN."modulos/mod_config/scripts/config.login.script.php"; ?>">
		  <div class="text-danger wrapper text-center">          
		  </div>
		  <div class="list-group list-group-sm">
			<div class="list-group-item">
			  <input type="text" placeholder="Usuario" name="usuario" class="form-control no-border" required>
			</div>
			<div class="list-group-item">
			   <input type="email" placeholder="Correo" name="correo" class="form-control no-border" required>
			</div>
		  </div>
		  <input type="hidden" name="action" id="action" value="recuperar">		
		  <button type="submit" class="btn btn-lg btn-primary btn-block">Recuperar</button>         
		</form>	  
		<div class="text-center m-t m-b"><a style="cursor: pointer" onClick="javascript:tog('recuperar_acceso','login_acceso');">Regresar</a></div>
	    </div>
    <div class="line line-dashed"></div>   	  
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted">Sistema de administraci&oacute;n web.<br/><a href="mailto:fredy.webmaster@gmail.com">fredy.webmaster@gmail.com</a><br>&copy; <?php echo date("Y"); ?></small>
</p>
  </div>
			
</div>


</div>

<?php include("footer.js.php"); ?>
</body>
</html>
