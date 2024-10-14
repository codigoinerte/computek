<?php if ( !is_bot($_SERVER['HTTP_USER_AGENT']) ) { estadisticas_admin($SisID); } ?>
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
<body>
<div class="app app-header-fixed " onUnload="cierraNav()">
  

    <!-- header -->
  <header id="header" class="app-header navbar" role="menu">
      <!-- navbar header -->
      <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="<?php echo URL_WEB_ADMIN."?token=$get_token"; ?>" class="navbar-brand text-lt">          
          <img src="<?php echo $sistema_logo; ?>" alt="<?php echo URL_WEB_ADMIN; ?>">         
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="app-aside-folded" target=".app">
            <i class="fa fa-dedent fa-fw text"></i>
            <i class="fa fa-indent fa-fw text-active"></i>
          </a>
          <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="show" target="#aside-user">
            <i class="icon-user fa-fw"></i>
          </a>
        </div>
        <!-- / buttons -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
		 <!-- dropdown  	
          <li class="dropdown">
			
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              <i class="icon-bell fa-fw"></i>
              <span class="visible-xs-inline">Notifications</span>
              <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
            </a>
           
            <div class="dropdown-menu w-xl animated fadeInUp">
              <div class="panel bg-white">
                <div class="panel-heading b-light bg-light">
                  <strong>You have <span>2</span> notifications</strong>
                </div>
                <div class="list-group">
                  <a href class="list-group-item">
                    <span class="pull-left m-r thumb-sm">
                      <img src="<?php echo URL_WEB_ADMIN; ?>images/a1.jpg" alt="..." class="img-circle">
                    </span>
                    <span class="clear block m-b-none">
                      Use awesome animate.css<br>
                      <small class="text-muted">10 minutes ago</small>
                    </span>
                  </a>
                  <a href class="list-group-item">
                    <span class="clear block m-b-none">
                      1.0 initial released<br>
                      <small class="text-muted">1 hour ago</small>
                    </span>
                  </a>
                </div>
                <div class="panel-footer text-sm">
                  <a href class="pull-right"><i class="fa fa-cog"></i></a>
                  <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                </div>
              </div>
            </div>
             
          </li>	
			 dropdown -->
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">               
				<img src="<?php echo $user_imagen; ?>" alt="<?php echo $user_nombre; ?>">				
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md"><?php echo $user_nombre; ?></span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                <div>
                  <p><?php echo shapeSpace_disk_usage(); ?> del 100% usado</p>
                </div>
                <div class="progress progress-xs m-b-none dker">
                  <div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="<?php echo shapeSpace_disk_usage(); ?>" style="width: <?php echo shapeSpace_disk_usage(); ?>"></div>
                </div>
              </li>
              <li>
                <a href="<?php echo URL_WEB_ADMIN."modulos/mod_config/scripts/config.eliminar.cache.php?token=$get_token"; ?>">                 
                  <span>Eliminar cache</span>
                </a>
              </li>
				<li>
                <a target="_blank" href="<?php echo URL_WEB; ?>">                 
                  <span>Visitar web</span>
                </a>
              </li>
              <li>
                <a href="<?php echo $url_perfil_usuario; ?>">Perfil</a>
              </li>
				<!---
              <li>
                <a ui-sref="app.docs">
                  <span class="label bg-info pull-right">new</span>
                  Help
                </a>
              </li>
				--->
              <li class="divider"></li>
              <li>
                <a href="<?php echo $url_logout; ?>">Cerrar sesi&oacute;n</a>
              </li>
            </ul>
            <!-- / dropdown -->
          </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->


    <!-- aside -->
  <aside id="aside" class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">
          <!-- user -->
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
            <div class="dropdown wrapper">
              <a href="<?php echo $url_perfil_usuario; ?>">
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
				  <div class="bg-cover" style="background: url(<?php echo $user_imagen; ?>)">	
                  <img src="<?php echo URL_WEB_ADMIN."images/bg-image-user.png"; ?>" alt="<?php echo $user_nombre; ?>" class="img-full">
				  </div>	  
                </span>
              </a>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php echo $user_nombre; ?></strong>                     
                  </span>
				  <?php if($user_tipo!==''){ ?>
                  <span class="text-muted text-xs block"><?php echo $user_tipo; ?></span>
				  <?php } ?>	
                </span>
              </a>              
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
          <!-- / user -->
		 
		  <?php include(URL_ROOT_ADMIN."includes/home.menu.php"); ?>	

          <!-- aside footer -->
		  <!---	
          <div class="wrapper m-t">
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded">60%</span>
              <span class="hidden-folded">Milestone</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-info" style="width: 60%;">
              </div>
            </div>
            <div class="text-center-folded">
              <span class="pull-right pull-none-folded">35%</span>
              <span class="hidden-folded">Release</span>
            </div>
            <div class="progress progress-xxs m-t-sm dk">
              <div class="progress-bar progress-bar-primary" style="width: 35%;">
              </div>
            </div>
          </div>
		 --->	
          <!-- / aside footer -->
        </div>
      </div>
  </aside>
  <!-- / aside -->


  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">