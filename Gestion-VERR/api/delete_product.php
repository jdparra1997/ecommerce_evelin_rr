<?php
include('../config/conexion.php');
$response = new stdClass();

	// Estados del producto
	// Estado 0 = NO está disponible en la tienda
	// Estado 1 = SI está disponible en la tienda
	
	$codpro = $_POST['codpro'];

	$sql = "SELECT * FROM pedido WHERE codpro = $codpro";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$cont = mysqli_num_rows($result);

	if($cont > 0){
		$sql = "UPDATE producto SET estado = 0
				WHERE codpro = $codpro";
		$result = mysqli_query($con, $sql);
		if($result){
			$response->state = true;
			$response->detail = "Reload";
		}else{
			$response->state = false;
			$response->detail = "No se puede eliminar el producto";
		}
	}else{
		$sql = "SELECT rutimapro FROM producto WHERE codpro = $codpro";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$rutimapro = $row['rutimapro'];

		$sql = "DELETE FROM producto WHERE codpro = $codpro";
		$result = mysqli_query($con, $sql);
		if($result){
			$response->state = true;
			$response->detail = "Reload";
			unlink("../../Tienda-Virtual-VERR/assets/products/".$rutimapro);
		}else{
			$response->state = false;
			$response->detail = "No se puede eliminar el producto";
		}
	}
	
echo json_encode($response);