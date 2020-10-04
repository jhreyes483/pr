<?php

include_once '../controlador/controladorsession.php';
include_once '../controlador/controlador.php';
//comprobacion de rol
$in = false;
switch ($_SESSION['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
    break;
    case 2:
        $in = true;
    break;
    case 0:
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
    include_once 'plantillas/plantilla.php';
    include_once 'plantillas/cuerpo/inihtmlN1.php';
    include_once 'plantillas/nav/navN1.php';

    /*
    include_once '../../clases/class.categoria.php';
    include_once '../../clases/class.producto.php';
    include_once '../../plantillas/plantilla.php';
    */
?>

    <div class="my-4">
        <?php
        cardtitulo("Conteo de productos");
        ?>
    </div>


    <div class="col-md-4 p-2 mx-auto my-4 ">
        <table class="table table-bordered  table-striped bg-white table-sm mx-auto   text-center">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <?php
            $objP = new ControllerDoc(); 
            $datos = $objP->ConteoProductosT();
            foreach($datos as $i => $row){
            //while ($row = $datos->fetch_array()) {
            ?>
                <tbody>
                    <tr>
                        <td> <?= $row['nom_prod']  ?></td>
                        <td> <?= $row['total']  ?></td>
                    </tr>
                </tbody>
            <?php    }  ?>
        </table>
    </div><!-- fin de div tabla responce -->

<?php
} // fin de validar permisos
include_once 'plantillas/cuerpo/finhtml.php';
?>