    <!-- Main Container -->
<?php
$datos_registro = $datos_reg_home->detalle_registro($id_registro);

$_registro_titulo = isset($datos_registro[0]["nombre"])?$datos_registro[0]["nombre"]:'';
$_registro_descripcion = isset($datos_registro[0]["descripcion"])?$datos_registro[0]["descripcion"]:'';
$_registro_resumen = isset($datos_registro[0]["resumen"])?$datos_registro[0]["resumen"]:'';
$_registro_stock = isset($datos_registro[0]["stock"])?$datos_registro[0]["stock"]:'';
$_registro_estado = isset($datos_registro[0]["estado"])?$datos_registro[0]["estado"]:'';
$_registro_marca = isset($datos_registro[0]["marca"])?$datos_registro[0]["marca"]:'';

$_registro_precio = isset($datos_registro[0]["precio"])?$datos_registro[0]["precio"]:0;
$_registro_descuento = isset($datos_registro[0]["descuento"])?$datos_registro[0]["descuento"]:0;

$array_cat= $datos_reg_home->detalle_nivel_superior($id_registro);
$idcat = isset($array_cat[0]["id"])?$array_cat[0]["id"]:'';

$array_relacionados = $datos_reg_home->listar_registro_relacionados_detalle($idcat, 3, $id_registro);

?>
    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="mb-6 grid grid-cols-6 gap-6">
        <div class="col-span-6 flex max-h-[500px] w-full flex-col gap-4 lg:col-span-3 lg:flex-row">
          <?php if(count($datos_registro_galeria) > 0){ ?> 
          <div class="swiper swiper-product relative order-1 flex w-full flex-1 items-center overflow-hidden rounded-lg lg:order-2">
            <div class="swiper-wrapper">
              <?php 
              foreach($datos_registro_galeria as $item){
								$_imagen = isset($item["imagen"])?URL_WEB."images/media/".$item["imagen"]:'';	
              ?>
              <figure class="swiper-slide">
                <img src="<?php echo $_imagen; ?>" alt="" />
              </figure>
              <?php } ?>
            </div>
            <div class="button-prev absolute left-0 z-10 select-none rounded p-1 text-center text-primary-500">
              <svg class="h-8 w-8" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"></path>
              </svg>
            </div>
            <div class="button-next absolute right-0 z-10 select-none rounded p-1 text-center text-primary-500">
              <svg class="h-8 w-8" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path>
              </svg>
            </div>
          </div>
          <div class="swiper swiper-thumbs relative order-2 h-[50px] w-full lg:order-1 lg:h-full lg:w-[50px]">
            <div class="swiper-wrapper">
              <?php 
              foreach($datos_registro_galeria as $item){
								$_imagen = isset($item["imagen"])?URL_WEB."images/media/".$item["imagen"]:'';	
              ?>
              <figure class="swiper-slide">
                <img src="<?php echo $_imagen; ?>" alt="" />
              </figure>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-span-6 lg:col-span-3">
          <div class="mb-2 flex items-center justify-between gap-5">
            <div class="flex items-center gap-1">
              <div class="rater my-2" data-rater="5"></div>
            </div>
            <?php if($_registro_stock > 0){ ?>
            <span class="rounded bg-green-400 px-2 py-1 text-white">
              En stock
            </span>
            <?php }else{ ?> 
              <span class="rounded bg-red-400 px-2 py-1 text-white">
              Sin Stock
            </span>
            <?php } ?>
          </div>
          <h2 class="text-2xl font-semibold text-default-600"><?php echo $_registro_titulo ; ?></h2>
          <div class="my-2 flex items-center gap-2">
            <?php if($_registro_descuento > 0 ){ 
              $_registro_precio_especial=$_registro_precio-(($_registro_precio*$_registro_descuento)/100);
              ?>
              <span class="text-xl font-bold text-primary-500">S/ <?php echo redondear_precio($_registro_precio_especial); ?></span>
              <span class="line-through">S/ <?php echo redondear_precio($_registro_precio); ?></span>
              <span class="rounded-md bg-red-400 px-2 text-white">-<?php echo $_registro_descuento; ?>% off</span>
            <?php }else{ ?>
              <span class="text-xl font-bold text-primary-500">S/ <?php echo redondear_precio($_registro_precio); ?></span>
            <?php } ?>
          </div>
          <div class="mb-5 border-b-2 pb-5">
            <p class="line-clamp-3">
              <?php echo $_registro_resumen; ?>
            </p>
          </div>
          <form>
            <div class="my-4">
              <div class="mt-2 flex gap-3">
                <?php echo compartir_producto_whatsapp($_alias); ?>  
              </div>
            </div>
          </form>
          <div class="my-4 mb-5 border-b-2 pb-5">
            <button class="btn-wishlist flex items-center gap-2 transition-all duration-300 hover:text-primary-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="pointer-events-none h-6 w-6 fill-none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
              </svg>
              <span class="pointer-events-none">Añadir a favoritos</span>
            </button>
          </div>
          <?php if($_registro_stock > 0){ ?>
          <div class="my-4 flex items-center gap-2">
            <span class="font-bold text-default-600">Disponible:</span>
            <span class="text-xs text-green-400"><?php echo $_registro_stock; ?> items en Stock</span>
          </div>
          <?php } ?>

          <div class="my-4">
            <span class="font-bold text-default-600">Comparte:</span>
            <div class="mt-2 flex items-center gap-2">
              <!-- facebook -->
              <a class="inline-block rounded border border-[#1877f2] px-4 py-2 text-[#1877f2]" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL_WEB.$_alias; ?>">
                <svg class="h-4 w-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                  <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                </svg>
              </a>
              <!-- twitter -->
              <a class="inline-block rounded border border-black px-4 py-2 text-black" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $_registro_titulo; ?>&amp;url=<?php echo URL_WEB.$_alias; ?>&amp;counturl=<?php echo URL_WEB.$_alias; ?>">
                <svg class="h-4 w-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                  <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                </svg>
              </a>
              <!-- whatsapp -->
              <a class="inline-block rounded border border-[#25D366] px-4 py-2 text-[#25D366]" target="_blank" href="https://api.whatsapp.com/send?phone=&text=Hola%2C+te+comparto+este+producto+que+vi+en+Compustore%3A+<?php echo URL_WEB.$_alias; ?>&_fb_noscript=1">
                <svg class="h-4 w-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                  <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
                </svg>
              </a>
              <!-- enlace -->
              <button class="inline-block rounded border border-primary-500 px-4 py-2 text-primary-500" onclick="copylink('link');">
                <input type="text" id="link" value="<?php echo URL_WEB.$_alias;?>" style="display:none !important;">
                <svg class="h-4 w-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
                  <path d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="tab-container tab-description mb-10">
        <ul class="mb-8 flex flex-wrap items-center gap-6 border-b-[3px] pb-2">
          <li
            class="tab-item active relative text-2xl font-bold text-default-600">
            Descripción
          </li>          
        </ul>
        <div class="tab-content">
          <div class="tab-content-item active">
            <div class="expandable-container">
              <div class="expandable-content max-h-[300px] overflow-hidden">
                <div class="expandable-subcontent">
                  <?php echo $_registro_descripcion; ?>
                </div>
              </div>
              <button
                class="expandable-toggle mx-auto mt-2 block rounded-md bg-primary-500 px-2 text-white"
                type="button">
                <svg
                  class="h-5 w-5 transition-all duration-300"
                  stroke="currentColor"
                  fill="currentColor"
                  stroke-width="0"
                  viewBox="0 0 16 16"
                  height="200px"
                  width="200px"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67"></path>
                </svg>
              </button>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <?php if(count($array_relacionados) > 0){ ?>
    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="swiper swiper-cards relative my-10 overflow-hidden">
        <div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
          <h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
            Productos relacionados
          </h2>
          <div class="flex items-center gap-1">
            <div class="button-prev select-none rounded-md bg-default-400 px-[10px] py-1 text-white transition-all duration-300 hover:bg-primary-500">
              &#10094;
            </div>
            <div class="button-next select-none rounded-md bg-default-400 px-[10px] py-1 text-white transition-all duration-300 hover:bg-primary-500">
              &#10095;
            </div>
          </div>
        </div>
        <div class="swiper-wrapper">
          <?php foreach($array_relacionados as $item){ ?>
          <div class="swiper-slide h-auto">
            <?php listado_item_producto($item); ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
   <?php } ?>