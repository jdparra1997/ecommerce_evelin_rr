<?php
include('../config/conexion.php');
$response = new stdClass();
	// Estado 1 = Se esta procesando el pedido -- No es visible
	// Estado 2 = Se confirmo el pedido y falta pagarlo
	// Estado 3 = Se pagó el pedido y se entregó
	// Estado 4 = Finalizó el proceso de compra
	$codped = $_POST['codped'];

	$sql = "UPDATE pedido SET estado = 3
	WHERE codped = $codped";
	$result = mysqli_query($con, $sql);
	if($result==true){
		$response->state = true;
		$response->detail = "Reload";
	}else{
		$response->state = false;
		$response->detail = "No se actualizó el estado del pedido";
	}

echo json_encode($response);