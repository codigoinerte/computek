
<?php
class login
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function verificar_usuario($usuario)
	{
		$query="SELECT ru.id, ru.empresa, ru.ruc, ru.username, ru.password, ru.email, ru.nombres, ru.apellidos, ru.fecha_nacimiento,ru.telefono,ru.celular,ru.web,ru.direccion, ru.direccion_referencia, ru.ciudad, ru.provincia,  ru.idpais, ru.fecha_creacion,ru.fecha_modificacion,ru.activo
				FROM registro_usuarios ru
				WHERE ru.username = ?";
		$lista = $this->data->executeQuery($query, array("$usuario"));
		return $lista;
	}
	
}
	
?>