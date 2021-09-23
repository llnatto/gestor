<?php 
	require_once "Conexion.php";

	class Gestor extends Conectar{
		public function agregaRegistroArchivo($datos) {
			$conexion = Conectar::conexion();
			$sql = "INSERT INTO t_archivos (id_usuario,
											id_categoria,
											nombre,
											tipo,
											ruta)
							VALUES (?,?,?,?,?)";
			$query = $conexion->prepare($sql);
			$query->bind_param('iisss', $datos['idUsuario'],
										$datos['idCategoria'],
										$datos['nombreArchivo'],
										$datos['tipo'],
										$datos['ruta']);

			$respuesta = $query->execute();
			$query->close();
			return $respuesta;
		}

		public function obtenNombreArchivo($idArchivo){
			$conexion = Conectar::conexion();
			$sql = "SELECT nombre
					FROM t_archivos 
					WHERE id_archivo = '$idArchivo'";
			$result = mysqli_query($conexion, $sql);
			return mysqli_fetch_array($result)['nombre'];
		}

		public function eliminarRegistroArchivo($idArchivo) {
			$conexion = Conectar::conexion();
			$sql = "DELETE FROM t_archivos WHERE id_archivo = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idArchivo);
			$respuesta = $query->execute();
			$query->close();
			return $respuesta;
		}

		public function obtenerRutaArchivo($idArchivo) {
			$conexion = Conectar::conexion();

			$sql = "SELECT nombre, tipo 
					FROM t_archivos 
					WHERE id_archivo = '$idArchivo'";
			$result = mysqli_query($conexion, $sql);
			$datos = mysqli_fetch_array($result);
			$nombreArchivo = $datos['nombre'];
			$extension = $datos['tipo'];
			return self::tipoArchivo($nombreArchivo, $extension);
		}

		public function tipoArchivo($nombre, $extension){
			$idUsuario = $_SESSION['idUsuario'];

			$ruta = "../archivos/".$idUsuario."/".$nombre;

			switch ($extension) {
				case 'png':
					return '<img src="'.$ruta.'" width="80%">';
					break;
					
				case 'jpg':
					return '<img src="'.$ruta.'" width="80%">';
					break;

				case 'pdf':
					return '<embed src="' . $ruta . '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />';
					break;

				case 'mp3':
					return '<audio controls src="' . $ruta .'"></audio>';
					break;

				case 'mp4':
					return '<video src="'.$ruta.'" controls width="100%" height="600px"></video>';
					break;
				case 'doc':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				case 'docx':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				case 'xls':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				case 'xlsx':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				case 'ppt':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				case 'pptx':
					return '<iframe src="https://docs.google.com/gview?url=http://nattoo.me/path/'.$ruta.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
						break;
				default:
					# code...
					break;
			}

		}
	}

 ?>