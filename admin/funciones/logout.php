<?php
include "definition.php";
$datos_definition->actualizar_estado_sesion($SisID, 0);	
session_unset();
session_destroy();
session_start();
session_regenerate_id(true);
?>