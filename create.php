<!doctype html>
<html lang="en">
  <head>
    <title>Create account on database</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
<body>

<div class="container">

	<?php

	include 'conn.php';

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Query to check if the email already exist
	$checkEmail = "SELECT * FROM tblagenda WHERE Email = '$_POST[email]' ";

	// Variable $result hold the connection data and the query
	$result = $conn->query($checkEmail);

	// Variable $count hold the result of the query
	$count = mysqli_num_rows($result);

	// si el email existe en la base de datos Mandara un error el email ya existe 
	if ($count == 1) {
	echo "<div class='alert alert-warning mt-4' role='alert'>
					<p>Este Email ya existe en la Base de Datos</p>
					<p><a href='captcha.php'>Logeate</a></p>
				</div>";
	} else {	
	
	/*
	si el email no existe en la base de datos se creara uno nuevo 
	*/
	
	$email = $_POST['email'];
	$pass = $_POST['password'];
	
	//La función password_hash () convierte la contraseña en un hash antes de enviarla a la base de datos
	$passHash = password_hash($pass, PASSWORD_DEFAULT);
	
	// Consulta para enviar hash de nombre, correo electrónico y contraseña a la base de datos
	$query = "INSERT INTO tblagenda (id, Email, Password) VALUES (null, '$email', '$pass')";
	       
	if (mysqli_query($conn, $query)) {
		echo "<div class='alert alert-success mt-4' role='alert'><h3>Se a Registrado Usuarios Nuevo</h3>
		<a class='btn btn-outline-primary' href='captcha.php' role='button'>Login</a></div>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}	
	}	
	mysqli_close($conn);
	?>
</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>