<?php
include('../config/conexion.php');
	$response = new stdClass();	
	$codpro = $_POST['codpro'];
	$sql = "SELECT * FROM producto WHERE codpro = $codpro";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	
	$obj = new stdClass();
	$obj->nompro = utf8_encode($row['nompro']);
	$obj->despro = utf8_encode($row['despro']);
	$obj->prepro = $row['prepro'];
	$obj->estado = $row['estado'];
	$obj->rutimapro = $row['rutimapro'];
	$obj->canpro = $row['canpro'];
	$response ->product=$obj;
echo json_encode($response);