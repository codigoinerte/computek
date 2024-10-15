
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
    
    <?php  include "librerias/mod_seo/seo.php" ;  ?>
    <!-- CSS Style --->

    <link rel="stylesheet" href="<?php echo URL_WEB; ?>lib/rater-js/rater-js.css" />
    <link rel="stylesheet" href="<?php echo URL_WEB; ?>lib/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?php echo URL_WEB; ?>lib/metisMenu/metismenujs.min.css" />
    <link rel="stylesheet" href="<?php echo URL_WEB; ?>css/styles.css" />
    <link rel="stylesheet" href="<?php echo URL_WEB; ?>css/estilo.css" />
    
  </head>
  <body
    class="font-montserrat font-medium text-default-500 lg:text-sm">
    <div class="header sticky top-0 -z-[1]"></div>

    <header
      class="relative z-10 bg-[#f5f5f5] transition-all duration-300">
      <div class="container mx-auto px-4 sm:px-8 xl:px-4">
        <div class="flex w-full items-center py-5 lg:justify-between">
          <div
            class="mr-5 cursor-pointer text-default-600 lg:hidden"
            data-target=".modal-menu">
            <svg
              viewBox="0 0 24 24"
              width="24"
              height="24"
              stroke="currentColor"
              stroke-width="2"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="pointer-events-none h-6 w-6">
              <line x1="3" y1="12" x2="21" y2="12"></line>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
          </div>
          <a href="<?php echo URL_WEB; ?>" class="mr-auto flex items-center gap-2 lg:mr-0">
            <img class="h-10" src="<?php echo URL_WEB; ?>images/logo.png" alt="logo" />            
          </a>
          <form class="hidden w-[590px] lg:flex" action="<?php echo URL_WEB. 'buscador'; ?>" method="post">
            <div class="relative w-full">
              <input type="search" class="peer block w-full appearance-none rounded-l-lg border border-r-0 border-primary-500 bg-white px-2 pb-2 pt-4 text-sm focus:outline-none focus:ring-0" placeholder=" " name="buscar"  />
              <label for="search" class="z-1 pointer-events-none absolute left-2.5 top-[13px] origin-[0] -translate-y-3 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-primary-500">
                Ingrese su busqueda...
              </label>
            </div>
            <button
              class="rounded-r-lg bg-primary-500 p-[9px] text-white"
              type="submit">
              <svg
                viewBox="0 0 24 24"
                width="24"
                height="24"
                stroke="currentColor"
                stroke-width="2"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="h-6 w-6">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </form>
          <div class="flex items-center gap-5">
            &nbsp;
            <div class="whatsapp">
              <?php echo contacto_empresa(4); ?>
            </div>
          </div>
        </div>
        <nav class="nav-main hidden items-center lg:flex">
          <?php
            $active1=$active2=$active3=$active5=$active6=$active7=$active8=$active99="";
            if($_alias=='index')
            {
              $active1='active';		
            }
            else if($_alias=='sobre-nosotros')
            {
              $active2='active';
            }
            else if($_alias=='contactenos')
            {
              $active99='active';
            }
          
          ?>
          <ul class="flex gap-10 font-semibold">
            <li>
              <a
                class="<?php echo $active1; ?> relative block py-3 transition-all duration-300 after:absolute after:-bottom-[5px] after:-top-[2px] after:left-0 after:h-[2px] after:w-0 after:bg-primary-500 after:transition-all after:duration-300 after:content-[''] hover:text-primary-500 hover:after:w-full"
                href="<?php echo URL_WEB; ?>">
                Inicio
              </a>
            </li>
            <li>
              <a
                class="<?php echo $active2; ?> relative block py-3 transition-all duration-300 after:absolute after:-bottom-[5px] after:-top-[2px] after:left-0 after:h-[2px] after:w-0 after:bg-primary-500 after:transition-all after:duration-300 after:content-[''] hover:text-primary-500 hover:after:w-full"
                href="<?php echo URL_WEB; ?>sobre-nosotros">
                Nosotros
              </a>
            </li>

            <?php 
            $listado_menu = $datos_reg_home->listar_categoriasxpagina(2);
            if(count($listado_menu) > 0)
            {
              foreach($listado_menu as $item)
              {
                $item_nombre = isset($item["nombre"])?$item["nombre"]:'';
                $item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
                $item_active = ($item["alias"]==$_alias)?"active":"";
                ?>
                  <li>
                    <a
                      class="<?php echo $item_active; ?> relative block py-3 transition-all duration-300 after:absolute after:-bottom-[5px] after:-top-[2px] after:left-0 after:h-[2px] after:w-0 after:bg-primary-500 after:transition-all after:duration-300 after:content-[''] hover:text-primary-500 hover:after:w-full"
                      href="<?php echo $item_alias; ?>">
                      <?php echo $item_nombre; ?>
                    </a>
                  </li>
                <?php
              } 
            }
            ?>            

            <li>
              <a
                class="<?php echo $active99; ?> relative block py-3 transition-all duration-300 after:absolute after:-bottom-[5px] after:-top-[2px] after:left-0 after:h-[2px] after:w-0 after:bg-primary-500 after:transition-all after:duration-300 after:content-[''] hover:text-primary-500 hover:after:w-full"
                href="<?php echo URL_WEB. "contactenos"; ?>">
                Contactenos
              </a>
            </li>            
          </ul>
        </nav>
      </div>
    </header>
