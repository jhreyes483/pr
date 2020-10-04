<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutFromIni();
/*
//include_once './plantillas'
include_once './plantillas/plantilla.php';
include_once '../modelo/class.conexion.php';
include_once '../modelo/class.categoria.php';
include_once '../modelo/class.producto.php';
include_once '../modelo/class.medida.php';
include_once '../modelo/class.proveedor.php';
//palntilla
include_once './plantillas/cuerpo/inihtmlN1.php';
include_once './plantillas/nav/navN1.php';
include_once '../controlador/controladorsession.php';

*/
cardtitulo("Editar producto");
$objCon = new ControllerDoc();
?>

<div class="card card-body text-center  col-md-10 mx-auto p-2 ">
    <div class=" container-fluid ">
        <div class="card card-body shadow mb-5"> <br>
            <div class="row">

                <?php

                if(isset($_GET['id']))$datos = $objCon->verProductosId($_GET['id']);

                
                //Producto::
               // while ($row = $datos->fetch_array()) {
                 foreach($datos as $row){ 
                ?>
                    <div class="col-md-4">
                        <!-- inicio de divicion 1 -->
                        <form action="../metodos/post.php?accion=editarProducto&&id=<?= $row['ID_prod'] ?>" method="POST">
                            <!-- derecha -->
                            <div class="form-group"><label for="">ID Producto</label><input class="form-control" value="<?= $row['ID_prod'] ?>" type="text" placeholder="ID producto" value="<?php $row['ID_prod']  ?> " ; name="ID_prod"></div>
                            <div class="form-group"><label for="">Nombre Producto</label><input class="form-control" value="<?= $row['nom_prod']  ?>" type="text" class="form-control" placeholder="Nombre producto" name="nom_prod"></div>
                            <div class="form-group"><label for="">Valor Producto</label><input class="form-control" type="number" value="<?= $row['val_prod']  ?>" class="form-control" placeholder="Valor" name="val_prod"></div>
                            <div class="form-group"> <input class="btn btn-primary form-control" type="submit" name="submit" value="Actualizar producto"> </div>

                    </div><!-- fin de primera divicion-->

                    <div class="col-md-4">
                        <!-- inicio de 2 divicion -->
                        <!-- Izquierda -->


                        <div class="form-group">
                            <label for="">Selecciones estado</label>
                            <select name="estado_prod" class="form-control">
                                <option value="Actvo">Actvo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group"><label for="">Stock Inicial</label><input type="number" class="form-control" value="<?php echo $row['stok_prod'] ?>" name="stok_prod" required autofocus></div>
                        <div class="form-group"><label for="">ID factura Proveedor</label><input type="text" class="form-control" value="<?php echo "22" ?>" name="num_fac_ing" autofocus></div>
                        <div class="form-group"><label for="">Fecha de resepcion</label><input type="date" class="form-control" placeholder="Proveedor" value="2020-05-22" min="0000-00-00" max="9999-99-99" name="fecha"></div>
                    </div><!-- fin de segunda divicion-->
                    <div class="col-md-4">
                        <div class="form-group"><label for="">Categoria de producto</label><br>
                        <?php  }  ?>
                            <select class="form-control" name="CF_categoria">
                                <?php
                               //  $categoria = Categoria::ningunDatoC();

                                $datos = $objCon->verCategorias();
                                foreach( $datos as $row){
                                ?>
                                    <option value="<?= $row['ID_categoria'] ?>"><?= $row['nom_categoria'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div><!--  fin de form-group Producto -->


                        <div class="form-group"><label for="">Medida</label>
                            <select class="form-control" name="CF_tipo_medida">
                                <?php
                               // $medida = Medida::ningunDatoM();
                                $datos = $objCon->verMedida();
                            //    while ($row = $datos->fetch_array()) {
                                foreach($datos as $row){
                                ?>
                                    <option value="<?= $row[0] ?>"><?= $row[1] ?></option>

                                <?php }

                                ?>
                            </select>
                        </div><!--  fin de form-group Medida -->


                        <div class=" form-group"><label for="">Provedor</label>
                            <select class="form-control" name="FK_rut">
                                <?php
                                //$proveedor =  Proveedor::ningunDatoP();

                                $datos = $objCon->verProveedor();
                               // while ($row = $datos->fetch_array()) {
                                foreach( $datos as $row){
                                ?>
                                    <option value="<?php echo $row['ID_rut']  ?>"> <?php echo $row['nom_empresa']  ?> </option>
                                <?php  } ?>
                            </select>
                        </div><!--  fin de form-group Provedor-->

                        <input type="hidden" name="accion" value="insertProductoUpdate">
                        <!-- BOTON A ENLACE TABLA -->
                        <div class="form-group "><a class="btn btn-primary form-control" href="../CU004-crearProductos.php?accion=verProducto">Ver productos existentes</a></div>
                        </form>
                    </div><!-- fin de tercera divicion -->
            </div><!-- row -->
        </div><!-- fin card body interno -->
    </div><!-- fin de container fluid -->
</div><!-- Card externo -->


<?php
if (isset($_GET['accion'])) {
    echo print_r($_GET);
    echo "estoy en el get";

    if ($_GET['accion'] == 'verProducto'); {
?>


        <table class="table table table-striped  table-bordered bg-white table-sm col-md-8 col-sm-4 col-xs-12 mx-auto">
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

            $datos =  $objCon->verProductos();
           foreach($datos as $row ){

            ?>
                <tbody>
                    <tr>

                        <td><?= $row['ID_prod']  ?></td>
                        <td><?= $row['nom_prod'] ?></td>
                        <td><?= $row['val_prod'] ?></td>
                        <td><?= $row['stok_prod'] ?></td>
                        <td><?= $row['estado_prod'] ?></td>
                        <td><?= $row['CF_categoria'] ?></td>
                        <td><?= $row['CF_tipo_medida'] ?></td>
                        <td>
                            <a class="btn btn-circle btn-success mx-auto icon-edit " href="metodos/get.php?accion=EditarProducto&&id=<?php echo $row['ID_prod'] ?>"><i class="fas fa-marker"></i></a>
                            <a class="btn btn-circle btn-danger icon-trash " href="metodos/get.php?accion=EliminarProducto&&id=<?php echo $row['ID_prod'] ?>"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>

                </tbody>

            <?php  } // fin de while 
            ?>
        </table>

<?php

    } // fin de accion ver producto
} // fin de asset get accion
rutFinFooterFrom();
rutFromFin();

?>