<?php


include_once '../../plantillas/plantilla.php';

/*
include_once '../../../modelo/class.categoria.php';
include_once '../../../modelo/class.producto.php';
include_once '../../../modelo/class.conexion.php';
include_once '../../../modelo/class.factura.php';

*/
include_once '../../plantillas/cuerpo/inihtmlN3.php';
include_once '../../plantillas/nav/navN3.php';
include_once '../../../controlador/ControladorSession.php';
cardtitulo(" Informes de ventas");

if (isset($_SESSION['message'])) {
?>
    <!-- alerta boostrap -->
    <div class="col-md-4 mx-auto alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
        <?php
        echo  $_SESSION['message']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    setMessage();
}

    include_once '../../../modelo/class.conexion.php';
    $c = new Conexion;
    $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
from sicloud.det_factura detf
join sicloud.factura f on f.ID_factura = detf.FK_det_factura
group by dia";
    $dat = $c->query($sql);
    $col = $dat->num_rows;
    // numero de columnas de dia

$r = 0;
   
  $d = $dat->fetch_assoc();
  $con = $d['total'] + $d['total'];
  echo $con;




?>

     <div class="container-fluid my-4 ">

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4 mx-auto">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Promedio (Diario)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
          </div>
          <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4 mx-auto">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Promedio (Semanal)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


    <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4 mx-auto">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Promedio (Mensual)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  </div>

































<div class="card col-md-4 mx-auto">
    <div class="card-body">
    <i class="fas fa-calendar fa-2x text-gray-300"></i>
        <h5 class="card-title text-center ">Seleccione Informe</h5>
        <!-- INI--FORM PRODUCTO--------------------------------------------------------------------------------- -->
        <form action="verRango.php" method="POST">
            <select name="ventas" class="form-control">

                <option value="dia">Por Dia</option>
                <option value="semana">Por Semana</option>
                <option value="mes">Por Mes</option>

            </select>
            <input type="hidden" name="accion" value='verRango'>
            <br> <input class="btn btn-primary btn-block my-2" type="submit" name="consulta" value="consulta">

    </div>
</div>
</form>




<div class="col-md-4 p-2 mx-auto my-4 ">
    <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


        <?php


        if (isset($_POST['ventas'])) {

            if ($_POST['ventas'] == 'dia') {

        ?>

                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Dia</th>
                    </tr>
                </thead>

                <?php


                $datos = Factura::verDia();
                while ($row = $datos->fetch_array()) {
                ?>


                    <tbody>
                        <tr>
                            <td> <?php echo $row['cantidad']  ?></td>
                            <td> <?php echo $row['total']  ?></td>
                            <td> <?php echo $row['dia']  ?></td>
                        </tr>
                    </tbody>


                <?php   } //while
                ?>

    </table>



<?php } // fin de consulta por dia


            //------------------------------------------FIN DE CONSULTA POR DIA-------------------------------------------


            if ($_POST['ventas'] == 'semana') {

?>

    <div class="col-md-4 p-2 mx-auto my-4 ">
        <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


            <thead>
                <tr>
                    <th>Cantidad de ventas por semana</th>
                    <th>Total</th>
                    <th>Dia cierre ventas</th>
                </tr>
            </thead>

            <?php


                $datos = Factura::verSemana();
                while ($row = $datos->fetch_array()) {
            ?>


                <tbody>
                    <tr>
                        <td> <?php echo $row['cantidad']  ?></td>
                        <td> <?php echo $row['Total']  ?></td>
                        <td> <?php echo $row['dia_final_semana']  ?></td>
                    </tr>
                </tbody>


            <?php   } //while
            ?>

        </table>

    <?php } // fin de consulta por 

    ?>

    </div><!-- fin de tabla responce -->



    <!-- fin busqueda por semana-------------------------------------------------------------------------------- -->



    <?php

            if ($_POST['ventas'] == 'mes') {

    ?>

        <div class="col-md-4 p-2 mx-auto my-4 ">
            <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">


                <thead>
                    <tr>
                        <th>Cantidad de ventas por Mes</th>
                        <th>Total</th>
                        <th>Dia cierre ventas</th>
                    </tr>
                </thead>

                <?php


                $datos = Factura::verMes();
                while ($row = $datos->fetch_array()) {
                ?>


                    <tbody>
                        <tr>
                            <td> <?php echo $row['cantidad']  ?></td>
                            <td> <?php echo $row['Total']  ?></td>
                            <td> <?php echo $row['dia_final_mes']  ?></td>
                        </tr>
                    </tbody>
                <?php   } //while
                ?>
            </table>
            </div>

        <?php } // fin de consulta por 
        } // fin de isset consulta
        include_once '../../plantillas/cuerpo/finhtml.php';
    ?>


