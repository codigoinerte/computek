<?php
$datos_registro = $datos_reg_home->detalle_registro($id_registro);
$_titulo_ = isset($datos_registro[0]["nombre"])?$datos_registro[0]["nombre"]:'';
$_descripcion_ = isset($datos_registro[0]["descripcion"])?$datos_registro[0]["descripcion"]:'';
?>
  <section class="container mx-auto my-10 px-4 sm:px-8 xl:px-4">
      
    </section>

    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="mb-6 grid grid-cols-8 gap-7">
        <div class="order-2 col-span-8 lg:order-1 lg:col-span-2">
        
          <!-- articulos relacionados -->
          <?php include("lateral.php") ?>
          <!-- articulos relacionados -->
        

        </div>
        <div class="order-1 col-span-8 lg:order-2 lg:col-span-6">
            <!-- contenido del articulo -->
            <article class="mb-8 rounded-lg bg-white p-4">
              <div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
                <h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
                  <?php echo $_titulo_; ?>
                </h2>
              </div>
            
              <figure class="col-span-2 lg:col-span-1">                  
                <?php if(count($datos_registro_galeria) > 0){ ?>	
                  <div class="featured-thumb">
                    <ul class="rslides">
                    <?php foreach($datos_registro_galeria as $item){ 
                      $_imagen = isset($item["imagen"])?URL_WEB."images/media/".$item["imagen"]:'';				  
                      ?> 
                      <li>
                        <a data-fancybox="gallery" href="<?php echo $_imagen; ?>">
                          <img class="h-full w-full object-cover" src="<?php echo $_imagen; ?>" alt="<?php echo $_titulo_; ?>">
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>	   		
                <?php } ?>	
              </figure>
              <?php echo $_descripcion_; ?>                                   
            </article>
            <!-- contenido del articulo -->
        </div>
      </div>
    </section>