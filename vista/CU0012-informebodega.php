<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutFromIni();
//comprobacion de rol
$in = true;
switch ($_SESSION['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
    break;
    case 2:
        $in = true;
    break;
    case 3:
        $in = true;
    break;

    default:
        echo "<script>alert('No tiene permiso para ingresar a este modulo');</script>";
        echo "<script>window.location.replace('index.php');</script>";
    break;
}
if ($in == false) {
    echo "<script>alert('No tiene permiso para ingresar a este modulo');</script>";
    echo "<script>window.location.replace('index.php');</script>";
} else {

    //--------------------------------------------------------------------------
cardtitulo("Informe de Bodega");
$objModFact = new ControllerDoc();
?>
<div class="card card-body text-center col-md-10 mx-auto">
    <!--<div class="container">-->
    <div class=" container-fluid ">
        <div class="card card-body ">
        </div><br>


        <form action="CU0012-informebodega.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- derecha -->
                    <label for="start">Fecha inicial:</label>
                    <div class="form-group"><input class="form-control" type="date" id="start" name="f1" value="2020-05-01" min="0000-00-00" max="9999-99-99"></div>
                    <label for="start">Fecha fin:</label>
                    <div class="form-group"><input class="form-control" type="date" id="start" name="f2" value="2020-05-25" min="0000-00-00" max="9999-99-99"></div>
                </div><!-- fin primera columna de 6 -->



                <div class="col-md-6">
                    <!-- Izquierda -->
                    Formato de descarga <br>
                    <select class="form-control">
                        Periodo promedio
                        <option>CSV</option>
                        <option>EXCEL</option>
                        <option>PDF</option>
                        <option>XML</option>
                    </select><br>

                    <div class="form-group"> <input class="btn btn-primary form-control" type="submit" value="Ver informe" name="consulta"> </div>
        </form>
        <a class="btn btn-block btn-primary my-2" href="">Imprimir informe</a>
    </div><!-- fin de segunda columna de 6 -->

</div><!-- fin de row -->
</div><!-- fin de container fluid -->
</div><!-- fin de card -->

<?php
if (isset($_POST['consulta'])) {
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
?>


    <div class="container">
        <div class="my-4">
            <div class="row">
                <table class="table table-striped table-hover bg-bordered bg-light table-sm col-md-10 col-sm-4 col-xs-12 mx-auto">
                    <thead>
                        <tr>
                            <th>ID factura</th>
                            <th>total</th>
                            <th>fecha</th>
                            <th>sub total</th>
                        </tr>
                    </thead>
                    <?php 
                    //$datos = Factura::verIntervaloFecha($f1, $f2);
                    $datos = $objModFact->verIntervaloFecha($f1, $f2);
                    //while ($row = $datos->fetch_array()) {
                        foreach($datos as $i => $row){

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['ID_factura'] ?></td>
                                <td><?php echo $row['total'] ?></td>
                                <td class=" <?php echo  $c  ?>"><?php echo $row['fecha'] ?></td>
                                <td><?php echo $row['sub_total'] ?></td>
                                <td><?php echo "Salida de producto" ?></td>
                            </tr>
                        </tbody>
                    <?php
                    } // fin de while tabla
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php
}
rutFinFooterFrom();
rutFromFin();
}// fin de validacion permisos

?>