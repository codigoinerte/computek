<?php

$db_host = 'pdb34.awardspace.net'; //Host del Servidor MySQL
$db_name = '2969561_svperu'; //Nombre de la Base de datos
$db_user = '2969561_svperu'; //Usuario de MySQL
$db_pass = 'Fczg8S587s74t3n'; //Password de Usuario MySQL

/**
 * @function    backupDatabaseTables
 * @author      CodexWorld
 * @link        http://www.codexworld.com
 * @usage       Backup database tables and save in SQL file
 */
function backupDatabaseTables($dbHost,$dbUsername,$dbPassword,$dbName,$tables = '*'){
    //connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    //get all of the tables
    if($tables == '*'){
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while($row = $result->fetch_row()){
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }

    //loop through the tables
    foreach($tables as $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;

        $return .= "DROP TABLE $table;";

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch_row();

        $return .= "\n\n".$row2[1].";\n\n";

        for($i = 0; $i < $numColumns; $i++){
            while($row = $result->fetch_row()){
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++){
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
                    if ($j < ($numColumns-1)) { $return.= ','; }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    //save file
	$backup_file_name='db-backup-'.time().'.sql';
    $handle = fopen($backup_file_name,'w+');
    fwrite($handle,$return);
    fclose($handle);
	
	$ruta_sql = realpath($backup_file_name);
	
	$root = $_SERVER["DOCUMENT_ROOT"];	
	$nombre 	= "$root/admin/systembk/svperu_".date("d-m-Y_H-i-s").".zip";
	$directorio 	= "$root/admin/systembk/";
	//busca todos los ficheros que sean .zip
	$files 		= glob($directorio . '*.zip');	
	//Verifica la cantidad de ficheros y si es que hay que borrar y cual.
	if( $files !== false )
	{
		$cant = count( $files );
		if($cant>0)
		{
			//ya hay 5 respaldos así que hay que eliminar antes de pder seguir
			//genera un array para tomar el archivo más antiguo de los que se encuentran
			array_multisort(
			array_map( 'filemtime', $files ),
			SORT_NUMERIC,
			SORT_DESC,
			$files
			);
			
			$ruta_zip = $files[0];
		}
		else
		{
			$ruta_zip = "";
		}
	}
	else
	{
		$ruta_zip = "";
	}
	
	echo $ruta_zip;
	
	$zip = new ZipArchive();
	if($ruta_zip!=='')
	{
		if($zip->open($ruta_zip)===true)
		{
			$zip->addFile($ruta_sql,$backup_file_name);
			$zip->close(); 
			unlink($ruta_sql);
		}
		else
		{
			return false;
		}
	}
	else
	{
		$salida_zip = $directorio."svperu_".date("d-m-Y_H-i-s").".zip";
		if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true)
		{
			$zip->addFile($ruta_sql,$backup_file_name); 
			$zip->close(); 
			unlink($ruta_sql);
		}
		else
		{
			return false;
		}		
	}
	
}

backupDatabaseTables($db_host,$db_user,$db_pass,$db_name);
?>