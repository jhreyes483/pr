<?php
include_once '../controlador/controlador.php';
include_once '../controlador/post.php';
include_once 'plantillas/plantilla.php';
include_once 'plantillas/cuerpo/inihtmlN1.php';
include_once 'plantillas/nav/navN1.php';
include_once '../controlador/controladorsession.php';
?>
<?php
function selectDocumeto(){
    $objConDoc =  Documento::ningunDatoD();
    $datos     =  $objConDoc->verDocumeto();
    foreach($datos as $i => $d ) {
    ?>
    
        <option value="<?= $d[0] ?>"><?= $d[1] ?></option>
    <?php  }   
}

function selectRol(){
    $objConRol =  Rol::ningunDato();
    $datosRol  =  $objConRol->verRol();
    foreach($datosRol as $i =>  $d) {
    ?>
        <option value="<?= $d[0]   ?>"><?=  $d[1]   ?></option>
    <?php  }
}
$objConRol =  Rol::ningunDato();
$datosRol  =  $objConRol->verRol();

echo '<pre>'; print_r($datosRol); echo '</pre>';

cardtitulo("Actualizar Usuario");
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body mx-auto">
            <h5></h5>
            <form class="form-group" action="http://localhost/sicloud/controlador/api.php?apicall=actualizarUsuario&&id=<?= $_GET['ID_us'] ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center card-title">
                            </em> </h5>
                        </div><br>
                        <div class="col-md-12">
                            <!-- contenedor -->
                            <div class="row">
                                <!-- inicion fila selector de documento y rol -->
                                <div class="col-md-6">
                                    <h5>Seleccione el tipo de documento: </h5>
                                    <select class="form-control" name="FK_tipo_doc">
<?php  selectDocumeto();  ?>
                                    </select>

                                </div><!-- fin de columna de 6 -->
                                <div class="col-md-6">

                                    <h5>Seleccione rol</h5>
                                    <div class="form-group">

                                        <select name="FK_rol" class="form-control">
                                           <?php  selectRol();  ?>
                                        </select>
                                    </div><!-- fin de form-group select de  -->
                                </div><!-- fin de columna de 6 -->
                            </div><!-- row fin de fila -->
                        </div><!-- fin contenedor  de selectores -->
<?php
$id = $_GET['ID_us'];
$objus= Usuario::ningunDato();
$datos = $objus->verDatoPorId($id);
if(isset($datos)){
    foreach ($datos as $i => $d){
?>
                        <h5>Numero de identificacion: </h5>
                        
                        <input class="form-control" type="number"  name="ID_us" value="<?= $d[0]; ?>" required autofocus maxlength="11">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer nombre: </h5>
                        <input class="form-control" type="text" name="nom1" value="<?= $d[1]; ?>" required autofocus maxlength="20">
                    </div>

                    <div class="col-md-6">
                        <h5>Segundo nombre: </h5>
                        <input class="form-control" type="text" name="nom2" value="<?= $d[2]; ?>" required autofocus maxlength="20">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer apellido: </h5>
                        <input class="form-control" type="text" name="ape1" value="<?= $d[3]; ?>" required autofocus maxlength="20">
                    </div>

                    <div class="col-md-6">
                        <h5>Segundo apellido: </h5>
                        <input class="form-control" type="text" name="ape2" value="<?= $d[4]; ?>" required autofocus maxlength="20">
                    </div>
                </div><br>

                <h5>Fecha de nacimiento: </h5>
                <input class="form-control" type="date" value="<?= $d[5]; ?>" name="fecha"><br>

                <h5>Digite su contraseña: </h5>
                <input class="form-control" type="password" name="pass" value="<?= $d[6]; ?>" required autofocus maxlength="25"><br>

                <h5>Adjunte Foto de Perfil: </h5>
                <div >
                    <input type="text"  name="foto" value="<?= $d[7]; ?>" >
                    <!-- class="custom-file-input" id="customFile" -->
                    <label class="custom-file-label" for="customFile">Seleccione una imagen desde su equipo</label>
                </div><br><br>

                <h5> Correo </h5>
                <input class="form-control" type="email" name="correo" value="<?= $d[8]; ?>"  required autofocus maxlength="25"><br>
<?php
    }
}
?>
                <input type="hidden" name="accion" value="insertUpdateUsuario">
                <input class="btn btn-success form-control my-2" type="submit" name="submit" value="Actualizar datos">
                <a class="btn btn-success form-control btn-block" href="TablaUsuario.php">Lista usuario</a>
            </form>
        </div>
    </div>
</div>
<?php 
include_once 'plantillas/cuerpo/footerN1.php'; 
include_once 'plantillas/cuerpo/finhtml.php';
?>