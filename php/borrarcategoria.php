	   
<?php 
	//veo si la sesión está iniciada
	if(!session_id()){
		session_start();
	}
	
	//incluyo conexión
	include('conexion.php');
	$conex = conectar();
	
	include('usuario.php');
	$user= new usuario(); //instancia de una clase
	$user->estaRegistrado();
	
	$idCategoriaProducto= $_GET['idCategoriaProducto'];
	
	$sql="SELECT * FROM productos where idCategoriaProducto = $idCategoriaProducto";//consulta a bd
	$productos=	mysqli_query($conex,$sql); //ejecuta consulta 

	//obtengo el numero de filas de un resultado
	if(mysqli_num_rows($productos) > 0){ 
		$_SESSION['error'] = 'No puede eliminar esta categoría porque tiene productos asociados.';
		header("Location:categorias.php");
		exit;
	}

	else{
		$sql = "DELETE FROM categorias_productos WHERE idCategoriaProducto = '$idCategoriaProducto'"; //borro de la bd
		if(mysqli_query($conex,$sql)){
		
			$_SESSION['error'] = 'Ha borrado correctamente la categoría';
			header("Location:categorias.php");
			exit;
		}
		else{
			$_SESSION['error'] = 'Intentelo de nuevo';
			header("Location:categorias.php");
			exit;
		}
		
	}       
		

?>		            
