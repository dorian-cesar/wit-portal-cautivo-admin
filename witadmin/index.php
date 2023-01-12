<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>WITAdmin v1</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="navbar.css" rel="stylesheet">
	
</head>
<body>
 <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">WITadmin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>--->
        </ul>
        <form role="search">
          <input class="form-control" type="search" placeholder="Busqueda" aria-label="Search">
        </form>
      </div>
    </div>
  </nav>
	<div class="container-xl mb-4 text-center">
		<div class="row">
		<div class="mb-3 col">
		</div>
		<div class="mb-6 col">
			<div class="row mb-2">
		<h3>SELECCIONE EL CLIENTE</h3>
				</div>
				<div class="row mb-2">
					<form action="puntos.php" method="post" >
		<select class="form-select form-select-sm" aria-label="Default select example" name="select">
<?php
			include("conn.php");
			$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			$query ="SELECT * FROM empresas";
			$obtener = $connect->query($query);
			while ($rowselect = mysqli_fetch_assoc($obtener))
				echo "<option value='".$rowselect['nombre']."'>".$rowselect['nombre']."</option>"
?>
						</select>		
			</div>
			<div class="row mb-2">
				<input class="btn btn-primary" value="Iniciar" type="submit">
				</form>
				</div>
		</div>
			<div class="mb-3 col"></div>

		</div>
	<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>