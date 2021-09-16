<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.theme.css">
    <link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.css">
</head>
<body>
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<div class="container">
				<h1 style="text-align: center;">Registro de usuario</h1>
				<hr>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<form id="frmRegistro" method="post" onsubmit="return agregarUsuarioNuevo()" autocomplete="off">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nombre</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" name="nombre" id="nombre" required="">
								</div>
							</div>	
							<div class="form-group row">
								<label  class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
								<input type="text" name="correo" id="email" class="form-control" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Usuario</label>
								<div class="col-sm-10">
								<input type="text" name="usuario" id="usuario" class="form-control" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Contraseña</label>
								<div class="col-sm-10">
								
								<input type="password" name="password" id="password" class="form-control" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-6 col-form-label">Fecha de nacimiento</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" name="fechaNacimiento" id="fechaNacimiento" required="" readonly="">
								</div>
							</div>
							<br>
							<div class="form-group row">
								<div class="col-sm-6 text-left">
									<a href="index.php"  class="btn btn-secondary">Login</a>
								</div>
								<div class="col-sm-6 text-right">
									<button class="btn btn-primary">Registrar</button>
								</div>
								
							</div>
						</form>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
	</div>
	<script src="librerias/jquery-3.4.1.min.js"></script>
	<script src="librerias/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="librerias/sweetalert.min.js"></script>

	<script type="text/javascript">


		$(function() {
		    var fechaA = new Date();
		    var yyyy = fechaA.getFullYear();

		    $("#fechaNacimiento").datepicker({
		        changeMonth: true,
		        changeYear: true,
		        yearRange: '1900:' + yyyy,
		        dateFormat: "dd-mm-yy"
		    });
		});

		function comprobar_email($password) {
   			 return (filter_var($password, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
		}


		function agregarUsuarioNuevo() {
			$.ajax({
				method: "POST",
				data: $('#frmRegistro').serialize(),
				url: "procesos/usuario/registro/agregarUsuario.php",
				success:function(respuesta){

					respuesta = respuesta.trim();

					if (respuesta == 1) {
						$("#frmRegistro")[0].reset();
						swal(":D", "Agregado con exito!", "success");
					} else if(respuesta == 2){
						swal("Este usuario ya existe, por favor escribe otro !!!");
					} else {
						swal(":(", "Fallo al agregar!", "Error");
					}
				}
			});

			return false;
		}
	</script>
</body>
</html>