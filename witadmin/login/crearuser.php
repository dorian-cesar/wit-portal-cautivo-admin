<?php
session_start();
?>
<!doctype html>

<html lang="es">
  <head>
    <title>Crear Usuario</title>
    
	<!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="css/custom.css">
		<style type="text/css">
		body {
    background-color: rgba(13,13,13,1);
}
        body,td,th {
    color: #FFFFFF;
}
        </style>
  </head>
  <body>
	      <?php
 //if (isset($_SESSION['loggedin'])) {  
    //}
    //else {
      //  echo "<div class='alert alert-danger mt-4' role='alert'>
        //<h4>Necesita iniciar sesion para ver esta pagina.</h4>
        //<p><a href='../login.php'>Ingresar aquí!</a></p></div>";
        //exit;
    //}
    // checking the time now when check-login.php page starts
    //$now = time();           
    //if ($now > $_SESSION['expire']) {
      //  session_destroy();
       // echo "<div class='alert alert-danger mt-4' role='alert'>
        //<h4>Su session ha expire!</h4>
        //<p><a href='../login.php'>Ingresar Aqui</a></p></div>";
        //exit;
        //}
    ?>
	  <p></p>
  
  <div class="container">
		<div class="row">
			<div class="col-sm-12">	
		  <center><img src="../ico/logo.svg " width="200" alt=""/></center> </div>
	</div>
	
	<div class="row">	
		<div class="col-sm-12 col-md-6 col-lg-6">
		
		<h3 class="text-light">Crear Cuenta</h3><hr />
		
		<form method="post" action="create-account.php" method="POST">
			<div class="form-group">				
				<input type="text" class="form-control" name="name" placeholder="Ingrese Nombre" required>			
		  </div>
			<div class="form-group">				
				<input type="text" class="form-control" name="ape" placeholder="Ingrese Apellido" required>			
		  </div>
		  
		  <div class="form-group">				
				<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Ingrese su E-Mail" required>
			</div>
			  <div class="form-group">				
				<input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="ingrese su Usuario" required>
			</div>
		  
		  <div class="form-group">				
				<input type="password" class="form-control" name="password" placeholder="Cree su Password" required>
			</div>
			  <div class="form-group">				
				<select name="rol" class="form-control" required >
					<option>Seleccione ROL</option>
				  <option value="1">SuperAdmin</option>
					<option value="2">Admin</option>
					<option value="3">Operador</option>
					<option value="4">Cliente</option>
				  </select>
			</div>
		  
		  <button type="submit" class="btn btn-secondary btn-block">Crear mi cuenta</button>
		</form>		
		</div>		
		<div class="col-sm-12 col-md-6 col-lg-6">
			<h3 class="text-light">Iniciar</h3><hr />
			<p class="class="text-light" >Ya tienes cuenta? <a href="../login.php" title="Login Here">Ingrese Aquí!</a></p>
		</div>
	</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
 
	</body>
</html>