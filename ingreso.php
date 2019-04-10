<?php
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Check Login and create session</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
		
			<?php
			// Conexion 
			include 'conn.php';	
			
		
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// revisamos conexion a la base de datos su no mandamos un mysqli_connect_error erorr y cierra secion
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Datos enviados del formulario captcha.html 
			$email = $_POST['email']; 
			$password = $_POST['pass'];
			
			// Query a la base de datos
			$result = mysqli_query($conn, "SELECT email, password FROM tblagenda WHERE email = '$email'");
			
			// Variable $row mantiene el resultado de la consulta
			$row = mysqli_fetch_assoc($result);

			/* 
			La función Password_Verify () verifica si la contraseña ingresada por el usuario
			coincide con el hash de contraseña en la base de datos. Si todo está bien la sesión.
			Se crea por un minuto. Cambie 1 en $ _SESSION [start] a 5 para una sesión de 5 minutos.
			*/
			$email = filter_var($row, FILTER_SANITIZE_EMAIL);
			
		  // if (password_verify($_POST["pass"],$email))//verificar 
		
			if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			{
         		
				
				$_SESSION['loggedin'] = true;
			  $_SESSION['email'] = $row['email'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;						
				
				echo"$row";
				echo "<div class='alert alert-success mt-4' role='alert'> <strong>Hola Bienvenido!</strong> $row[email]			
			
				<p><a href='logout.php'>Salir</a></p></div>";	
			
			} else {
				
				echo "<div class='alert alert-danger mt-4' role='alert'>Email o Password es incorrecto! $row[email]	
				<p><a href='captcha.php'><strong>Ingresa Nuevamente!</strong></a></p></div>";			
				echo"";
				
			}	
			?>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	</body>
</html>