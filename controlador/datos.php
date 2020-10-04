<?php 
	//$conexion=mysqli_connect('localhost','root','','sicloud');
//$conexion=mysqli_connect('localhost','root','','sicloud');
include_once '../modelo/class.conexion.php';
include_once '../modelo/class.localidad.php';
include_once '../modelo/class.barrio.php';

$localidad=$_POST['localidad'];
//$barrio=$_POST['barrio'];
echo $localidad;






$datos = Barrio::verBarrioPorLocalidad($localidad);

	
	//$result=mysqli_query($conexion,$sql);

	$cadena="<label>Seleccione barrio</label>
	<div class= 'form-group'> 
			<select id='lista' name='barrio' class = 'form-control'>";

	while( $row = $datos->fetch_array()   ) {
		$cadena=$cadena.'<option value='.$row['ID_barrio'].'>'.$row['nom_barrio'].'</option>';
	}

	echo  $cadena."</select>
	</div>";






		
	
	?>
	
