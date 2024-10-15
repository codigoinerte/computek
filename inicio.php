    <?php $listado_productos_destacados = $datos_reg_home->listar_registros_destacados(3, 6); ?>	
    <?php include("slider.php"); ?>

    <!-- destacados -->
    <div class="container mx-auto px-4 sm:px-8 xl:px-4">
        <div class="my-5 grid grid-cols-12 gap-5">        
            <?php echo mostrar_modulo_web(650, 4); ?>
            <?php echo mostrar_modulo_web(652, 4); ?>
            <?php echo mostrar_modulo_web(654, 4); ?>
        </div>
    </div>

    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="my-10 grid grid-cols-12 rounded-lg p-10 section-features">
        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
          <a
            class="group relative flex items-center gap-5 py-5 after:absolute after:right-[50px] after:hidden after:h-8 after:w-[2px] after:bg-slate-200 after:content-[''] lg:p-0 xl:after:block"
            href="#">
            <svg
              class="h-12 w-12 text-default-600 transition-all duration-300 group-hover:-translate-y-4 group-hover:text-primary-500"
              stroke="currentColor"
              fill="none"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke-linecap="round"
              stroke-linejoin="round"
              height="200px"
              width="200px"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
              <path
                d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
              <path d="M3 9l4 0"></path>
            </svg>
            <div>
                <?php echo mostrar_modulo_web(656, 5); ?>
            </div>
          </a>
        </div>
        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
          <a
            class="group relative flex items-center gap-5 py-5 after:absolute after:right-[50px] after:hidden after:h-8 after:w-[2px] after:bg-slate-200 after:content-[''] lg:p-0 xl:after:block"
            href="#">
            <svg
              class="h-12 w-12 text-default-600 transition-all duration-300 group-hover:-translate-y-4 group-hover:text-primary-500"
              stroke="currentColor"
              fill="none"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke-linecap="round"
              stroke-linejoin="round"
              height="200px"
              width="200px"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M15 11v.01"></path>
              <path d="M5.173 8.378a3 3 0 1 1 4.656 -1.377"></path>
              <path
                d="M16 4v3.803a6.019 6.019 0 0 1 2.658 3.197h1.341a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-1.342c-.336 .95 -.907 1.8 -1.658 2.473v2.027a1.5 1.5 0 0 1 -3 0v-.583a6.04 6.04 0 0 1 -1 .083h-4a6.04 6.04 0 0 1 -1 -.083v.583a1.5 1.5 0 0 1 -3 0v-2l0 -.027a6 6 0 0 1 4 -10.473h2.5l4.5 -3h0z"></path>
            </svg>
            <div>
                <?php echo mostrar_modulo_web(658, 5); ?>
            </div>
          </a>
        </div>
        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
          <a
            class="group relative flex items-center gap-5 py-5 after:absolute after:right-[50px] after:hidden after:h-8 after:w-[2px] after:bg-slate-200 after:content-[''] lg:p-0 xl:after:block"
            href="#">
            <svg
              class="h-12 w-12 text-default-600 transition-all duration-300 group-hover:-translate-y-4 group-hover:text-primary-500"
              stroke="currentColor"
              fill="currentColor"
              stroke-width="0"
              viewBox="0 0 24 24"
              height="200px"
              width="200px"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.0049 2L18.3032 4.28071C18.7206 4.41117 19.0049 4.79781 19.0049 5.23519V7H21.0049C21.5572 7 22.0049 7.44772 22.0049 8V10H9.00488V8C9.00488 7.44772 9.4526 7 10.0049 7H17.0049V5.97L11.0049 4.094L5.00488 5.97V13.3744C5.00488 14.6193 5.58406 15.7884 6.56329 16.5428L6.75154 16.6793L11.0049 19.579L14.7869 17H10.0049C9.4526 17 9.00488 16.5523 9.00488 16V12H22.0049V16C22.0049 16.5523 21.5572 17 21.0049 17L17.7848 17.0011C17.3982 17.5108 16.9276 17.9618 16.3849 18.3318L11.0049 22L5.62486 18.3318C3.98563 17.2141 3.00488 15.3584 3.00488 13.3744V5.23519C3.00488 4.79781 3.28913 4.41117 3.70661 4.28071L11.0049 2Z"></path>
            </svg>
            <div>
                <?php echo mostrar_modulo_web(659, 5); ?>
            </div>
          </a>
        </div>
        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
          <a
            class="group relative flex items-center gap-5 py-5 lg:p-0"
            href="#">
            <svg
              class="h-12 w-12 text-default-600 transition-all duration-300 group-hover:-translate-y-4 group-hover:text-primary-500"
              stroke="currentColor"
              fill="currentColor"
              stroke-width="0"
              viewBox="0 0 24 24"
              height="200px"
              width="200px"
              xmlns="http://www.w3.org/2000/svg">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path
                d="M21 12.22C21 6.73 16.74 3 12 3c-4.69 0-9 3.65-9 9.28-.6.34-1 .98-1 1.72v2c0 1.1.9 2 2 2h1v-6.1c0-3.87 3.13-7 7-7s7 3.13 7 7V19h-8v2h8c1.1 0 2-.9 2-2v-1.22c.59-.31 1-.92 1-1.64v-2.3c0-.7-.41-1.31-1-1.62z"></path>
              <circle cx="9" cy="13" r="1"></circle>
              <circle cx="15" cy="13" r="1"></circle>
              <path
                d="M18 11.03A6.04 6.04 0 0 0 12.05 6c-3.03 0-6.29 2.51-6.03 6.45a8.075 8.075 0 0 0 4.86-5.89c1.31 2.63 4 4.44 7.12 4.47z"></path>
            </svg>
            <div>
                <?php echo mostrar_modulo_web(657, 5); ?>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section class="container mx-auto px-4 sm:px-8 xl:px-4">
      <div class="swiper swiper-cards relative my-10 overflow-hidden">
        <div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
          <h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
            Productos destacados
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
            <?php if(count($listado_productos_destacados) > 0){ ?>  
                <?php foreach($listado_productos_destacados as $item){ ?>		
                    <div class="swiper-slide h-auto">
                        <?php listado_item_producto($item); ?>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
      </div>
    </section>

    <?php
        $listado_categorias = $datos_reg_home->listar_categoriasxpagina(2);
        if(count($listado_categorias) > 0)
        {  	$num=1;
            foreach($listado_categorias as $item)
            {
                $idcategoria = isset($item["id"])?$item["id"]:0;
                $categoria = isset($item["nombre"])?$item["nombre"]:'';

                $listado_registros_nuevos = $datos_reg_home->listar_registros_nuevos($idcategoria, 3, 4);
                if(count($listado_registros_nuevos) > 0)
                {
                    ?>
                        <section class="container mx-auto px-4 sm:px-8 xl:px-4">
                            <div class="swiper swiper-cards relative my-10 overflow-hidden">
                                <div class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
                                <h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
                                    <?php echo $categoria; ?>
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
                                    
                                    <?php foreach($listado_registros_nuevos as $item){ ?>		
                                        <div class="swiper-slide h-auto">
                                            <?php listado_item_producto($item); ?>
                                        </div>
                                    <?php } ?>                                    
                        
                                </div>
                            </div>
                        </section>
                    <?php
                }
            }
        }
    ?>

    <?php echo mostrar_modulo_web(660, 6); ?>