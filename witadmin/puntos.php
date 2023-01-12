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
include("conn.php");		
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);		
$proyecto = $_POST['select'];
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
$CantidadMostrar = 10;		
 $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	$TotalReg       =$connect->query("SELECT * FROM inventario_equipos WHERE proyecto='$proyecto'");
	$TotalConsulta = $TotalReg->num_rows ;
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
	//Consulta SQL
	$consultavistas ="SELECT * FROM inventario_equipos WHERE proyecto='$proyecto' LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	$consulta=$connect->query($consultavistas);	
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
		
echo "<table class='table'> 
	<thead>
	<tr>
      <th scope='col'>#</th>
	  <th scope='col'>NOMBRE</th>
      <th scope='col'>ID</th>
      <th scope='col'>MAC</th>
	  <th scope='col'>FECHA DE INGRESO</th>
      <th scope='col'>ONLINE</th>
	  <th scope='col'>CONEXIONES</th>
	  <th scope='col'>LANDING</th>
	  <th scope='col'>DETALLES</th>
	  
    </tr>
	</thead>
	<tbody>";

$i2=0;
while ($row = mysqli_fetch_assoc($consulta)){
	$nombre = $row['nombre'];
	$mac = $row['mac'];
	$portal = $row['portal'];
	$id = $row['device_id'];
	$fecha = $row['fecha_ingreso'];
	$online = "SELECT * FROM radacct WHERE calledstationid = '$mac' AND acctterminatecause='' AND acctsessiontime<=1800";
	$result2 = mysqli_query($connect,$online);
	$resultonline = mysqli_num_rows($result2);
	$totales = "SELECT * FROM radacct WHERE calledstationid = '$mac' AND acctstarttime >= '$fecha'";
	$result3 = mysqli_query($connect,$totales);
	$num_totales = mysqli_num_rows($result3);
	$i2=$i2+1;
	echo "<tr>
	<th scope='row'>".$i2."</th>
	<td class='fw-light'>".$nombre."</td>
	<td class='fw-light'>".$id."</td>
	<td class='fw-light'>".$mac."</td>
	<td class='fw-light'>".$fecha."</td>
	<td class='fw-light'>".$resultonline."</td>
	<td class='fw-light'>".$num_totales."</td>
	<td class='fw-light'>".$portal."</td>
	<td class='fw-light'><a href='detalles.php?calledstationid=".$mac."'>Ver</a></td>
	</tr>";
	} 
if ($i2==0){
	echo "</tbody></table>";
	echo "NO EXISTEN PUNTOS ASOCIADOS A ESTE PROYECTO";
} else {		
echo "</tbody></table>";
echo "<nav aria-label='Page navigation example'>";
     
    /*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);

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
     	  	echo "<li class='page-item'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$i."\">".$i."</a></li>";
     	  }     		
     	}
     }
	echo "<li class='page-item'><a class='page-link link-dark' href=\"?calledstationid=".$p_wifi."&pag=".$IncrimentNum."\">Siguiente</a></li></ul>";
	echo "</nav>";
	
	echo "<b>La cantidad de registro es </b>".$TotalConsulta." <b>dividió a:</b> ".$TotalRegistro." <b>para mostrar</b> ".$CantidadMostrar." <b>en</b> ".$CantidadMostrar."";
	}
?>
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html></strong>