<?php

class estadisticas

{

	public function __construct()

	{

		$this->data = new Conecta();

		$this->data->conectar();  

	}

	public function visitaxdia($day,$month,$year)

	{

		$lista="";

		$query="SELECT count(*) as cantidad

				FROM mod_estadistica_posicion

				WHERE YEAR(fecha)=? AND MONTH(fecha)=? AND DAY(fecha) = ?";

		$lista = $this->data->executeQuery($query, array("$year", "$month", "$day"));

		return $lista;	

	}

	public function visitaxmes($month,$year)

	{

		$lista="";

		$query="SELECT count(*) as cantidad

				FROM mod_estadistica_posicion

				WHERE YEAR(fecha)=? AND MONTH(fecha)=?";

		$lista = $this->data->executeQuery($query, array("$year", "$month"));

		return $lista;	

	}

	public function visitas_totales($year)

	{

		$lista="";

		$query="SELECT count(*) as cantidad

				FROM mod_estadistica_posicion

				WHERE YEAR(fecha)=? ";

		$lista = $this->data->executeQuery($query, array("$year"));

		return $lista;	

	}
	public function listar_visitas()
	{
		$lista="";
		$query="SELECT
					IF(idregistro=0,'Inicio',
						  (
							  SELECT mar.nombre
							  FROM mod_panel_registro mar
							  WHERE mar.id =idregistro
						  )
					  )as registro, continent_name as continente , country_name as pais, city as ciudad, currency_symbol_utf8 as moneda_simbolo, fecha
				FROM
					`mod_estadistica_posicion`
				ORDER BY fecha DESC
				LIMIT 0,25";

		$lista = $this->data->executeQuery($query);
		return $lista;	
	}
	public function listar_visitas_registros()
	{
		$lista="";
		$query="SELECT
					idregistro,
					IF(
						idregistro = 0,
						'Inicio',
						(
						SELECT
							mar.nombre
						FROM
							mod_panel_registro mar
						WHERE
							mar.id = idregistro
					)
					) AS registro,
					(COUNT(*)) AS cantidad
				FROM
					mod_estadistica_posicion
				GROUP BY
					idregistro
				ORDER BY
					(COUNT(*))
				DESC
				LIMIT 0, 27";
		$lista = $this->data->executeQuery($query);
		return $lista;	
	}
	
	public function cantidad_visita_admin($ip)
	{
		$lista="";
		$query="SELECT count(*) as cantidad FROM `mod_estadistica_posicion` WHERE ip= ? ";
		$lista = $this->data->executeQuery($query, array("$ip"));
		return $lista;			
	}
	public function eliminar_visitas_admin($ip)
	{
		$query="DELETE FROM mod_estadistica_posicion WHERE ip = ?";
		$this->data->updateQuery($query,array("$ip"));						
	}
	public function insertar_visitas_admin($ip,$idusuario,$fecha)
	{
		$query="INSERT INTO mod_registro_usuarios_log(ip, idusuario, fecha)
				VALUES (?,?,?)";
		$this->data->updateQuery($query,array("$ip","$idusuario","$fecha"));
	}
	public function listar_posicion_visitas($fecha_consulta)
	{
		$lista="";
		$query="SELECT latitud, longitud FROM mod_estadistica_posicion WHERE latitud<>'' AND longitud<>'' AND fecha>='$fecha_consulta' ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
}



?>