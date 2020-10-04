<?php

include_once '../../../controlador/ControladorSession.php';
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
    include_once '../../plantillas/plantilla.php';
    include_once '../../plantillas/cuerpo/inihtmlN3.php';
    include_once '../../plantillas/nav/navN3.php';

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
            $datos = Producto::ConteoProductosT();
            while ($row = $datos->fetch_array()) {
            ?>
                <tbody>
                    <tr>
                        <td> <?php echo $row['nom_prod']  ?></td>
                        <td> <?php echo $row['total']  ?></td>
                    </tr>
                </tbody>
            <?php    }  ?>
        </table>
    </div><!-- fin de div tabla responce -->

<?php
} // fin de validar permisos
include_once '../../plantillas/cuerpo/finhtml.php';
?>