
<?php 
  $marcas = $datos_reg_home->get_marcas();
  $listado_informacion = $datos_reg_home->listar_registro_relacionados(110, 3);

  $respuesta = isset($_GET["suscripcion"])?$_GET["suscripcion"]:0;
  if($respuesta==1)
  {
    $mensaje ="Gracias por suscribirse a nuestro Newsletter";	
  }
  else if($respuesta==2)
  {
    $mensaje="Ah ocurrido un error vuelva a intentarlo mas tarde";	
  }
  else if($respuesta==3)
  {			
    $mensaje ="Usted ya esta suscrito a nuestro Newsletter";
  }
  else if($respuesta==4)
  {
    $mensaje="Debe completar todos los campos requeridos para suscribirse";
  }
  else if($respuesta== 9)
  {
    $mensaje="Usted se ah desuscrito de nuestro Newsletter";	
  }
  else
  {
    $mensaje="Ah ocurrido un error vuelva a intentarlo mas tarde";	
  }
			
?>

<!-- marcas -->
<?php if(count($marcas) > 0){ ?>
<section class="container mx-auto my-10 px-4 sm:px-8 xl:px-4">
      <div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
        <h2
          class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
          Nuestras marcas
        </h2>
      </div>
      <div class="swiper swiper-brands group relative flex items-center">
        <div class="swiper-wrapper flex select-none items-center">
          
          <?php foreach ($marcas as $item){ 
              $imagen = $item["imagen"]? URL_WEB. "images/media/". $item["imagen"] : '';
              $marca = $item["marca"]??'';
            ?>
          <div class="swiper-slide">            
              <img
                class="object-contain grayscale filter transition-all duration-300 hover:filter-none"
                src="<?php echo $imagen; ?>"
                alt="<?php echo $marca; ?>" />            
          </div>
          <?php } ?>

        </div>
      </div>
    </section>
<?php } ?>

<!-- boletin -->
<section class="newsletter-section py-10 text-default-200">
      <div class="container mx-auto px-4 sm:px-8 xl:px-4">
        <div class="c flex flex-col items-center gap-3 text-center">
          <h2 class="text-3xl font-bold text-black">
            Suscribete a nuestro boletin
          </h2>
          <p>Suscríbete para recibir actualizaciones sobre nuestra tienda y ofertas especiales.</p>

          <?php 
          if($respuesta > 0)
          {
            ?>
              <div class="alert alert-info alert-dismissible bg-default-400 text-white p-2 rounded-l-lg rounded-r-lg" role="alert">
                <strong><?php echo $mensaje; ?></strong>
              </div>
              <?php
          }
          ?>

          <form class="flex w-full max-w-[590px]" action="<?php echo URL_WEB."librerias/mod_contactenos/parse.suscripcion.php"?>" method="post">
            <div class="relative w-full">
              <input type="text" name="email" class="peer block w-full appearance-none rounded-l-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 focus:outline-none focus:ring-0" placeholder=" " />
              <input type="hidden" name="suscripcion" value="1"> 
              <label for="your-id" class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500"> Email</label>
            </div>
            <button
              class="rounded-r-lg bg-white p-[9px] text-default-600 transition-all duration-300 hover:text-primary-500"
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
                class="css-i6dzq1">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
              </svg>
            </button>
          </form>
        </div>
      </div>
</section>

    <footer class="footer-section text-default-200">
      <div class="container mx-auto px-4 sm:px-8 xl:px-4">
        <div class="hidden lg:block">
          <div class="grid grid-cols-12 gap-x-20 gap-y-10 pt-10">
            <div class="col-span-4">
              <?php echo mostrar_modulo_web(648 , 1); ?>
            </div>
            <div class="col-span-4">
              <h1 class="relative mb-5 pb-2 text-lg font-semibold text-black after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-16 after:bg-primary-300 after:content-['']">
                Información
              </h1>
              <ul>
                <?php
                if(count($listado_informacion) > 0)
                {
                  foreach($listado_informacion as $item)
                  {
                    $item_nombre = isset($item["nombre"])?$item["nombre"]:'';
                    $item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
                    ?>
                      <li class="pb-2">
                        <a class="transition-all duration-300 color-gray-6 hover:text-black" href="<?php echo $item_alias; ?>">
                          <?php echo $item_nombre; ?>
                      </a>
                      </li>
                    <?php
                  }
                }
                ?>                
              </ul>
            </div>
            <div class="col-span-4">
              <h1 class="relative mb-5 pb-2 text-lg font-semibold text-black after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-16 after:bg-primary-300 after:content-['']">
                Contactenos
              </h1>
              <ul>
                <li class="flex items-center gap-2 pb-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="h-6 w-6">
                    <path
                      fill-rule="evenodd"
                      d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="color-gray-6"><?php echo contacto_empresa(5, 1); ?></span>
                </li>
                <li class="flex items-center gap-2 pb-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="h-6 w-6">
                    <path
                      d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                    <path
                      d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                  </svg>

                  <?php echo contacto_empresa(11); ?>
                </li>
                <li class="flex items-center gap-2 pb-2">

                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="h-6 w-6"
                    viewBox="0 0 448 512">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                  </svg>
                  
                  <span class="color-gray-6"><?php echo contacto_empresa(4, 2); ?></span>
                </li>
              </ul>
              <div class="flex items-center gap-5 pt-5">
                <a class="transition-all duration-300 hover:text-black" href="<?php echo contacto_empresa(6); ?>" title="Compustore Facebook">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="h-6 w-6"
                    viewBox="0 0 16 16">
                    <path
                      d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                  </svg>
                </a>
                <a class="transition-all duration-300 hover:text-black" href="<?php echo contacto_empresa(8); ?>" title="Compustore Instagram">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="h-6 w-6"
                    viewBox="0 0 16 16">
                    <path
                      d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                  </svg>
                </a>
              </div>
            </div>
            <div
              class="col-span-12 flex flex-col items-center gap-2 border-t border-slate-400 py-5 text-xs">
              <span class="text-black">
                Copyright &copy;
                <span class="current-year"></span>
                <a href="https://x.com/codigoinerte">codigoinerte</a>.
              </span>
              <p>
                <a
                  class="transition-all duration-300 hover:text-black"
                  href="<?php echo URL_WEB. "privacidad"; ?>">
                  Politica de privacidad
                </a>
                &#183;
                <a
                  class="transition-all duration-300 hover:text-black"
                  href="<?php echo URL_WEB. "terminos-y-condiciones" ?>">
                  Terminos y condiciones
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="lg:hidden">
          <ul class="metismenu py-5">
            <li class="transition-all duration-300">
              <div
                class="sub-metismenu has-arrow cursor-pointer py-3 font-bold text-black"
                aria-expanded="false"
                role="menu">
                Sobre nosotros
              </div>
              <div class="metismenu-content">
                <?php echo mostrar_modulo_web(648 , 3); ?>
              </div>
            </li>
            <li class="transition-all duration-300">
              <div class="sub-metismenu has-arrow cursor-pointer py-3 font-bold text-black" aria-expanded="false" role="menu">
                Información
              </div>
              <div class="metismenu-content">
                <ul>
                <?php
                if(count($listado_informacion) > 0)
                {
                  foreach($listado_informacion as $item)
                  {
                    $item_nombre = isset($item["nombre"])?$item["nombre"]:'';
                    $item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
                    ?>
                      <li class="pb-2">
                        <a class="transition-all duration-300 color-gray-6 hover:text-black" href="<?php echo $item_alias; ?>">
                          <?php echo $item_nombre; ?>
                      </a>
                      </li>
                    <?php
                  }
                }
                ?>
                </ul>
              </div>
            </li>
            <li class="transition-all duration-300">
              <div
                class="sub-metismenu has-arrow cursor-pointer py-3 font-bold text-black"
                aria-expanded="false"
                role="menu">
                Contactenos
              </div>
              <div class="metismenu-content">
                <ul>
                  <li class="flex items-center gap-2 pb-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="h-6 w-6">
                      <path
                        fill-rule="evenodd"
                        d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd" />
                    </svg>
                    <span><?php echo contacto_empresa(5, 1); ?></span>
                  </li>
                  <li class="flex items-center gap-2 pb-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="h-6 w-6">
                      <path
                        d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                      <path
                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                    </svg>

                    <?php echo contacto_empresa(11); ?>
                  </li>
                  <li class="flex items-center gap-2 pb-2">
                    <svg 
                      xmlns="http://www.w3.org/2000/svg" 
                      
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="h-6 w-6"
                      viewBox="0 0 448 512">
                      <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                    </svg>                    
                    <span><?php echo contacto_empresa(4, 2); ?></span>
                  </li>
                </ul>
                <div class="flex items-center gap-5 pt-5">
                  <a class="transition-all duration-300 hover:text-black" href="<?php echo contacto_empresa(6); ?>">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="h-6 w-6"
                      viewBox="0 0 16 16">
                      <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                  </a>                 
                  <a class="transition-all duration-300 hover:text-black" href="<?php echo contacto_empresa(8); ?>">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="h-6 w-6"
                      viewBox="0 0 16 16">
                      <path
                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <div
            class="flex flex-col items-center gap-2 border-t border-slate-400 py-5 text-xs">
            <span class="text-black">
              Copyright &copy;
              <span class="current-year"></span>
              <a href="https://x.com/codigoinerte">codigoinerte</a>.
            </span>
            <p>
              <a class="transition-all duration-300 hover:text-black" href="<?php echo URL_WEB. "privacidad"; ?>">
                Politica de privacidad
              </a>
              &#183;
              <a class="transition-all duration-300 hover:text-black" href="<?php echo URL_WEB. "terminos-y-condiciones"; ?>">
                Terminos y condiciones
              </a>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <div class="modal-menu modal-container resize-close modal-overlay">
      <div
        class="modal-content modal-left flex h-full w-[288px] min-w-[250px] flex-col bg-[#f5f7fe]">
        <div class="w-full">
          <button
            class="close-modal absolute right-5 top-5 p-[3px] text-default-600">
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
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        <a href="#" class="mr-auto flex items-center gap-2 p-5 lg:mr-0">
          <img class="h-7" src="<?php echo URL_WEB; ?>images/logo.png" alt="logo" />          
        </a>
        <div class="overflow-y-auto p-5">
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
          <ul class="metismenu">
            
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
                href="about.html">
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
        </div>
      </div>
    </div>

    <div class="modal-search modal-container resize-close modal-overlay">
      <div
        class="modal-content modal-top m-5 flex h-fit w-full items-center gap-2 rounded-lg bg-[#f5f7fe] p-4">
        <form class="flex w-full" method="post" action="<?php echo URL_WEB. 'buscador'; ?>">
          <div class="relative w-full">
            <input
              type="search"
              id="search-mob"
              class="peer block w-full appearance-none rounded-l-lg border border-r-0 border-primary-500 bg-white px-2 pb-2 pt-4 text-sm focus:outline-none focus:ring-0"
              placeholder=" " />
            <label
              for="search-mob"
              class="z-1 pointer-events-none absolute left-2.5 top-[13px] origin-[0] -translate-y-3 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-primary-500">
              Ingrese su busqueda...
            </label>
          </div>
          <button
            class="rounded-r-lg bg-primary-500 p-[9px] text-black"
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
        <button class="close-modal text-default-600">
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
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>

    <div class="scroll-up invisible fixed bottom-10 right-[50px] z-30 cursor-pointer select-none rounded-xl bg-black/50 p-2 text-white opacity-0 shadow-lg transition-all duration-300 hover:bg-primary-500">
      <svg
        viewBox="0 0 24 24"
        width="24"
        height="24"
        stroke="currentColor"
        stroke-width="2"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
      </svg>
    </div>

    <script src="<?php echo URL_WEB; ?>lib/simpleParallax/simpleParallax.min.js?v=<?php echo $version; ?>"></script>
    <script src="<?php echo URL_WEB; ?>lib/rater-js/rater-js.js?v=<?php echo $version; ?>"></script>
    <script src="<?php echo URL_WEB; ?>lib/swiper/swiper-bundle.min.js?v=<?php echo $version; ?>"></script>
    <script src="<?php echo URL_WEB; ?>lib/metisMenu/metismenujs.min.js?v=<?php echo $version; ?>"></script>
    <script src="<?php echo URL_WEB; ?>js/main.js?v=<?php echo $version; ?>"></script>
  </body>
</html>
