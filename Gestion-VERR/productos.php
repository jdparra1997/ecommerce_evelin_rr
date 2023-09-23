<?php
	include('config/conexion.php');	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Administracion | Productos </title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="/web_shop.ico" />
</head>
<body>
	<div class="modal" id="modal-producto" style="display: none;">
		<div class="body-modal">
			<button class="btn-close" onclick="hide_modal('modal-producto')"><i class="fa fa-times" aria-hidden="true"></i></button>
			<h3>Añadir Producto</h3>
				<input type="text" id="txt-codpro" style="display: none;">

				<div class="div-flex">
				<label for="txt-nompro">Nombre: </label>				
				<input type="text" id="txt-nompro">
				</div>

				<div class="div-flex">
				<label for="txt-despro">Descripción: </label>
				<input type="text" id="txt-despro">
				</div>

				<div class="div-flex">
				<label for="txt-prepro">Precio: </label>
				<input type="number" id="txt-prepro" placeholder="No usar puntos ni comas">
				</div>

				<div class="div-flex">
				<label for="txt-estapro">Estado: </label>
				<select id="txt-estapro">
					<option value="1">Activo</option>
					<option value="0">Inactivo</option>
				</select>
				</div>			

				<div class="div-flex">
				<label for="txt-canpro">Cantidad: </label>
				<input type="number" id="txt-canpro">
				</div>

				<div class="div-flex">
				<label for="txt-rutimapro">Imagen: </label>
				<input type="file" id="txt-rutimapro">				
				</div>
				<button onclick="save_product()">Guardar</button>
		</div>
	</div>
	<div class="modal" id="modal-producto-edit" style="display: none;">
		<div class="body-modal">
			<button class="btn-close" onclick="hide_modal('modal-producto-edit')"><i class="fa fa-times" aria-hidden="true"></i></button>
			<h3>Editar Producto</h3>
				
				<div class="div-flex">
				<label for="txt-nompro-e">Código: </label>				
				<input type="text" id="txt-codpro-e" disabled>
				</div>


				<div class="div-flex">
				<label for="txt-nompro-e">Nombre: </label>				
				<input type="text" id="txt-nompro-e">
				</div>

				<div class="div-flex">
				<label for="txt-despro-e">Descripción: </label>
				<input type="text" id="txt-despro-e">
				</div>

				<div class="div-flex">
				<label for="txt-prepro-e">Precio: </label>
				<input type="number" id="txt-prepro-e">
				</div>

				<div class="div-flex">
				<label for="txt-estapro-e">Estado: </label>
				<select id="txt-estapro-e" disabled>
					<option value="1">Activo</option>
					<option value="0">Inactivo</option>
				</select>
				</div>			

				<div class="div-flex">
				<label for="txt-canpro-e">Cantidad: </label>
				<input type="number" id="txt-canpro-e">
				</div>

				<input type="text" id="txt-rutimapro-aux" style="display: none;">				

				<img id="rutimapro" src="" style="width: 250px; margin: auto;">

				<div class="div-flex">
				<label for="txt-rutimapro-e">Imagen: </label>
				<input type="file" id="txt-rutimapro-e">				
				</div>
				<button onclick="update_product()">Actualizar</button>
		</div>
	</div>
	<div class="main-container">
		<?php include ("layouts/navbar.php"); ?>
		<div class="body-page">
			<h2>Productos</h2>
			<table class="mt10">
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>				
						<th>Descripcion</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th class="td-option">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php					
					$sql="SELECT * FROM producto WHERE estado = 1";
					$resultado=mysqli_query($con, $sql);
					while($row=mysqli_fetch_array($resultado)){					
						echo 
						'
						<tr>
						<td>'.$row['codpro'].'</td>
						<td>'.$row['nompro'].'</td>
						<td>'.$row['despro'].'</td>
						<td>'.$row['canpro'].'</td>
						<td> $ '.$row['prepro'].'</td>
						<td class="td-option">
							<div class="div-flex div-td-button">
								<button onclick="delete_product('.$row['codpro'].')"><i class="fa fa-trash" aria-hidden="true"></i></button>
								<button onclick="edit_product('.$row['codpro'].')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							</div>
						</td>
					</tr>';
						}
					?>					
				</tbody>
			</table>
			<button class="mt10" onclick="show_modal('modal-producto')">Agregar Nuevo</button>
		</div>
	</div>
	<script type="text/javascript">
		function show_modal(id){
			document.getElementById(id).style.display="block";
		}
		function hide_modal(id){
			document.getElementById(id).style.display="none";
		}
		function save_product(){
			let fd = new FormData();
			fd.append('codpro', document.getElementById('txt-codpro').value);
			fd.append('nompro', document.getElementById('txt-nompro').value);
			fd.append('despro', document.getElementById('txt-despro').value);
			fd.append('prepro', document.getElementById('txt-prepro').value);
			fd.append('estapro', document.getElementById('txt-estapro').value);
			fd.append('canpro', document.getElementById('txt-canpro').value);
			fd.append('rutimapro', document.getElementById('txt-rutimapro').files[0]);

			let request = new XMLHttpRequest();
			request.open('POST','api/save_product.php', true);
			request.onload=function(){
				if(request.readyState == 4 && request.status == 200){
					let response = JSON.parse(request.responseText);
					console.log(response);
					if(response.state){						
						alert("Producto agregado correctamente");
						clear_inputs();
						window.location.reload();
					}else{
						alert(response.detail);
					}
				}
			}
			request.send(fd);
		}
		function delete_product(codpro){
			
			var s = confirm("¿Estás seguro que deseas eliminar el producto de código : " + codpro + " ?");
			if(s){
					let fd = new FormData();
					fd.append('codpro', codpro);
					let request = new XMLHttpRequest();
					request.open('POST','api/delete_product.php', true);
					request.onload=function(){
						if(request.readyState == 4 && request.status == 200){
							let response = JSON.parse(request.responseText);
							console.log(response);
							if(response.state){						
								alert("Producto eliminado");
								window.location.reload();
							}else{
								alert(response.detail);
							}
						}
					}
					request.send(fd);
				}
		}
		function edit_product(codpro){
		
				let fd = new FormData();
				fd.append('codpro', codpro);
				let request = new XMLHttpRequest();
				request.open('POST','api/get_product.php', true);
				request.onload=function(){
					if(request.readyState == 4 && request.status == 200){
						let response = JSON.parse(request.responseText);
						document.getElementById("txt-codpro-e").value=codpro;
						document.getElementById("txt-nompro-e").value=response.product.nompro;
						document.getElementById("txt-despro-e").value=response.product.despro;
						document.getElementById("txt-prepro-e").value=response.product.prepro;
						document.getElementById("txt-estapro-e").value=response.product.estado;
						document.getElementById("txt-canpro-e").value=response.product.canpro;
						document.getElementById("rutimapro").src="../Tienda-Virtual-VERR/assets/products/" + response.product.rutimapro;
						document.getElementById("txt-rutimapro-aux").value=response.product.rutimapro;		
						show_modal('modal-producto-edit');							
					}
				}
				request.send(fd);
			}

		function update_product(){
		let fd = new FormData();
		fd.append('codpro', document.getElementById('txt-codpro-e').value);
		fd.append('nompro', document.getElementById('txt-nompro-e').value);
		fd.append('despro', document.getElementById('txt-despro-e').value);
		fd.append('prepro', document.getElementById('txt-prepro-e').value);
		fd.append('estapro', document.getElementById('txt-estapro-e').value);
		fd.append('canpro', document.getElementById('txt-canpro-e').value);
		fd.append('imagen', document.getElementById('txt-rutimapro-e').files[0]);
		fd.append('rutimapro', document.getElementById('txt-rutimapro-aux').value);	

		let request = new XMLHttpRequest();
		request.open('POST','api/update_product.php', true);
		request.onload=function(){
				if(request.readyState == 4 && request.status == 200){
					let response=JSON.parse(request.responseText);
					console.log(response);
					if(response.state){						
						alert(response.detail);
						clear_inputs();
						window.location.reload();
					}else{
						alert(response.detail);
					}
				}
			}
		request.send(fd);
		}
		function clear_inputs(){
			
			document.getElementById("txt-codpro").value="";
			document.getElementById("txt-nompro").value="";
			document.getElementById("txt-despro").value="";
			document.getElementById("txt-prepro").value="";
			document.getElementById("txt-estapro").value="";
			document.getElementById("txt-canpro").value="";
			let f = document.getElementById("txt-rutimapro");
			if(f.value){
				try{
					f.value = ''; 
				}catch(err){ }	

			}
		}	
	</script>
</body>
</html>