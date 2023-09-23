<?php
include('../config/conexion.php');
$response = new stdClass();

	$codpro=$_POST['codpro'];
	$nompro=$_POST['nompro'];
	$despro=$_POST['despro'];
	$prepro=$_POST['prepro'];
	$estapro=$_POST['estapro'];
	$canpro=$_POST['canpro'];
	$rutimapro=$_POST['rutimapro'];

	if(isset($_FILES['imagen'])){
		date_default_timezone_set("America/Bogota");
		$nombre_imagen = date("YmdHis").".jpg";
		$sql="UPDATE producto SET nompro='$nompro', despro='$despro', prepro=$prepro, estado=$estapro, canpro=$canpro, rutimapro='$nombre_imagen' WHERE codpro=$codpro";
		
		$result = mysqli_query($con, $sql);

		if($result){
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], "../../Tienda-Virtual-VERR/assets/products/".$nombre_imagen)){				
				$response->state=true;
				$response->detail="Producto actualizado correctamente";
				unlink("../../Tienda-Virtual-VERR/assets/products/".$rutimapro);
				
			}else{
				$response->state=false;
				$response->detail="Ha ocurrido un error al cargar la imagen";
			}

		}else{
			$response->state=false;
			$response->detail="No se pudo actualizar el producto";
		}
	}else{
		$sql="UPDATE producto SET nompro='$nompro', despro='$despro', prepro=$prepro, estado=$estapro, canpro=$canpro WHERE codpro=$codpro";
		$result = mysqli_query($con, $sql);
		if($result){
			$response->state = true;
			$response->detail = "Se actualizaron los datos correctamente";
		}else{
			$response->state = false;
			$response->detail = "No se han podido actualizar los datos";
		}
					
	}	
	echo json_encode($response);