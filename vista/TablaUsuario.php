<?php

include_once 'plantillas/plantilla.php';
include_once 'plantillas/nav/navgeneral.php';
include_once 'plantillas/cuerpo/inihtmlN1.php';
include_once '../modelo/class.usuario.php';
include_once '../controlador/controladorsession.php';

?>


<script>
    function eliminarCategria(id_to_delete){
        var confirmacion = 
confirm('Esta seguro que desea elminar usuario con id: ' + id_to_delete + ' ?');
if(confirmacion){
window.location = "../controlador/get.php?accion=eliminarUsuario&&id="+ id_to_delete;
}

   }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="container my-5 mx-auto">
        <div class="card card-body">
            <h3 class="text-center">Consulta de Usuarios</h3>
        </div>
    </div>




        <div class="col-md-10 my-5 mx-auto">
            <table class="table table-bordered  table-striped bg-white table-sm mx-auto text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">primer nombre</th>
                        <th scope="col">segundo nombre</th>
                        <th scope="col">primer apellido</th>
                        <th scope="col">segundo apellido</th>
                        <th scope="col">fecha</th>
                        <th scope="col">contraseña</th>
                        <th scope="col">foto</th>
                        <th scope="col">correo</th>
                        <th scope="col">tipo documento</th>
                        <th scope="col">Accion</th>
                        <?php

                        $objus= Usuario::ningunDato();
                        $datos = $objus->readUsuarioModel();
                        

                            if(isset($datos)){

                                foreach ($datos as $i => $d){
                            
                           
                        ?>
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <td><?= $d[0] ?></td>
                    <td><?= $d[1] ?></td>
                    <td><?= $d[2] ?></td>
                    <td><?= $d[3] ?></td>
                    <td><?= $d[4] ?></td>
                    <td><?= $d[5] ?></td>
                    <td><?= $d[6] ?></td>
                    <td><?= $d[7] ?></td>
                    <td><?= $d[8] ?></td>
                    <td><?= $d[9] ?></td>
                    <td>
                        <a href="http://localhost/sicloud/vista/EditarUsuario.php?ID_us=<?= $d[0] ?> " class="btn btn-circle btn-secondary">
                        <i class="fas fa-search fa-sm"></i>
                        <a href="http://localhost/sicloud/controlador/api.php?apicall=elimianarUsuario&&id=<?= $d[0] ?> "  class="btn btn-circle btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                    </td>
                </tr>

                <?php

                                }
                            }
                            ?>
                </tbody>
            </table>
        </div>  


<?php 
include_once 'plantillas/cuerpo/footerN1.php'; 
include_once 'plantillas/cuerpo/finhtml.php';
?>