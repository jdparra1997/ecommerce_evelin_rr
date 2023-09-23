<?php
include('../config/conexion.php');
$response = new stdClass();

	$codpro=$_POST['codpro'];
	$nompro=$_POST['nompro'];
	$despro=$_POST['despro'];
	$prepro=$_POST['prepro'];
	$estapro=$_POST['estapro'];
	$canpro=$_POST['canpro'];

	if($nompro==""){
		$response->state=false;
		$response->detail="Falta el nombre";
	}else{
			if($despro==""){
			$response->state=false;
			$response->detail="Falta la descripcion";
			}else{
				if($prepro==""){
				$response->state=false;
				$response->detail="Falta el precio";
				}else{
					if($estapro==""){
					$response->state=false;
					$response->detail="Falta el estado";
					}else{
						if($canpro==""){
						$response->state=false;
						$response->detail="Falta la cantidad";
						}else{
							if(isset($_FILES['rutimapro'])){
								
								date_default_timezone_set("America/Bogota");
								$nombre_imagen = date("YmdHis").".jpg";
								$sql = "INSERT INTO producto (nompro, despro, prepro, estado, canpro, rutimapro)
								VALUES ('$nompro', '$despro', $prepro, $estapro, $canpro, '$nombre_imagen')";
								$result = mysqli_query($con, $sql);
								if($result){
									if(move_uploaded_file($_FILES['rutimapro']['tmp_name'], "../../Tienda-Virtual-VERR/assets/products/".$nombre_imagen)){
										$response->state=true;
										$response->detail = "Producto agregado correctamente";
									}else{
										$response->state=false;
										$response->detail="Ha ocurrido un error al cargar la imagen";
									}
									
								}else{
									$response->state=false;
									$response->detail="Hubo un error al intentar conectar con la base de datos";
								}
							}else{
							$response->state=false;
							$response->detail="Falta la imagen";			
						}			
					}				
				}
			}
		}
	}
	echo json_encode($response);