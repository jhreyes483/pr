<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutFromIni();

//comprobacion de rol
$in = false;
switch ($_SESSION['usuario']['ID_rol_n']) {
    case 1:
        $in = true;
    break;
    case 4:
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

    //------------------------------------------------------------------------------------

    include_once 'plantillas/plantilla.php';
   // include_once 'clases/class.usuario.php';
    include_once '../modelo/class.factura.php';
  //  include_once 'clases/class.producto.php';

?>
    <!-- col 12 -->
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php //include_once 'js/scripts.php';  

        include_once '../controlador/controladorsession.php';
        include_once '../controlador/controlador.php';
        include_once 'plantillas/cuerpo/inihtmlN1.php';
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facturacion</title>
        <script type="text/javascript" src = "js/funcions.js"></script>
    </head>
    <body>
        
<div class="container-fluid col-md-8 my-4">
   <div class="row">
            <!-- Formulario datos cliente---------------------------------------------------------------------------------------------- -->
            <div class="col-md-12">
                <h2 class="my-4 e">Nueva venta</h2>
                <p class="e">Datos de cliente</p>
                <div class="card card-body">
                    <form action="CU005-facturacion.php"> 
                        <button type="submit" class="btn btn-outline-success col-md-1 my-1 btn-sm">Buscar</button>
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group"><label for="">Cedula Cliente</label><input type="text" value= "" class="form-control" name="ID" id="nit_cliente" /></div>
                                </div><!-- fin de primera divicion de 3 -->
                                </form>
                    <?php
                    if (isset($_GET['ID'])){
                        $id_us=$_GET['ID'];
                        $objModFact = new ControllerDoc();
                        $datos = $objModFact->verUsuarioFactura($id_us);
                        //$us = Factura::verUsuarioFactura($_GET['ID']);
                    //while ($row = $us->fetch_assoc()) {
                        foreach($datos as $i=>$row){
                       ?>

                        <div class="col-md-4">
                            <div class="form-group"><label for="">Nombre</label><input type=»text» readonly=»readonly» class="form-control" value="<?php echo $row['nom1'] . $row['nom2'] . " " . $row['ape1'] . " " . $row['ape2'];  ?>" /></div>
                        </div><!-- fin de segunda divicion de 3 -->
                        <div class="col-md-4">
                            <div class="form-group"><label for="">Telefono</label><input type=»text» readonly=»readonly» class="form-control" value="<?php echo $row['tel'] ?>" /></div>
                        </div><!-- fin de tercera divicion de 3 -->
                        <div class="form-group col-md-12"><label for="">Direccion</label><input type=»text» readonly=»readonly» class="form-control" value="<?php echo $row['dir'] ?>" /></div>
                        <?php       } 
                            } ?>
                </div><!-- fin de div row -->
            </div><!-- fin de card -->
        </div><!-- fin de card -->
    </div>
    <!-- Formulario datos cliente---------------------------------------------------------------------------------------------- -->



    <!-- Formulario datos cliente---------------------------------------------------------------------------------------------- -->
    <div class="col-md-12">
        <br><br><br>
        <p class="e">Datos de venta</p>
        <div class="card card-body ">
            <div class="card card-body  shadow">
                <div class="row">
                    <p>
                        <label for="">Vendedor</label><br>
                        <?php echo $_SESSION['usuario']['nom1'] . " " . $_SESSION['usuario']['ape1']; ?>
                    </p>

                    <div class="ml-auto"><label for="">Accion</label><br><a href="#" class="btn btn-danger  ">Anular</a></div>
                </div><!-- fin de row -->
            </div><!-- fin de row -->
        </div><!-- fin de card -->
    </div><br><br>
    <!-- Formulario datos cliente---------------------------------------------------------------------------------------------- -->
    </div>


    <!-- tabla de productos 01-------------------------------------------------------------------------------------- -->



    <div class="col-md-12">
        <table class="table table-striped bg-bordered bg-white table-sm col-md-12 col-sm-4 col-xs-12 my-4 text-center mx-auto">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>Codigo</th>    
                    <th>Producto</th>
                    <th>Existencia</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Precio Total</th>
                    <th>Accion</th>         
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id= "txt_description">-</td>
                    <td id= "txt_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precion" class="text-right">0.00</td>
                    <td id="txt_precion" class="text-right">0.00</td>
                    <td><a href="#" id="add_product_venta" class="btn btn-circle btn-success"><i class ="fass fa-plus"></i>
                </a></td>
                </tr>

                    <?php
                    if (isset($_GET['id_p'])) {
                   //     $datos = Producto::verProductosId($_GET['id_p']);
                    $objModProd = new ControllerDoc();
                    $datos = $objModProd->verProductosId($id_p);
                   //     while ($row = $datos->fetch_array()) {
                    foreach($datos as $i => $row){
                    ?>

                <thead class="bg-dark text-white text-center">
                <tr>
                    <th>Codigo</th>
                    <th colspan="2">Descripcion</th>
                    <th>Cavtidad</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Precio Total</th>
                    <th>Accion</th>
                </tr>
                </thead>
            </tbody>
    <?php  } ?>
        </table>

        <div class="col-lg-2 mx-auto">
            <div class="card card-body ">
                <a class = "btn btn-blok btn-dark" type="text" href="ajax/showFactura.php">Factura</a>
            </div>
        </div>
  </div>
</div>
<?php
rutFinFooterFrom();
rutFromFin();
}
 } ;// fin de validacion permisos de ingreso
?>

