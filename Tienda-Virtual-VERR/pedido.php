<?php
	session_start();
	if (!isset($_SESSION['codusu'])) {
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mi sistema E-Commerce</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="shortcut icon" href="/web_shop.ico" />
</head>
<body>	
	<?php include("layouts/_main-header.php"); ?>
	<div class="main-content">
		<div class="content-page">
			<h3>Mis pedidos</h3>
			<div class="body-pedidos" id="space-list">
			</div>
			<h3>Datos de pago</h3>
			<div class="p-line"><div>MONTO TOTAL:</div> &nbsp;<span id="montototal"></span></div>
			<div class="p-line"><div>Banco:</div>Bancolombia</div>
			<div class="p-line"><div>N° de Cuenta:</div>#### - ##### - ###### </div>
			<div class="p-line"><div>Representante:</div>Encargado de ventas</div>
			<p><b>NOTA:</b> Para confirmar la compra debe realizar el deposito por el monto total, y enviar el comprobante al siguiente correo example@example.com o al número de whatsapp 999 666 3333</p>
		</div> 
	</div>
	<?php include("layouts/_footer.php");
	echo '<input type="text" name="cod-aux" value="'.($_SESSION['codusu']).'"style="display: none;">';
	?>

	<script type="text/javascript" src="js/main-scripts.js"></script>
	<script type="text/javascript">
		let codusu = $('input[name="cod-aux"]').val();
		console.log(codusu);
		var formatter = new Intl.NumberFormat('en-US', {
			style: 'currency',
			currency: 'USD',
	 		maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
		});
		$(document).ready(function(){
			$.ajax({
				url:'servicios/pedido/get_procesados.php',
				type:'POST',
				data:{
					codigo: codusu
				},
				success:function(data){
					console.log(data);
					let html='';
					let monto= parseFloat(0);
					for (var i = 0; i < data.datos.length; i++) {
						html+=
						'<div class="item-pedido">'+
							'<div class="pedido-img">'+
								'<img src="assets/products/'+data.datos[i].rutimapro+'">'+
							'</div>'+
							'<div class="pedido-detalle">'+
								'<h3>'+data.datos[i].nompro+'</h3>'+
								'<p><b>Precio:</b> $'+data.datos[i].prepro+'</p>'+
								'<p><b>Fecha:</b> '+data.datos[i].fecped+'</p>'+
								'<p><b>Estado:</b> '+data.datos[i].estadotext+'</p>'+
								'<p><b>Dirección:</b> '+data.datos[i].dirusuped+'</p>'+
								'<p><b>Celular:</b> '+data.datos[i].telusuped+'</p>'+
							'</div>'+
						'</div>';
						if (data.datos[i].estado == "2") {
							<?php ?>
							monto+=parseFloat(data.datos[i].prepro);
							console.log(monto);
						}
					}
					document.getElementById("montototal").innerHTML=formatter.format(monto);
					document.getElementById("space-list").innerHTML=html;
				},
				error:function(err){
					console.error(err);
				}
			});
		});
		
	</script>
</body>
</html>