<?php
//1: Error de conexion
//2: Email invalido
//3: Contraseña incorrecta
include('_conexion.php');
$emausu=$_POST['emausur'];
$nomusu = $_POST['nomusu'];
$apeusu= $_POST['apeusu'];
$rolusu = 'Usuario';
$sql="SELECT * FROM USUARIO WHERE emausu='$emausu'";
$result=mysqli_query($con,$sql);
if ($result) {
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	if ($count==0) {
		//Puede crear un nuevo usuario
		$pasusu=$_POST['pasusur'];
		$pasusu2=$_POST['pasusu2r'];
		if ($pasusu!=$pasusu2) {
			header('Location: ../login.php?er=3');
		}else{
			$sql="INSERT INTO usuario (codusu,nomusu,apeusu,emausu,pasusu,rolusu,estado)
			VALUES ('','$nomusu','$apeusu','$emausu','$pasusu','$rolusu',1)";
			$result=mysqli_query($con,$sql);
			$codusu=mysqli_insert_id($con);
			session_start();
			$_SESSION['codusu']=$codusu;
			$_SESSION['emausu']=$emausu;
			$_SESSION['nomusu']=$nomusu;
			header('Location: ../');
		}
	}else{
		header('Location: ../login.php?er=2');
	}
}else{
	header('Location: ../login.php?er=1');
}