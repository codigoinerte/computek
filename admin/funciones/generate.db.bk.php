<?php
/*
$db_host = 'pdb34.awardspace.net'; //Host del Servidor MySQL
$db_name = '2969561_svperu'; //Nombre de la Base de datos
$db_user = '2969561_svperu'; //Usuario de MySQL
$db_pass = 'Fczg8S587s74t3n'; //Password de Usuario MySQL
*/

echo 322;
exit();
/*
$host="pdb34.awardspace.net";
$username="2969561_svperu";
$password="Fczg8S587s74t3n";
$database_name="2969561_svperu";

$conn=mysqli_connect($host,$username,$password,$database_name);

$tables=array();
$sql="SHOW TABLES";
$result=mysqli_query($conn,$sql);
;

while($row=mysqli_fetch_row($result)){
$tables[]=$row[0];
}


$backupSQL="";
foreach($tables as $table){
$query="SHOW CREATE TABLE $table";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_row($result);
$backupSQL.="\n\n".$row[1].";\n\n";

$query="SELECT * FROM $table";
$result=mysqli_query($conn,$query);

$columnCount=mysqli_num_fields($result);

for($i=0;$i<$columnCount;$i++){
while($row=mysqli_fetch_row($result)){
$backupSQL.="INSERT INTO $table VALUES(";
for($j=0;$j<$columnCount;$j++){
$row[$j]=$row[$j];

if(isset($row[$j])){
$backupSQL.='"'.$row[$j].'"';
}else{
$backupSQL.='""';
}
if($j<($columnCount-1)){
$backupSQL.=',';
}
}
$backupSQL.=");\n";
}
}
$backupSQL.="\n";
}

if(!empty($backupSQL)){
$backup_file_name=$database_name.'_backup_'.time().'.sql';
$fileHandler=fopen($backup_file_name,'w+');
$number_of_lines=fwrite($fileHandler,$backupSQL);
fclose($fileHandler);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($backup_file_name));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: '.filesize($backup_file_name));
ob_clean();
flush();
}
*/
?>