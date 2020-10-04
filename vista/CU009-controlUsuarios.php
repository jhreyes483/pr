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
    case 3:
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

    //--------------------------------------------------------------------------
    include_once '../controlador/controlador.php';
    include_once 'plantillas/plantilla.php';
    include_once 'plantillas/cuerpo/inihtmlN1.php';
    include_once 'plantillas/nav/navN1.php';
    $objCon = new ControllerDoc();
    $tabla = false;
    cardtituloS("Administrador de solicitiudes")
?>

    <script>
        function desactivarCuenta(id_to_delete) {
            var confirmation = confirm('Esta seguro que desea desactivar: ' + id_to_delete + ' ?');
            if (confirmation) {
                window.location = "../controlador/api.php?apicall=desactivarUsuario&&id=" + id_to_delete;
            }
        }
    </script>
    <script>
        function activarCuenta(id_to_delete) {
            var confirmation = confirm('Esta seguro que desea activar: ' + id_to_delete + ' ?');
            if (confirmation) {
                window.location = "../controlador/api.php?apicall=activarCuenta&&id=" + id_to_delete;
            }
        }
    </script>
    <div class="card card-body my-4 col-lg-2 mx-auto">
        <button class="btn btn-primary toggle" id="">Buscar Usuario</button>
    </div>
    <div class="card card-body col-md-8 mx-auto my-2 text-center form">
        <div class="card-title ">Filtros</div>
        <div class="row">
            <!-- Primera fila  4 de 12 col-->
            <div class="card card-body col-md-4 shadow ">
                <h6>Busqueda por ID</h6>
                <div class="card card-body mx-auto col-10 my-2 shadow border">
                    <!-- form por id -->
                    <form action="CU009-controlUsuarios.php" method="GET">
                        <div class="form-group"><input type="text" class="form-control " placeholder="ID usuario " name="documento" value="<?php if (isset($_GET['documento'])) {
                                                                                                                                            } ?>"></div>
                        <input type="hidden" value="bId" name="accion">
                        <div class="form-group "><input class="btn btn-primary form-control " type="submit" value="Buscar id"></div>
                    </form>
                    <!-- fin de form por id -->
                </div><!-- fin de card -->
            </div><!-- fin de primera divicion -->
            <!-- -------------------------------------------------------------- -->

            <!-- Segunda fila 8 de  12 col-->
            <div class="card card-body col-md-4 shadow">
                <h6>Busqueda por Estado de cuenta</h6>
                <div class="card card-body mx-auto col-10 my-2 shadow border">
                    <form action="CU009-controlUsuarios.php" method="POST">
                        <div class="form-group">
                            <select name="estado" class="form-control ">
                                <option value="p">Pendientes</option>
                                <option value="a">Aprobados</option>
                            </select>
                        </div>

                        <input type="hidden" value="estado" name="accion">
                        <div class="form-group "><input class="btn btn-primary form-control " type="submit" value="Registros"></div>
                    </form><!-- fin de form estado filtro estado de cuenta -->
                </div><!-- fin de card -->
            </div><!-- fin de segundsa divicion -->
            <!-- -------------------------------------------------------------- -->
            <!-- Tercera fila 12 de 12 col bootstrap-->
            <div class="card card-body col-md-4 shadow">
                <h6>Busqueda por rol</h6>
                <div class="card card-body mx-auto col-10 my-2 shadow border">
                    <!-- formulario de filtro por rol -->
                    <div class="form-group">
                        <form action="CU009-controlUsuarios.php" method="POST">
                            <select name="rol" class="form-control ">
<?php
$d =  $objCon->verRol();
foreach ($d as $i => $d) {
?>
    <option value="<?= $d[0] ?>"><?= $d[1] ?></option>
<?php
}  ?>
                            </select>
                    </div><!-- fin de form control -->
                    <input type="hidden" name="accion" value="consRol">
                    <div class="form-group"><input class="form-control btn btn-primary" type="submit"></div>
                    </form><!-- fin form ver por rol -->
                </div><!-- fin de card -->
            </div><!-- fin de tercera divicion -->

            <!-- -------------------------------------------------------------- -->
        </div><!-- fin de row -->
    </div>


    <?php
    //--- EVENTOS DE FORMULARIO----------------------------------------------------------------------
    if (isset($_REQUEST['accion'])) {
        switch ($_REQUEST['accion']) {
            case 'bId':
            // Filtro por id
                $tabla = true;
                if ($_GET['documento'] > 0) {
                    $id = $_GET['documento'];
                    $datos = $objCon->selectIdUsuario($id);
                    $_SESSION['message'] = "Filtro por id";
                    $_SESSION['color'] = "info";
                } else {
                    $_SESSION['message'] = "No ha digitado el ID del usuario";
                    $_SESSION['color'] = "danger";
                }
                break;
            case 'estado':
            // Filtro por estado de cuenta
                $tabla = true;
                if ((isset($_POST['estado']))) {
                    if ($_POST['estado'] == "a") {
                        $estado = 1;
                        $_SESSION['message'] = "Filtro por cuentas activadas";
                        $_SESSION['color'] = "info";
                    } else {
                        $estado = 0;
                        $_SESSION['message'] = "Filtro por cuentas deshabilitadas";
                        $_SESSION['color'] = "info";
                    }
                    $datos = $objCon->selectUsuariosPendientes($estado);
                }
            break;    
            case 'consRol':
            // Filtro por rol de usuario
                $tabla = true;
                $id = $_POST['rol'];
                $datos = $objCon->selectUsuarioRol($id);
            default:
                setMessage();
            break;
        }
    }

if (isset($_SESSION['message'])) {  ?>
    <!-- alerta boostrap -->
    <div class="alert text-center col-md-4 mx-auto alert-<?= $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
        <?php
        echo  $_SESSION['message']  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    setMessage();
}

if ((isset($datos))  && ($tabla == true)) { 
?>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="example" style="width:100%" class=" col-lg-12  table-bordered  table-striped bg-white   mx-auto">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Tipo doc</th>
                            <th>Documento</th>
                            <th>P. Nombre</th>
                            <th>S. Nombre</th>
                            <th>P. Apellido</th>
                            <th>S. Apellido</th>
                            <th>Rol</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>

<?php
foreach ($datos as $i  => $d) {
    
?>
                            </tr>
                    </thead>
                    <tbody>
                        <!-- Los nombres que estan en [''] son los mismos de los atributos de la base de datos de lo contrario dara un error -->
                        <td><img class="img-profile ml-3 rounded-circle mx-auto" src="fonts/us/<?= $d['foto']; ?>" alt="Card image cap" height="65" width="70"></td>
                        <td><?= $d['FK_tipo_doc'] ?></td>
                        <td><?= $d['ID_us'] ?></td>
                        <td><?= $d['nom1'] ?></td>
                        <td><?= $d['nom2'] ?></td>
                        <td><?= $d['ape1'] ?></td>
                        <td><?= $d['ape2'] ?></td>
                        <td><?= $d['nom_rol'] ?></td>
                        <td><?= $d['correo'] ?></td>
                        <td><?php if ($d['estado'] == 1) {
                                echo "Activo";
                            } else {
                                echo "Inactivo";
                            }  ?></td>
                        <td>
                            <a href="http://localhost/sicloud/vista/EditarUsuario.php?ID_us=<?= $d['ID_us'] ?> " class="btn btn-circle btn-dark"><i class="fas fa-marker"></i></a>
                            <?php if ($_SESSION['usuario']['ID_rol_n'] == 1) {     ?>
                                <a onclick="activarCuenta( <?php echo $d['ID_us']   ?> )" href="#" class="btn btn-circle btn-success"><i class="fas fa-check-square"></i> </a>
                                <a onclick="desactivarCuenta( <?php echo $d['ID_us']   ?> )" href="#" class="btn btn-circle btn-danger"><i class="far fa-trash-alt"></i></a>
                            <?php }  ?>
                        </td>
                    </tbody>
            <?php
                        }
                    }
            ?>
                </table>
            </div>
        </div><!-- div de tablas -->
        </div>
        </div><!-- fin de primera divicion -->
        <?php
        $activos   = $objCon->conteoUsuariosActivos();
        $inactivos = $objCon->conteoUsuariosInactivos();
        $totaUs    = ($inactivos +  $activos);
        ?>
        <div class="card card-body col-lg-11 mx-auto my-4 text-center ">
            <h5 class="my-2">Usuarios</h5>
            <div class="row col-lg-10 mx-auto">
                <!-- -------------------------------------------------------------- -->
                <div class=" col-md-4  mx-auto card card-body shadow ">
                    <div class="form-group  col-lg-10 row">
                        <label class="col-sm-9" for="">Activos</label>
                        <input class="form-control col-sm-3" type="text" value="<?php echo $activos ?>" disabled>
                    </div>
                </div>

                <div class=" col-md-4  mx-auto card card-body shadow">
                    <div class="form-group  col-lg-10 row">
                        <label class="col-sm-9" for="">Inactivos</label>
                        <input class="form-control col-sm-3" type="text" value="<?php echo $inactivos ?>" disabled>
                    </div>
                </div>

                <div class=" col-md-4  mx-auto card card-body shadow">
                    <div class="form-group  col-lg-10 row">
                        <label class="col-sm-9" for="">Registrados</label>
                        <input class="form-control col-sm-3" type="text" value="<?php echo $totaUs ?>" disabled>
                    </div>
                </div>
                <!-- -------------------------------------------------------------- -->
            </div>
            <div class="card card-body col-md-12 mx-auto my-4 text-center shadow">
                <div class="row">

                    <!-- -------------------------------------------------------------- -->

                    <div class=" col-md-3 my-2 mx-auto">
                        <a class="btn-block btn btn-dark" href="">Imprimir</a>
                    </div>
                    <div class=" col-md-3 my-2 mx-auto">
                        <a class="btn-block btn btn-dark" href="">Exportar</a>
                    </div>
                    <div class=" col-md-3 my-2 mx-auto">
                        <a class="btn-block btn btn-dark" href="formTelefono.php">Directorio telefonico</a>
                    </div>
                    <div class=" col-md-3 my-2 mx-auto">
                        <a class="btn-block btn btn-dark" href="">Directorio direcciones</a>
                    </div>


                    <!-- -------------------------------------------------------------- -->
                </div>
            </div>
        </div>
<?php
rutFinFooterFrom();
rutFromFin();
} // fin de validadcion y ejecucion de permisos por rol
?>

    <script src="estilos/js/cUsuariosJquery.js"></script>