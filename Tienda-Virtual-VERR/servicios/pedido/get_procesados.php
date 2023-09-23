<?php
include('../_conexion.php');
$response=new stdClass();
$codusu = $_POST['codigo'];
function estado2texto($id){
	switch ($id) {
		case '1':
			return 'Por procesar';
			break;
		case '2':
			return 'Por pagar';
			break;
		case '3':
			return 'Por entregar';
			break;
		case '4':
			return 'En camino';
			break;			
		case '5':
			return 'Entregado';
			break;
		default:
			break;
	}
}

$datos=[];
$i=0;
$sql="SELECT *,ped.estado estadoped FROM pedido ped
INNER JOIN producto pro
ON ped.codpro=pro.codpro
WHERE ped.estado=2 AND codusu = $codusu";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->codped=$row['codped'];
	$obj->codpro=$row['codpro'];
	$obj->nompro=utf8_encode($row['nompro']);
	$obj->prepro=$row['prepro'];
	$obj->rutimapro=$row['rutimapro'];
	$obj->fecped=$row['fecped'];
	$obj->dirusuped=utf8_encode($row['dirusuped']);
	$obj->telusuped=$row['telusuped'];
	$obj->estado=$row['estadoped'];
	$obj->estadotext=estado2texto($row['estadoped']);
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);