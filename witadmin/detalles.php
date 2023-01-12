<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>WITAdmin v1</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <!--</li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>-->
        </ul>
        <form role="search">
          <input class="form-control" type="search" placeholder="Busqueda" aria-label="Search">
        </form>
      </div>
    </div>
  </nav>
	<div class="container-xl mb-4 text-center">
		
<?php
$p_wifi = $_GET['calledstationid'];
$CantidadMostrar = 10;		
include("conn.php");
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$proyecto = 'spacio1';
$datosemp = "SELECT * FROM empresas WHERE nombre='$proyecto'";
$consultaemp = $connect->query($datosemp);
while ($rowemp=mysqli_fetch_assoc($consultaemp)){
	
	$nemp = $rowemp['nombre'];
	$remp = $rowemp['rut'];
	$rzemp = $rowemp['razon_social'];
	$femp = $rowemp['fono'];
	$c_tecnico = $rowemp['con_tecnico'];
	$c_comercial = $rowemp['con_comercial'];
	$rep_wit = $rowemp['rep_wit'];
}		
	echo "<h4>LISTA DE PUNTOS</h4><br>";		
echo "<div class='mb-12 shadow-sm rounded'></br>";
		echo "<h6>DATOS CLIENTE</h6><br>";
		echo "<div class='row mb-12'>";
		echo "<div class='col mb-2'>";
		echo "<h6 class='fw-light'><strong>CLIENTE:</strong> ".$rzemp."</h6>";
		echo "</div>";
		echo "<div class='col mb-2'>";
		echo "<h6 class='fw-light'><strong>ID CLIENTE :</strong> ".$remp."</h6>";
		echo "</div>";
		echo "<div class='col mb-2'>";
		echo "<h6 class='fw-light'><strong>CONTACTO :</strong> ".$c_comercial."</h6>";
		echo "</div>";
		echo "<div class='col mb-2'>";
		echo "<h6 class='fw-light'><strong>PROYECTO :</strong> ".$nemp."</h6>";
		echo "</div></div></div><br>";	
	$obtenerfecha = "SELECT fecha_ingreso FROM inventario_equipos WHERE mac='$p_wifi'";
	$consulta_fecha = $connect->query($obtenerfecha);
	while ($rowfecha=mysqli_fetch_assoc($consulta_fecha)){
			$instfecha = $rowfecha['fecha_ingreso'];
	}	
 $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	$TotalReg       =$connect->query("SELECT * FROM radacct where calledstationid='$p_wifi' AND acctstarttime >='$instfecha'");
	$TotalConsulta = $TotalReg->num_rows ;
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
	//Consulta SQL
	$consultavistas ="SELECT username, callingstationid, acctsessiontime, acctstarttime, framedipaddress FROM radacct where calledstationid= '$p_wifi' AND acctstarttime >='$instfecha' ORDER BY acctstarttime desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	$consulta=$connect->query($consultavistas);	
//$query = "SELECT * FROM radacct WHERE calledstationid = '$p_wifi' AND `acctstarttime`>= '2022-12-20' ORDER BY acctstarttime DESC ";
//$result = mysqli_query($connect,$query);
echo "<table class='table'> 
	<thead>
	<tr>
      <th scope='col'>#</th>
	  <th scope='col'>USUARIO</th>
      <th scope='col'>NOMBRE</th>
      <th scope='col'>APELLIDO</th>
	  <th scope='col'>SEXO</th>
      <th scope='col'>MAC</th>
	  <th scope='col'>SESION</th>
	  <th scope='col'>FECHA CONEXION</th>
	  <th scope='col'>IP</th>
	  <th scope='col'>EXPORTAR</th>
	  
    </tr>
	</thead>
	<tbody>";			

$i=0;
while ($row = mysqli_fetch_assoc($consulta)){
	$username = $row['username'];
	$session = $row['acctsessiontime'];
	$segundos = $session;
	$minutos = intdiv($segundos,60);
	$restante = $segundos % 60;
	$queryinfo = "SELECT firstname,lastname,sex FROM userinfo WHERE username ='$username' ";
	$info = mysqli_query($connect,$queryinfo);
	while ($rowinfo = mysqli_fetch_assoc($info)){
		$nombre = $rowinfo['firstname'];
		$apellido = $rowinfo['lastname'];
		$sex = $rowinfo['sex'];
	}
		
	$i=$i+1;
	echo "<tr>
	<th scope='row'>".$i."</th>
	<td class='fw-light'>".$row['username']."</td>
	<td class='fw-light'>".$nombre."</td>
	<td class='fw-light'>".$apellido."</td>
	<td class='fw-light'>".$sex."</td>
	<td class='fw-light'>".$row['callingstationid']."</td>
	<td class='fw-light'>".$minutos."min ".$restante."s</td>
	<td class='fw-light'>".$row['acctstarttime']."</td>
	<td class='fw-light'>".$row['framedipaddress']."</td>
	<td class='fw-light'><a href=''>Ver</a></td>
	</tr>";
}	
echo "</tbody></table>";
echo "<nav aria-label='Page navigation example'>";
     
    /*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
  	
	echo "</tbody></table>";
	echo "<ul class='pagination justify-content-center '>
	<li class='page-item link-dark'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$DecrementNum."\" tabindex=''-1' aria-disabled='true'>Anterior</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //números  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     
     //Se valida
     $Desde=($Desde<1)?1: $Desde; 
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los números de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){
           echo "<li class='page-item'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$i."\">".$i."</a></li>";
     	  }else {
     	  	echo "<li class='page-item link-dark'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$i."\">".$i."</a></li>";
     	  }     		
     	}
     }
	echo "<li class='page-item'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$IncrimentNum."\">Siguiente</a></li></ul>";
	echo "</nav>";
	
	echo "<b>La cantidad de registro es </b>".$TotalConsulta." <b>dividió a:</b> ".$TotalRegistro." <b>para mostrar</b> 5 <b>en</b> 5";
?>
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html></strong>