<?php
/*
include_once 'plantillas/plantilla.php';

include_once 'plantillas/cuerpo/inihtmlN2.php';
include_once 'plantillas/nav/navN2.php';
include_once '../modelo/class.documento.php';
include_once '../modelo/class.rol.php';
include_once '../modelo/class.login.php';
include_once '../modelo/class.usuario.php';
include_once '../controlador/controladorsession.php';
include_once '../controlador/controlador.php';
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutIniInactiva();
cardtitulo('Mis datos');

?>



<h3 class="text-center   my-4"><em class="e">Datos Personales</em></h3>
<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body  mx-auto">
            <form class="form-group" action="../controlador/post.php" method="POST">
                <?php 

                $objModUs = new ControllerDoc();
                $datos = $objModUs -> selectIdUsuario($id);
                foreach ($datos as $i => $row){
                    
            

                /*
                if (isset($_SESSION['usuario'])) 
                    $id = $_SESSION['usuario']['ID_us'];
                    $c = new Conexion();

                    $datos = Usuario::selectUsuarios($id);
                    while ($row = $datos->fetch_array()) 
                */ 
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer nombre: </h5>
                        <input class="form-control" type="text" name="nom1" value="<?= $row['nom1'] ?>" required autofocus maxlength="20">
                        <h5>Segundo nombre: </h5>
                        <input class="form-control" type="text" name="nom2" value="<?= $row['nom2'] ?>" required autofocus maxlength="20">
                    </div><!-- primer fila de 6 -->

                    <div class="col-md-6">
                        <h5 class="t">Primer apellido: </h5>
                        <input class="form-control" type="text" name="ape1" value="<?= $row['ape1'] ?>" required autofocus maxlength="20">
                        <h5>Segundo apellido: </h5>
                        <input class="form-control" type="text" name="ape2" value="<?= $row['ape2'] ?>" required autofocus maxlength="20">

                    </div><!-- segunda fila 6 -->
                    <h5>Fecha de nacimiento: </h5>
                    <input class="form-control" type="date" name="fecha" value="<?= $row['fecha'] ?>"><br>
                </div>
        </div>
    </div>
</div>
<br>



<?php
    }
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

?>






<h3 class="text-center my-4"><em class="e">Datos de cuenta</em></h3>
<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body mx-auto">
            <h5> Correo </h5>
            <input class="form-control" type="email" name="correo" value="<?php echo $row['correo'] ?>" required autofocus maxlength="25"><br>

        </div><!-- div de row -->
    </div> <!--  div de cntainer -->
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body mx-auto">
            <input type="hidden" name="accion" value="insetUpdateUsuarioUsuario">

            <div class="card card-body col-md-12 mx-auto my-4 text-center">
                <div class="row">


                    <!-- -------------------------------------------------------------- -->


                    <div class=" col-md-3  mx-auto">
                        <input class="btn-block btn btn-dark" type="submit" name="submit" value="Actualizar datos">
                    </div>

                    </form>

                    <div class=" col-md-3  mx-auto">
                        <a class="btn-block btn btn-dark" href="forgot_password/index.html">Cambio de cotraseña</a>
                    </div>
                    <div class=" col-md-3  mx-auto">
                        <a class="btn-block btn btn-dark" href="formDatosPersonalesAjax.php">Datos personales</a>
                    </div>

                    <!-- -------------------------------------------------------------- -->
                </div>

            </div><!-- card interna -->
        </div><!-- card  -->
    </div><!-- row -->
</div><!-- div de container -->








<?php


include_once  'plantillas/cuerpo/finhtml.php';
?>