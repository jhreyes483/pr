<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutFromIni();
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


$objCon = new ControllerDoc();
?>

    <table class="table table text-center table-striped  table-bordered bg-white table-sm col-md-8 col-sm-4 col-xs-12 mx-auto">
        <thead>
            <tr>
                <th>ID producto</th>
                <th>Nombre producto</th>
                <th>Valor producto</th>
                <th>Stock producto</th>
                <th>Estado</th>
                <th>Categoria</th>
                <th>Tipo medida</th>
                <th>Accion</th>
            </tr>
        </thead>
        <?php

        //$datos = Producto::verProductos();
       $a =  $objCon->verProductos();
    //$objCon->ver($a);
      //  while ($row = $datos->fetch_array()) {
          foreach($a as $row ){
        ?>
            <tbody>
                <tr>
                    <td><?= $row[0]  ?></td>
                    <td><?= $row[2] ?></td>
                    <td><?= $row[3] ?></td>
                    <td><?= $row[4] ?></td>
                    <td><?= $row[5] ?></td>
                    <td><?= $row[6] ?></td>
                    <td><?= $row[7] ?></td>
                    <td>
                        <a class="btn btn-dark mx-auto icon-edit " href="editarProducto.php?id=<?= $row[0] ?>"><i class="fas fa-marker"></i></a>
                        <a class="btn btn-danger icon-trash " href="../metodos/get.php?accion=EliminarProducto&&id=<?= $row[0] ?>"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        <?php  } // fin de while 
        ?>
    </table>


<?php
rutFinFooterFrom();
rutFromFin();
} // fin de validar permisos
?>