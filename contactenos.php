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
		$class='bg-green-500';
		$icono='<i class="fa fa-check fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==2)
	{
		$mensaje='Debe completar todos los campos requeridos para poder registrarse';
		$class='bg-red-500';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==3)
	{
		$mensaje='Por favor, revise el campo de captcha';
		$class='bg-red-500';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
	elseif($_info==4)
	{
		$mensaje='Ah ocurrido un error vuelva a intentarlo mas tarde';
		$class='bg-red-500';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}	
	else
	{
		$mensaje='Verifique los campos ingresados y vuelva a intentarlo';
		$class='bg-red-500';
		$icono='<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>';
	}
}
?>
    <nav
      class="container mx-auto my-10 flex flex-wrap items-center gap-2 px-4 sm:px-8 xl:px-4 breadcrumb">
      <div class="flex items-center gap-2">
        <a href="<?php echo URL_WEB; ?>">
          <svg class="h-5 w-5 text-primary-500" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
            <path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path>
          </svg>
        </a>
        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-slate-500" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </div>
      <div class="flex items-center gap-2">
        <a class="pointer-events-none text-slate-400" href="#">Contactenos</a>
      </div>
    </nav>

    <section class="container mx-auto my-10 px-4 sm:px-8 xl:px-4">
      <div class="mt-0 mb-16 grid grid-cols-12 gap-8">
        <div class="col-span-12 lg:col-span-7">
        <?php
        if($_info!='')
        {
          ?>
            <div class="alert <?php echo $class; ?> alert-dismissible p-2 rounded-l-lg rounded-r-lg text-white" role="alert">            
              <strong><?php echo $mensaje; ?></strong>
            </div>
          <?php
        }
        ?>
        </div>
        <div class="col-span-12 lg:col-span-7">
          <div
            class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
            <h2 class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
              ¿Tiene alguna pregunta?
            </h2>
          </div>
          <form class="grid grid-cols-4 gap-5" action="<?php echo URL_WEB; ?>librerias/mod_contactenos/parse.php" method="post">
            <div class="relative col-span-2">
              <input
                type="text"
                id="contact-name"
                name="<?php echo $campo_nombres; ?>"
                class="peer block w-full appearance-none rounded-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 shadow focus:outline-none focus:ring-0"
                placeholder=" "
                required />
              <label
                for="contact-name"
                class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Nombres
              </label>
            </div>
            <div class="relative col-span-2">
              <input
                type="text"
                id="contact-email"
                name="<?php echo $campo_correo; ?>"
                class="peer block w-full appearance-none rounded-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 shadow focus:outline-none focus:ring-0"
                placeholder=" "
                required />
              <label
                for="contact-email"
                class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Correo
              </label>
            </div>
            <div class="relative col-span-2">
              <input
                type="text"
                id="contact-empresa"
                name="<?php echo $campo_empresa; ?>"
                class="peer block w-full appearance-none rounded-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 shadow focus:outline-none focus:ring-0"
                placeholder=" "/>
              <label
                for="contact-empresa"
                class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Empresa
              </label>
            </div>
            <div class="relative col-span-2">
              <input
                type="tel"
                id="contact-telefono"
                name="<?php echo $campo_telefono; ?>"
                class="peer block w-full appearance-none rounded-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 shadow focus:outline-none focus:ring-0"
                placeholder=" "
                />
              <label
                for="contact-telefono"
                class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Tel&eacute;fono
              </label>
            </div>
            <div class="col-span-4">
              <select class="h-[50px] w-full rounded-lg border-transparent shadow focus:border-transparent focus:ring-0 sm:col-span-1" id="select-state" name="<?php echo $campo_asunto; ?>">
                <option value="Solicitar coitzaci&oacute;n">Solicitar cotizaci&oacute;n</option>
                <option value="Consulta">Consulta</option>
              </select>
            </div>
            <div
              class="relative col-span-4 mb-5 w-full overflow-hidden rounded-lg bg-white pr-4 shadow">
              <textarea
                id="message"
                name="<?php echo $campo_mensaje; ?>"
                class="form-content peer mx-2.5 mb-2.5 mt-5 block max-h-[200px] min-h-[130px] w-full resize-none appearance-none border-0 text-sm text-default-500 focus:outline-none focus:ring-0"
                placeholder=" "
                required></textarea>

              <label for="message" class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Mensaje
              </label>
            </div>
            <div class="col-span-2">
              <button class="flex items-center gap-2 whitespace-nowrap rounded-lg bg-primary-500 p-[14px] font-semibold text-white transition-all duration-300 hover:bg-primary-600" type="submit">
                Enviar mensaje
              </button>
            </div>
          </form>
        </div>
        <div class="col-span-12 lg:col-span-5">
          <div
            class="mb-8 flex items-center justify-between border-b-[3px] pb-2">
            <h2
              class="relative text-2xl font-bold text-default-600 after:absolute after:-bottom-[11px] after:left-0 after:h-[3px] after:w-full after:bg-primary-500 after:content-['']">
              Ponte en contacto con nosotros
            </h2>
          </div>
          <div class="my-5 flex gap-5">
            <div
              class="flex h-10 min-w-[40px] items-center justify-center self-center rounded-full bg-primary-500 text-white">
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="currentColor"
                stroke-width="0"
                viewBox="0 0 512 512"
                height="200px"
                width="200px"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="32"
                  d="M80 212v236a16 16 0 0 0 16 16h96V328a24 24 0 0 1 24-24h80a24 24 0 0 1 24 24v136h96a16 16 0 0 0 16-16V212"></path>
                <path
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="32"
                  d="M480 256 266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256m368-77V64h-48v69"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-base font-bold text-primary-500">Dirección</h3>
              <p><?php echo contacto_empresa(5, 1); ?></p>
            </div>
          </div>
          <div class="my-5 flex gap-5">
            <div
              class="flex h-10 min-w-[40px] items-center justify-center self-center rounded-full bg-primary-500 text-white">
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="#fff"
                stroke-width="2"               
                stroke-linecap="round"
                stroke-linejoin="round"
                height="200px"
                width="200px"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-base font-bold text-primary-500">Whatsapp</h3>
              <p><?php echo contacto_empresa(4, 2); ?></p>
            </div>
          </div>
          <div class="my-5 flex gap-5">
            <div
              class="flex h-10 min-w-[40px] items-center justify-center self-center rounded-full bg-primary-500 text-white">
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="currentColor"
                stroke-width="0"
                viewBox="0 0 16 16"
                height="1em"
                width="1em"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-base font-bold text-primary-500">Correo</h3>
              <p><?php echo contacto_empresa(11,1); ?></p>
            </div>
          </div>
          <div class="my-5 flex gap-5">
            <div
              class="flex h-10 min-w-[40px] items-center justify-center self-center rounded-full bg-primary-500 text-white">
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="currentColor"
                stroke-width="0"
                baseProfile="tiny"
                viewBox="0 0 24 24"
                height="200px"
                width="200px"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13.839 17.525c-.006.002-.559.186-1.039.186-.265 0-.372-.055-.406-.079-.168-.117-.48-.336.054-1.4l1-1.994c.593-1.184.681-2.329.245-3.225-.356-.733-1.039-1.236-1.92-1.416-.317-.065-.639-.097-.958-.097-1.849 0-3.094 1.08-3.146 1.126-.179.158-.221.42-.102.626.12.206.367.3.595.222.005-.002.559-.187 1.039-.187.263 0 .369.055.402.078.169.118.482.34-.051 1.402l-1 1.995c-.594 1.185-.681 2.33-.245 3.225.356.733 1.038 1.236 1.921 1.416.314.063.636.097.954.097 1.85 0 3.096-1.08 3.148-1.126.179-.157.221-.42.102-.626-.12-.205-.369-.297-.593-.223z"></path>
                <circle cx="13" cy="6.001" r="2.5"></circle>
              </svg>
            </div>
            <div>
              <h3 class="text-base font-bold text-primary-500">Horarios</h3>
              <p><?php echo contacto_empresa(12); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="mapa">
        <?php echo modulo_mapa(661); ?>
      </div>
    </section>

    <section class="bg-primary-500 py-10 text-default-200">
      <div class="container mx-auto px-4 sm:px-8 xl:px-4">
        <div class="c flex flex-col items-center gap-3 text-center">
          <h2 class="text-3xl font-bold text-white">
            Subscribe our newsletter
          </h2>
          <p>Subscribe to receive updates on our store and special offers</p>
          <form class="flex w-full max-w-[590px]">
            <div class="relative w-full">
              <input
                type="text"
                id="your-email"
                class="peer block w-full appearance-none rounded-l-lg border-0 bg-white px-2.5 pb-2.5 pt-5 text-sm text-default-500 focus:outline-none focus:ring-0"
                placeholder=" " />
              <label
                for="your-email"
                class="z-1 pointer-events-none absolute left-2.5 top-4 origin-[0] -translate-y-4 scale-75 transform text-sm text-default-400 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-primary-500">
                Your email
              </label>
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