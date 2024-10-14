<?php
include("includes/home.footer.php");
?>
<script src="<?php echo URL_WEB_ADMIN; ?>librerias/ckeditor/ckeditor.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>librerias/ckfinder/ckfinder.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/hideShowPassword.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/dataTables.responsive.min.js"></script>


<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
  $.fancyConfirm = function(opts) {
    opts = $.extend(
      true,
      {
        title: "",
        message: "",
        okButton: "OK",
        noButton: "Cancel",
        callback: $.noop
      },
      opts || {}
    );

    $.fancybox.open({
      type: "html",
      src:
        '<div class="fc-content p-5 rounded">' +
        ((opts.title!=='')?'<h2 class="mb-3">'+opts.title+'</h2>':'') +
        "<p>" +
        opts.message +
        "</p>" +
        '<p class="text-right">' +
        '<a data-value="0" data-fancybox-close href="javascript:;" class="btn btn-default">' +
        opts.noButton +
        "</a>" +
        '<button data-value="1" data-fancybox-close class="btn btn-primary">' +
        opts.okButton +
        "</button>" +
        "</p>" +
        "</div>",
      opts: {
        animationDuration: 350,
        animationEffect: "material",
        modal: true,
        baseTpl:
          '<div class="fancybox-container fc-container" role="dialog" tabindex="-1">' +
          '<div class="fancybox-bg"></div>' +
          '<div class="fancybox-inner">' +
          '<div class="fancybox-stage"></div>' +
          "</div>" +
          "</div>",
        afterClose: function(instance, current, e) {
          var button = e ? e.target || e.currentTarget : null;
          var value = button ? $(button).data("value") : 0;

          opts.callback(value);
        }
      }
    });
  };  
</script>
<script>
function eliminar(cod_eli, url_envio)
{
	URLVar = url_envio + '&cod_eli_confirm=' + cod_eli;				
	//custom_confirm("\u00BFDesea eliminar el registro?");
    // Open customized confirmation dialog window
    $.fancyConfirm({      
      message: "Seguro que desea eliminar este campo",
      okButton: "Aceptar",
      noButton: "Cancelar",
      callback: function(value) {
        //////////////////////////////////////////////////////////
		if (value)
		{
        	window.location=URLVar;
        } 
		//////////////////////////////////////////////////////////  
      }
    });
	
}
function alerta(texto, id)
{	
	//custom_confirm("\u00BFDesea eliminar el registro?");
    // Open customized confirmation dialog window
    $.fancyConfirm({      
      message: texto,
      okButton: "Aceptar",
      noButton: "Cancelar",
      callback: function(value) {
        //////////////////////////////////////////////////////////
		if (id)
		{
        	id.focus();
        } 
		//////////////////////////////////////////////////////////  
      }
    });
	
}
</script>
<script> 
if($(".ckeditor").length>0)	
{
CKEDITOR.replace( document.querySelector( '.ckeditor' ), {
	filebrowserBrowseUrl: '<?php echo URL_WEB_ADMIN ?>librerias/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '<?php echo URL_WEB_ADMIN ?>librerias/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
}
</script>
<script>
if($("#listado_paginacion").length>0)	
{
	$(document).ready(function() {
		$('#listado_paginacion').DataTable( {
		responsive: true,	
        "language": {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}
    }	);
	} );	
}
</script>
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' archivos seleccionados' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
 // return alias

var amigable 	= 
(
	function() 
	{
		var tildes = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç&+¿?!¡.*(),_{}[]/",
			conver = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc-",
			cuerpo 	= {};
		for (var i=0, j=tildes.length; i<j; i++ )
		{
			cuerpo[tildes.charAt(i)] = conver.charAt(i);
		}
		return function(str) 
				{	
					var salida = [];
					for( var i = 0, j = str.length; i < j; i++)
					{
						var c = str.charAt( i );
						if(cuerpo.hasOwnProperty(str.charAt(i)))
						{				
							salida.push(cuerpo[c]);
						} 
						else
						{
							salida.push(c);	
						}	
					}		
					return salida.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
				}
	}
)();
	
	
function url_amigable_seo(texto, id_destino)
{
	if(document.getElementById(id_destino))
	{
		var new_alias = document.getElementById(id_destino);			
		seo = amigable(texto);
		/*custom_alert(seo);*/
		new_alias.value = seo;	
	}
}	
function titulo_registro(titulo, alias = '')
{
	if(document.getElementById('titulo_registro'))
	{
		document.getElementById('titulo_registro').innerHTML = titulo.value;	
	}
	
	if(document.getElementById(alias) && alias != '')
	{
		url_amigable_seo(titulo.value, alias );
	}
}

function titulo_registro_seo(titulo, titulo_seo='')
{
	if(document.getElementById(titulo_seo) && titulo_seo != '')
	{
		document.getElementById(titulo_seo).value=titulo;
	}
}
</script>
<?php
$ruta_js_include = URL_ROOT_ADMIN."modulos/$get_modulo/js/$get_option.js.php";
if (file_exists($ruta_js_include)) {
    include($ruta_js_include);
}
?>