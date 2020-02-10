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

		$idProducto= $_GET['idProducto'];
		$sql = "DELETE FROM productos WHERE idProducto = '$idProducto'"; //borro de la bd
		
		$result = mysqli_query($conex,$sql);//ejecuta consulta 
		
		        
		$_SESSION['error'] = '';
			header("Location:tusproductos.php");
			exit;

?>		            

