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
	
					    
	if($_POST['nombre'] == '' or $_POST['apellido'] == '' or $_POST['email'] == '' or $_POST['telefono'] == '' or $_POST['clave'] == '' or $_POST['confirmarclave'] == '')
	{ 
	    $_SESSION['error'] = 'Por favor llene todos los campos.'; //mensaje en pantalla
		header("Location:perfil.php");
		exit;
	} else { 
		$email= $_POST['email'];
		$sql= "SELECT * FROM usuarios WHERE email='$email'"; //consulta a bd
		$result = mysqli_query($conex,$sql); //ejecuta consulta 
	
				  			//obtengo el numero de filas de un resultado
					        if( mysqli_num_rows($result) == 0 )
					        { 
					            if($_POST['clave'] == $_POST['confirmarclave'])//Si los campos son iguales, continua el registro y caso contrario saldrá un mensaje de error.
					            { 
									$nombre= $_POST['nombre'];
									$apellido= $_POST['apellido'];
									
									$telefono= $_POST['telefono'];
									$clave= $_POST['clave'];
									$sql = "INSERT INTO usuarios (nombre,apellido, email, telefono,clave) VALUES ('$nombre','$apellido','$email','$telefono','$clave')";//Se insertan los datos a la base de datos y el usuario ya fue registrado con exito.
					                $result = mysqli_query($conex,$sql);
					                
					                
					            	


					                
									
									$_SESSION['error'] = 'Usted se ha registrado correctamente.';
									header("Location:ingresar.php");
									exit;
					                
					            } 
					            else 
					            { 
									$_SESSION['error'] = 'Las claves no son iguales, intente nuevamente.';
									header("Location:perfil.php");
									exit;
					          
					            } 
					        } 
					        else 
					        { 
								$_SESSION['error'] = 'Ya existe un usuario con este email.';
								header("Location:perfil.php");
								exit;
					            
					        } 
					    } 
?> 
