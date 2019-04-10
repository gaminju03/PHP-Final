<?php
session_start(); 
include_once $_SERVER['DOCUMENT_ROOT'].'./os/captcha/securimage/securimage.php'; 
 

 $errores=array("Error y o Contraseña","error en captcha");

if (isset($_POST['email'])  )
{
   $captcha=new Secureimage();

    if($captcha->check($_POST["captcha_code"])==false){
        $error=1;
    }
    else{

        $email=$_POST['email'];
        $password=$_POST['password'];
    }
}

?>

<html lang="en">
<head>
  
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        
        <link src="css/estilos.css" rel="stylesheet">


        <!--Pulling Awesome Font -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


</head>
<body>
<form method="POST" action="ingreso.php">
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
            <h4>Bienvenido .</h4>
            <input type="text" id="email" name="email" class="form-control input-sm chat-input" placeholder="email" required />
            </br>
            <input type="text" id="pass" name="pass" class="form-control input-sm chat-input" placeholder="password" required />
            </br>
            
            <img id="captcha" src='./securimage/securimage_show.php' alt="CAPTCHA Image" />
            
            <input type="text" name="captcha_code" size="10" maxlength="6" />
            <a href="#" onclick="document.getElementById('captcha').src = './securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
            
            </br>
            <div class="wrapper">
            <span class="group-btn">     
                <button type="submit" class="btn btn-primary btn-md">Ingresar <i class="fa fa-sign-in"></i></a>
            </span>
            </div>
            </div>
        
        </div>
    </div>
</div>
    
</body>
</html>