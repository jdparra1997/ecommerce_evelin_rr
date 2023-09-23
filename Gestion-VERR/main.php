<?php
	include('config/conexion.php');	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Administracion | Pedidos </title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="/web_shop.ico" />
</head>
<body>
	
	<div class="main-container">
		<?php include ("layouts/navbar.php"); ?>
		<div class="body-page">
			<h2>Pedidos</h2>
			<table class="mt10">
				<thead>
					<tr>
						<th>Código</th>
						<th>Usuario</th>
						<th>Producto/s</th>				
						<th>Fecha de venta</th>
						<th>Estado del pedido</th>
						<th>Direccion usuario</th>
						<th>Telefono usuario</th>
						<th>Opciones</th>							
					</tr>
				</thead>
				<tbody>
					<?php
					/*
					Estado 0 = Eliminado
					Estado 2 = Falta pagar
					Estado 3 = Ya pago y el pedido esta en camino
					Estado 4 = Se entregó el pedido
					*/
					$sql="SELECT pedido.*, usuario.*, producto.*, 
					CASE WHEN pedido.estado = 2 THEN 'Por pagar' ELSE 
						CASE WHEN pedido.estado = 3 THEN 'En camino' ELSE 'Otro'
							END 
						END estadotexto, pedido.estado estadoped 
					FROM pedido
					INNER JOIN usuario
					ON pedido.codusu = usuario.codusu
					INNER JOIN producto
					ON pedido.codpro = producto.codpro
					WHERE pedido.estado = 2 || pedido.estado = 3";
					$resultado = mysqli_query($con, $sql);
					while($row=mysqli_fetch_array($resultado)){
						echo 
						'
						<tr>
							<td>'.$row['codped'].'</td>
							<td>'.$row['codusu'].' - '.$row['nomusu'].' '.$row['apeusu'].'</td>
							<td>'.$row['codpro'].' - '.$row['nompro'].'</td>
							<td>'.$row['fecped'].'</td>
							<td>'.$row['estadotexto'].'</td>
							<td>'.$row['dirusuped'].'</td>
							<td>'.$row['telusuped'].'</td>';							;
							if ($row['estadoped'] == 3) {
								echo '<td class="td-option">
								<div class="div-flex div-td-opt-button">
								<button onclick="confirmar_entrega('.$row['codped'].')" style="background: #81BEF7;">Entregado</button>'; 
							}else {
							echo '<td class="td-option">
								<div class="div-flex div-td-opt-button">
								<button onclick="despachado('.$row['codped'].')" style="background: #A9A9F5;">Despachar</button>';
						}
						echo '							
								<button onclick="eliminar_pedido('.$row['codped'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</div>
								</td>							
						</tr>'; 
					} ?>					
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
	
		function despachado(codped){
			let fd = new FormData();
			fd.append('codped', codped);
			let request = new XMLHttpRequest();
			request.open('POST','api/confirm_pedido.php', true);
			
			request.onload=function(){
				if(request.readyState == 4 && request.status == 200){

					let response = JSON.parse(request.responseText);
					console.log(response);

					if(response.state){
						window.location.reload();
					}else{
						alert(response.detail);
					}

				}
			}
			request.send(fd);
		}
		function confirmar_entrega(codped){
			let fd = new FormData();
			fd.append('codped', codped);
			let request = new XMLHttpRequest();
			request.open('POST','api/entrega_pedido.php', true);
			
			request.onload=function(){
				if(request.readyState == 4 && request.status == 200){

					let response = JSON.parse(request.responseText);
					console.log(response);

					if(response.state){
						window.location.reload();
					}else{
						alert(response.detail);
					}

				}
			}
			request.send(fd);
		}
		function eliminar_pedido(codped){
				
			var s = confirm("¿Estás seguro que deseas eliminar el pedido de código : " + codped + " ?");
			if(s){
			let fd = new FormData();
			fd.append('codped', codped);
			let request = new XMLHttpRequest();
			request.open('POST','api/eliminar_pedido.php', true);
			
			request.onload=function(){
				if(request.readyState == 4 && request.status == 200){

					let response = JSON.parse(request.responseText);
					console.log(response);

					if(response.state){
						window.location.reload();
					}else{
						alert(response.detail);
					}

				}
			}
			request.send(fd);
		}
	}
	</script>
</body>
</html>