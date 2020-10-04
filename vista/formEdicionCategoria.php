<?php
include_once 'plantillas/plantilla.php';

include_once '../modelo/class.empresa.php';
include_once '../modelo/class.conexion.php';
include_once '../modelo/class.categoria.php';
include_once 'plantillas/cuerpo/inihtmlN2.php';
include_once 'plantillas/nav/navN2.php';
include_once '../controlador/controladorsession.php';
include_once '../controlador/controlador.php';
//-----------------------------------------------------------------------------------

cardtitulo('Edicion categoria');
//Accion editar 
if ((isset($_GET['id']))) {
    $id = $_GET['id'];
?>
    <div class="col-md-2 col col-mx-10 mx-auto">
        <div class="card">
            <div class="card-header">Registro</div>
            <div class="card-body">
                <form action="../metodos/post.php?id=<?php echo $_GET['id'] ?>" method="POST">
                    <?php 
                    $objModCat = new ControllerDoc();
                    $datos = $objModCat->verCategoriaId($id);
                    foreach($datos as $i=> $row){
                    //$sql = "SELECT * FROM sicloud.empresa_provedor WHERE ID_rut = $id ";
                    //$datos = Categoria::verCategoriaId($id);
                    //$datos = $c->query($sql);
                    //$datos = Empresa::verDatoPorId($id);
                    //while ($row = $datos->fetch_array()) {

                     ?>
                    
                        <div class="form-group"><input class="form-control" type="text" name="categoria" placeholder="Categoria" value="<?php echo $row['nom_categoria']  ?>" required autofocus maxlength="30"></div>
                    <?php } ?>
                    <input type="hidden" name="accion" value="insertUdateCategoria">
                    <div class="form-group"><input class="form-control btn btn-primary" type="submit" name="submit" value="Actualizar categoria"></div>
                </form>
            </div><!-- fin card body -->
        </div><!-- fin de card -->
    </div>
<?php
 }
include_once 'plantillas/cuerpo/finhtml.php';
?>