<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorrutas.php';
rutFromIni();



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
    foreach($datosRol as $i =>  $d){
?>
    <option value="<?= $d[0]   ?>"><?=  $d[1]   ?></option>
<?php  }
}
cardtitulo("Registro de Usuarios");
//=================================================================================
// HTML
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 card card-body mx-auto">
            <h5></h5>
            <form class="form-group" action="http://localhost/sicloud/controlador/api.php?apicall=createusuario" method="POST" enctype="multipart/form-data">
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
                        <h5>Numero de identificacion: </h5>      
                        <input class="form-control" type="number"  name="ID_us" required autofocus maxlength="11">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer nombre: </h5>
                        <input class="form-control" type="text" name="nom1" required autofocus maxlength="20">
                    </div>
                    <div class="col-md-6">
                        <h5>Segundo nombre: </h5>
                        <input class="form-control" type="text" name="nom2" required autofocus maxlength="20">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Primer apellido: </h5>
                        <input class="form-control" type="text" name="ape1" required autofocus maxlength="20">
                    </div>

                    <div class="col-md-6">
                        <h5>Segundo apellido: </h5>
                        <input class="form-control" type="text" name="ape2" required autofocus maxlength="20">
                    </div>
                </div><br>
                <h5>Fecha de nacimiento: </h5>
                <input class="form-control" type="date" name="fecha"><br>
                <h5>Digite su contraseña: </h5>
                <input class="form-control" type="password" name="pass" required autofocus maxlength="25"><br>
                <h5>Adjunte Foto de Perfil: </h5>
                <div >
                    <input type="text"  name="foto">
                    <!-- class="custom-file-input" id="customFile" -->
                    <label class="custom-file-label" for="customFile">Seleccione una imagen desde su equipo</label>
                </div><br><br>
                <h5>Digite su Telefono: </h5>
                <input class="form-control" type="varchar" name="tel" required autofocus maxlength="25"><br>
                <h5> Correo </h5>
                <input class="form-control" type="email" name="correo" required autofocus maxlength="25"><br>
                <input type="hidden" name="accion" value="insert">
                <input class="btn btn-success form-control my-2" type="submit" name="submit" value="Registrar">
                <a class="btn btn-success form-control btn-block" href="TablaUsuario.php">Lista usuario</a>
            </form>
        </div>
    </div>
</div>
<?php 
rutFinFooterFrom();
rutFromFin();
?>