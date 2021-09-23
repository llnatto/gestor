<?php 

	class Conectar{
		public function conexion() {
			$servidor = "localhost";
			$usuario = "natto";
			$password = "U;9o3PqP0;Dw7a";
			$base = "gestor";

			$conexion = mysqli_connect($servidor, 
										$usuario, 
										$password, 
										$base);
			$conexion->set_charset('utf8mb4');
			return $conexion;
		}
	}

 ?>